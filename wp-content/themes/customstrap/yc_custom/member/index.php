<?php


//定義發放日
define('REWARD_DAY', '01');
$max_member_lv_id = '';

function set_max_member_lv_id()
{
	global $max_member_lv_id;
	$args = array(
		'post_type' => 'member_lv',
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'DESC',
	);
	$posts = get_posts($args);
	if (empty($posts) || !is_array($posts)) return;

	$max_member_lv_id = $posts[0]->ID;
}
add_action('init', 'set_max_member_lv_id');


// 取得生日
function yc_get_user_birthday()
{
	if (!is_user_logged_in()) return;
	$user_id = get_current_user_id();
	$birthday = get_user_meta($user_id, 'birthday', true);
	if (empty($birthday)) {
		$birthday = '沒有填寫生日資訊';
	}
	return $birthday;
}

//預設會員等級
function yf_default_member_lv($user_id)
{
	$user = get_user_by('id', $user_id);
	$member_lv_id = '713';
	$points_type = 'yf_reward';
	$user_member_lv_title = get_the_title($member_lv_id);
	update_user_meta($user_id, '_gamipress_member_lv_rank', $member_lv_id);
	update_user_meta($user_id, 'time_MemberLVexpire_date', 'no_expire');
	$points = 0; //起始購物金

	$args = array(
		'reason' => "$user_member_lv_title 會員起始購物金 NT$ $points - $user->display_name",
	);
	// Award the points to the user
	gamipress_award_points_to_user($user_id, $points, $points_type, $args);
}
add_action('user_register', 'yf_default_member_lv');



// 判斷使用者等級
function yf_get_user_member_lv_title($user_id = '')
{
	if ($user_id == '') $user_id = get_current_user_id();
	$member_lv_id = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
	return get_the_title($member_lv_id);
}
function yf_get_user_member_lv_id($user_id = '')
{
	if ($user_id == '') $user_id = get_current_user_id();
	$member_lv_id = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
	return $member_lv_id;
}



/**
 * WP CRON
 * 定時操作
 */
add_action('init', 'yc_wp_cron_init');
function yc_wp_cron_init()
{
	//只有每月1號才執行
	if (date('d', time() + 8 * 3600) !== REWARD_DAY) return;

	if (!wp_next_scheduled('yf_daily_check')) {
		wp_schedule_event(time(), 'daily', 'yf_daily_check');
	}

	add_action('yf_daily_check', 'yf_clear_monthly', 10);
	add_action('yf_daily_check', 'yf_member_upgrade', 20);
	// 清除已發過的註記
	// add_action('yf_daily_check', 'clear_last_reward_reward', 25);
	add_action('yf_daily_check', 'yf_birthday', 30);
	add_action('yf_daily_check', 'yf_reward_monthly', 50);
}
//add_action( 'admin_init', 'yf_birthday' );
// yf_clear_monthly();
// NOTE 測試用
// yf_member_upgrade();
// yf_birthday();
// yf_reward_monthly();

function yf_clear_monthly()
{
	//
	$points_type = 'yf_reward';   // Points typeslug
	$users = get_users([
		'number' => '-1',
	]);
	foreach ($users as $user) {
		$user_id = $user->ID;
		/**
		 * 統一每月一號清0
		 */
		$points = gamipress_get_user_points($user_id, $points_type);
		$args = array(
			'reason' => "每月購物金清0",
		);
		// Award the points to the user
		gamipress_deduct_points_to_user($user_id, $points, $points_type, $args);
		// Store this award to prevent award it again
		update_user_meta($user_id, 'yf_user_last_reward_monthly_on', '');
		//發信通知
		//yf_send_mail_with_template('birthday');

	}
}


//會員消費滿額升等
//當會員到期時才判斷，否則不用判斷
// **當有消費狀態變更時判斷**
function yf_member_upgrade()
{


	$points_type = 'yf_reward';   // Points type slug

	$users = get_users([
		'number' => '-1',
	]);
	foreach ($users as $user) {
		$user_id = $user->ID;

		$time_MemberLVexpire_date = strtotime(get_user_meta($user_id, 'time_MemberLVexpire_date', true));
		$orderdata_last_year = get_user_meta($user_id, 'orderdata_last_year', true) ?? [];
		//會員等級有沒有變動
		$member_lv_id = yf_get_user_member_lv_id($user_id);
		//金額判斷
		$orderamount_last_year = $orderdata_last_year['total'] ?? 0;



		// 只有星砂才判斷 || 到期判斷 || 消費突破下個門檻
		if ($time_MemberLVexpire_date == 'no_expire' || time() > $time_MemberLVexpire_date) {
			//會員資格到期，重新判斷
			update_user_memberLV_by_orderamount_last_year($user_id, $orderamount_last_year);
		} else {
			//會員資格沒到期
			//如果消費超過下個門檻才判斷 && 會員等級不等於最高會員等級
			global $max_member_lv_id;
			if ($member_lv_id != $max_member_lv_id) {
				//如果會員等級為最高，則不判斷
				$next_rank_id = gamipress_get_next_user_rank_id($user_id, 'member_lv');
				$next_rank_threshold = get_post_meta($next_rank_id, 'threshold', true);

				if ($orderamount_last_year >= (int) $next_rank_threshold) {
					update_user_memberLV_by_orderamount_last_year($user_id, $orderamount_last_year);
				}
			}
		}
	}
}

function save_user_orderdata($order_id, $old_status, $new_status)
{
	$order = new WC_Order($order_id);
	$user_id = $order->get_user_id();
	$orderdata_last_year = get_orderdata_lastyear_by_user($user_id);
	update_user_meta($user_id, 'orderdata_last_year', $orderdata_last_year);
}

add_action('woocommerce_order_status_changed', 'save_user_orderdata', 10, 3);

//判斷用戶消費門檻
function update_user_memberLV_by_orderamount_last_year($user_id, $orderamount_last_year)
{

	$args = array(
		'post_type' => 'member_lv',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'meta_value_num',
		'meta_key' => 'threshold',
		'order' => 'DESC',
	);
	$member_lvs = get_posts($args);

	foreach ($member_lvs as $member_lv) {
		$member_lv_id = $member_lv->ID;
		if ($orderamount_last_year >= (int) get_post_meta($member_lv_id, 'threshold', true)) {
			update_user_meta($user_id, '_gamipress_member_lv_rank', $member_lv_id);
			update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
			update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
			break;
		}
	}
}



//生日禮金發放
function yf_birthday()
{

	$points_type = 'yf_reward';   // Points type slug
	$users = get_users([
		'number' => '-1',

	]);
	foreach ($users as $user) {
		$user_id = $user->ID;
		yf_birthday_by_user_id($user_id);
	}
}
function yf_birthday_by_user_id($user_id, $points_type = 'yf_reward')
{
	$user = get_userdata($user_id);
	$user_member_lv_id = yf_get_user_member_lv_id($user_id);
	$user_registered = $user->user_registered;

	$points = get_birthday_reward_by_member_lv_id($user_member_lv_id);

	$user_member_lv_title = get_the_title($user_member_lv_id);

	$birthday = get_user_meta($user_id, 'birthday', true);       // 生日 get_user_meta
	if (empty($birthday)) return; //沒有生日資訊
	$allow_bday_reward = allow_bday_reward($user_id);



	if ($allow_bday_reward) {
		$args = array(
			'reason' => "生日禮金發放NT$ $points - $user->display_name ($user_member_lv_title)",
		);
		// Award the points to the user
		gamipress_award_points_to_user($user_id, $points, $points_type, $args);
		// Store this award to prevent award it again
		update_user_meta($user_id, 'yf_user_last_birthday_awarded_on', date('Y-m-d H:i:s', strtotime('+8 hours')));
		//寄送 E-mail 發信通知
		// $data = array();
		// $data['to'] = $user->user_email;
		// $data['subject'] = '生日快樂！您的生日禮金已經發放';
		// yf_send_mail_with_template('', $data);
	}
	//else 不發放生日禮金
}

function get_birthday_reward_by_member_lv_id($user_member_lv_id)
{
	$points = get_post_meta($user_member_lv_id, 'yf_birthday_reward', true) ?? 0;
	return $points;
}

function allow_bday_reward($user_id)
{
	$birthday = get_user_meta($user_id, 'birthday', true);       // 生日 get_user_meta
	if (empty($birthday)) return false; //沒有生日資訊
	$birthday_month = date('m', strtotime($birthday));
	$already_awarded = get_user_meta($user_id, 'yf_user_last_birthday_awarded_on', true);


	/**
	 * 統一每月一號發放
	 */
	if (empty($already_awarded)) {
		//上次有沒有領過 $user_registered
		if (date('m', time() + 8 * 3600) == $birthday_month) {
			return true;
		} else {
			return false;
		}
	} else {
		//之前有領過
		if ((strtotime("now") - strtotime($already_awarded) >= 31536000) && date('m', time() + 8 * 3600) == $birthday_month) {
			return true;
		} else {
			//不發放
			return false;
		}
	}
}



//每月購物金發放
function yf_reward_monthly()
{
	$points_type = 'yf_reward';   // Points type slug
	$users = get_users([
		'number' => '-1',
	]);
	foreach ($users as $user) {
		$user_id = $user->ID;
		yf_reward_monthly_by_user_id($user_id);
	}
}

function yf_reward_monthly_by_user_id($user_id, $points_type = 'yf_reward')
{
	$user = get_userdata($user_id);
	$user_member_lv_id = yf_get_user_member_lv_id($user_id);
	$points = get_monthly_reward_by_member_lv_id($user_member_lv_id);
	$user_member_lv_title = get_the_title($user_member_lv_id);
	$allow_monthly_reward = allow_monthly_reward($user_id);


	if ($allow_monthly_reward) {
		$args = array(
			'reason' => "每月購物金發放NT$ $points - $user->display_name ($user_member_lv_title)",
		);
		// Award the points to the user
		gamipress_award_points_to_user($user_id, $points, $points_type, $args);

		// Store this award to prevent award it again
		update_user_meta($user_id, 'yf_user_last_reward_monthly_on', date('Y-m-d H:i:s'));

		//發信通知
		//yf_send_mail_with_template('yf_reward');
	}
	//else 不發放

}

function get_monthly_reward_by_member_lv_id($user_member_lv_id)
{
	$points = get_post_meta($user_member_lv_id, 'yf_reward_point', true);
	return $points;
}




function allow_monthly_reward($user_id)
{
	//每月1號為發放日
	$reward_monthly_date = date('Y-m') . '-1';
	$already_awarded = get_user_meta($user_id, 'yf_user_last_reward_monthly_on', true);

	if (empty($already_awarded)) {
		return true;
	} else {
		//之前有領過
		if ((strtotime("now") - strtotime($already_awarded) >= 1900800) && (strtotime("now") >= strtotime($reward_monthly_date))) {
			//距離上次發放22天以上，且現在 > 發放日
			return true;
		} else {
			//不發放
			return false;
		}
	}
}

function clear_last_reward_reward()
{
	$users = get_users([
		'number' => '-1',

	]);
	foreach ($users as $user) {
		$user_id = $user->ID;
		update_user_meta($user_id, 'yf_user_last_reward_monthly_on', '');
		update_user_meta($user_id, 'yf_user_last_birthday_awarded_on', '');
	}
}

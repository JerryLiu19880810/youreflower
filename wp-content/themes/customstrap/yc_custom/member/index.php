<?php

/*
+----------------+----------+-----------+--------------+---------+-------------+
|                |   星砂   |   幸運星  |     母貝     |  美人魚 |    海王妃   |
+----------------+----------+-----------+--------------+---------+-------------+
| member_lv      | customer | luckystar | motheroyster | mermaid | seaprincess |
+----------------+----------+-----------+--------------+---------+-------------+
| 升級門檻       |     -    |   滿1萬   |     滿3萬    |  滿5萬  |    滿10萬   |
+----------------+----------+-----------+--------------+---------+-------------+
| 每月贈送購物金 |    50    |    199    |      299     |   399   |     599     |
| 每月到期重銷   |          |           |              |         |             |
+----------------+----------+-----------+--------------+---------+-------------+
| 生日禮金       |    100   |    888    |      888     |   888   |     888     |
+----------------+----------+-----------+--------------+---------+-------------+

$points_type = yf_reward

*/
//定義發放日
define('REWARD_DAY', '01');

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
		'reason' => "${user_member_lv_title}會員起始購物金 NT$ $points - $user->display_name",
	);
	// Award the points to the user
	gamipress_award_points_to_user($user_id, $points, $points_type, $args);
}
add_action('user_register', 'yf_default_member_lv');

//把沒有會員的人都預設一個會員等級
// function set_member_if_user_has_no_lv()
// {
//     $users = get_users();
//     foreach ($users as $user) {
//         $user_id = $user->ID;
//         $user_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
//         if (empty($user_lv)) {
//             update_user_meta($user_id, '_gamipress_member_lv_rank', '713');
//             update_user_meta($user_id, 'time_MemberLVexpire_date', 'no_expire');
//         }
//     }
// }
// add_action('init', 'set_member_if_user_has_no_lv');

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
	if (!wp_next_scheduled('yf_daily_check')) {
		wp_schedule_event(time(), 'daily', 'yf_daily_check');
		//update_option('test_scheduled', 'scheduled' . date('Y-m-d H:i:s'));
	}

	add_action('yf_daily_check', 'yf_clear_monthly', 10);
	add_action('yf_daily_check', 'yf_member_upgrade', 20);
	add_action('yf_daily_check', 'yf_birthday', 30);


	add_action('yf_daily_check', 'yf_reward_monthly', 40);
}
//add_action( 'admin_init', 'yf_birthday' );
function yf_clear_monthly()
{
	$points_type = 'yf_reward';   // Points type slug
	$users = get_users([
		'number' => '-1'
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
	if (date('d', time() + 8 * 3600) !== REWARD_DAY) return;


	$points_type = 'yf_reward';   // Points type slug

	$users = get_users([
		'number' => '-1'
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
			//如果消費超過下個門檻才判斷 && 會員等級不等於海王妃 (727)
			if ($member_lv_id === '727') {
				//如果會員等級為海王妃，則不判斷
				return;
			}

			$next_rank_id = gamipress_get_next_user_rank_id($user_id, 'member_lv');
			$next_rank_threshold = get_post_meta($next_rank_id, 'threshold', true);



			if ($orderamount_last_year >= (int) $next_rank_threshold) {
				update_user_memberLV_by_orderamount_last_year($user_id, $orderamount_last_year);
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
	if ($orderamount_last_year >= (int) get_post_meta(727, 'threshold', true)) {
		update_user_meta($user_id, '_gamipress_member_lv_rank', '727');
		update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
		update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
	} elseif ($orderamount_last_year >= (int) get_post_meta(726, 'threshold', true)) {
		update_user_meta($user_id, '_gamipress_member_lv_rank', '726');
		update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
		update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
	} elseif ($orderamount_last_year >= (int) get_post_meta(725, 'threshold', true)) {
		update_user_meta($user_id, '_gamipress_member_lv_rank', '725');
		update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
		update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
	} elseif ($orderamount_last_year >= (int) get_post_meta(714, 'threshold', true)) {
		update_user_meta($user_id, '_gamipress_member_lv_rank', '714');
		update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
		update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
	} else {
		update_user_meta($user_id, '_gamipress_member_lv_rank', '713');
		update_user_meta($user_id, 'time_MemberLVchanged_last_time', date('Y-m-d H:i:s'));
		update_user_meta($user_id, 'time_MemberLVexpire_date', date('Y-m-d', strtotime('+1 year')));
	}
}



//生日禮金發放
function yf_birthday()
{

	//正式環境，檢查日期
	if (date('d', time() + 8 * 3600) !== REWARD_DAY) return;



	//update_option('test_fired', 'Fired' .  date('Y-m-d H:i:s'));


	$points_type = 'yf_reward';   // Points type slug
	$users = get_users([
		'number' => '-1'
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
	switch ($user_member_lv_id) {
		case '713': //星沙
			$points = 100;              // 生日禮金
			break;
		case '714': //幸運星
			$points = 888;              // 生日禮金
			break;
		case '725': //母貝
			$points = 888;              // 生日禮金
			break;
		case '726': //美人魚
			$points = 999;              // 生日禮金
			break;
		case '727': //海王妃
			$points = 1288;              // 生日禮金
			break;
		default:
			$points = 0;              // 生日禮金
			break;
	}
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

	//正式環境，檢查日期
	if (date('d', time() + 8 * 3600) !== REWARD_DAY) return;


	$points_type = 'yf_reward';   // Points type slug
	$users = get_users([
		'number' => '-1'
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

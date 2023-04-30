<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;


$phone = get_user_meta( $user->ID, 'billing_phone', true );
$gender = get_user_meta( $user->ID, 'gender', true );
$birthday = get_user_meta( $user->ID, 'birthday', true );
$billing_address_1 = get_user_meta( $user->ID, 'billing_address_1', true );

do_action('woocommerce_before_edit_account_form'); ?>


<div class="tab-pane fade active show" id="sidebar-1-3" role="tabpanel" aria-labelledby="sidebar-1-3">
    <div class="row">
        <div class="col">
            <h2>Personal Data</h2>
        </div>
    </div>

    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action('woocommerce_edit_account_form_tag'); ?>>


        <?php do_action('woocommerce_edit_account_form_start'); ?>




      <!--   <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" id="inputName2" class="form-control form-control-lg" placeholder="Name" required="" value="Dumitru">
                        <label for="inputName2">First Name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" id="inputSurname2" class="form-control form-control-lg" placeholder="Surname" required="">
                        <label for="inputSurname2">Surname</label>
                    </div>
                </div>
            </div>
        </fieldset> -->

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control form-control-lg"  id="account_user_login" value="<?php echo esc_attr($user->user_login); ?>" disabled>
                        <label for="account_user_login">帳號</label>
                    </div>
                </div>
            </div>
        </fieldset>



        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control form-control-lg" name="account_first_name" autocomplete="given-name" id="account_first_name" value="<?php echo esc_attr($user->first_name); ?>" />
                        <label for="account_first_name">姓名</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control form-control-lg" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" />
                        <label for="inputEmail">顯示名稱</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text form-control form-control-lg" name="account_email" id="account_email" placeholder="Email Address" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
                        <label for="account_email">Email</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control form-control-lg" name="billing_phone" id="billing_phone" placeholder="" autocomplete="phone" value="<?php echo esc_attr($phone); ?>" />
                        <label for="billing_phone">手機</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control form-control-lg" name="billing_address_1" id="billing_address_1" placeholder="" autocomplete="address" value="<?php echo esc_attr($billing_address_1); ?>" />
                        <label for="billing_address_1">地址</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input class="birthday-field" type="date" id="birthday" name="birthday" value="<?php echo esc_attr($birthday); ?>">
                        <label for="billing_phone">生日</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="row">
            <div class="col-12">
                <span class="label">Gender</span>
            </div>
            <div class="col">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="gender_male" name="gender" class="custom-control-input" <?php echo ($gender=='male')?'checked':''; ?> value="male">
                    <label class="custom-control-label" for="gender_male">Men</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="gender_female" name="gender" class="custom-control-input" value="female" <?php echo ($gender=='female')?'checked':''; ?>>
                    <label class="custom-control-label" for="gender_female">Women</label>
                </div>
            </div>
        </div>

        <!--變更密碼-->
        <fieldset class="mb-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="password" name="password_current" id="password_current" autocomplete="off" class="woocommerce-Input woocommerce-Input--password input-text form-control form-control-lg">
                        <label for="password_current"><?php esc_html_e('Current password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control form-control-lg" name="password_1" id="password_1" autocomplete="off" />

                        <label for="password_1"><?php esc_html_e('New password (leave blank to leave unchanged)', 'woocommerce'); ?></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-label-group">
                        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text form-control form-control-lg" name="password_2" id="password_2" autocomplete="off" />
                        <label for="password_2"><?php esc_html_e('Confirm new password', 'woocommerce'); ?></label>
                    </div>
                </div>
            </div>
        </fieldset>


        <?php do_action('woocommerce_edit_account_form'); ?>






        <div class="row">
            <div class="col">
                <?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
                <button type="submit" class="woocommerce-Button button btn btn-primary px-3" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
                <input type="hidden" name="action" value="save_account_details" />
            </div>
        </div>
        <?php do_action('woocommerce_edit_account_form_end'); ?>
    </form>
    <?php do_action('woocommerce_after_edit_account_form'); ?>
</div>

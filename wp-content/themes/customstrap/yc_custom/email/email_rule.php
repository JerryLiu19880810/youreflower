<?php

/**
 * $bulk_send_email_template = 'test_email'
 * 寄送 E-mail
 * $data = array();
 * $data['to'] = $email_to;
 * $data['subject'] = $bulk_send_email_template_subject;
 * yf_send_mail_with_template($bulk_send_email_template, $data);
 */


$data = array();
$data['to'] = $email_to;
$data['subject'] = $bulk_send_email_template_subject;
yf_send_mail_with_template($bulk_send_email_template, $data);
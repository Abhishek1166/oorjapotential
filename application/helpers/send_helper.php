<?php

/** Send Mail
 *
 * @param string $mailTo
 * @param string $subject
 * @param string $msg
 * @return void */
function sendMail($mailTo, $subject, $msg, $file = null)
{
	$ci = &get_instance();
	$ci->load->library('email', [
		'protocol'  => 'SMTP',
		'smtp_host' => "mail.proplive.in",
		'smtp_user' => "info@proplive.in",
		'smtp_pass' => "Proplive@123",
		'smtp_port' => 587,
		'wordwrap'  => TRUE
	]);
	$ci->email->from('info@proplive.in');

	$ci->email->to($mailTo);
	$ci->email->subject($subject);
	$ci->email->message($msg);
	isset($file) and !is_null($file) and $ci->email->attach($file);
	return $ci->email->send();
}


/** Send Message
 *
 * @param string $msg
 * @param int $mobile
 * @return string */
function shootMsg($msg, $mobile)
{
	$sender_id = 'PRPLIV';
	$key = "55E202E726F8EA";
	$routeid = "7";
	$campaign = "9417";
	$end_point_url = "http://byebyesms.com/app/smsapi/index.php";
	$url = "key=" . $key . "&campaign=" . $campaign . "&routeid=" . $routeid . "&type=text&contacts=" . $mobile . "&senderid=" . $sender_id . "&msg=" . $msg;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $end_point_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: unsubscribe.php
| Author: Terry Broullette(Grimloch)
| Email: webmaster@whisperwillow.com
| Website: http://www.whisperwillow.com
+--------------------------------------------------------+
| Some code and processes used from:
| Open Newsletter (previously Burn!nGames Newsletter)
| Copyright (c) Koller József & Paul Beuk - 2003-2009
| Original author: Koller József (Orosznyet)
| email: orosznyet@gmail.com
| website: http://orosznyet.extra.hu
| updated for PHP-Fusion v7: Paul Beuk (muscapaul)
| email: muscapaul@gmail.com
| website: http://www.muscapaul.com
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
$settings = fusion_get_settings();
require_once THEMES."templates/header.php";
include INFUSIONS."news_letter_panel/infusion_db.php";

// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}

$step = isset($_REQUEST['step']) ? $_REQUEST['step'] : "";
$error = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";
$activate = isset($_REQUEST['activate']) ? $_REQUEST['activate'] : "";
$deactivate = isset($_REQUEST['deactivate']) ? $_REQUEST['deactivate'] : "";

if (iMEMBER) {
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$userdata['user_email']."'");
	if ($step == "subscribe") {
		if (dbrows($result) == 0) {
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." VALUES('', '".$userdata['user_email']."','".$userdata['user_name']."','1','0','time()','1')");
			redirect(FUSION_SELF);
		}
	}

	if ($step == "unsubscribe") {
		$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$userdata['user_email']."'");
		redirect(FUSION_SELF);
	}
}

opentable($locale['nl_470']);
if (isnum(isset($_REQUEST['id'])) AND isset($_REQUEST['activate'])) {
	echo "<div style='text-align:center'><br /><br />\n";
	$get_vc = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_id='".$_REQUEST['id']."'");
	$get_vca = dbarray($get_vc);
	$get_vcr = dbrows($get_vc);
	if ($get_vcr != 0) {
		if ($get_vca['nl_sub_stat'] == 0) {
			$get_vn = dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE validate_code='".$_REQUEST['activate']."'");
			$get_vna = dbarray($get_vn);
			$get_vnr = dbrows($get_vn);
			if ($get_vnr != 0) {
				$result = dbquery("UPDATE ".DB_NEWS_LETTER_SUBS." SET nl_sub_stat='1' WHERE nl_sub_id ='".$_REQUEST['id']."'");
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE validate_code='".$_REQUEST['activate']."'");
				echo $locale['nl_500'];
			}
			else {
				echo $locale['nl_501'];
			}
		}
		else {
			echo $locale['nl_502'];
		}
	}
	else {
		echo $locale['nl_503'];
	}
	echo "<br /><br /><br /><a href='../../index.php'>".$locale['nl_504']."</a><br /><br /></div>\n";
}
elseif (isnum(isset($_REQUEST['id'])) AND isset($_REQUEST['deactivate'])) {
	echo "<div style='text-align:center'><br /><br />\n";
	$get_vc = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_id='".$_REQUEST['id']."'");
	$get_vca = dbarray($get_vc);
	$get_vcr = dbrows($get_vc);
	if ($get_vcr != 0) {
		$get_vn = dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE validate_code='".$_REQUEST['deactivate']."'");
		$get_vna = dbarray($get_vn);
		$get_vnr = dbrows($get_vn);
		if ($get_vnr != 0) {
			$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE validate_code='".$_REQUEST['deactivate']."'");
			$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_id='".$_REQUEST['id']."'");
			echo $locale['nl_505'];
		}
		else {
			echo $locale['nl_501'];
		}
	}
	else {
		echo $locale['nl_503'];
	}
	echo "<br /><br /><br /><a href='../../index.php'>".$locale['nl_504']."</a><br /><br /></div>\n";
}
elseif (iMEMBER) {
	$time = time();
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$userdata['user_email']."'");
	if (dbrows($result) == 0) {
		echo "<div align='center'>".$locale['nl_471']."<br /><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
		echo "<form id='".$options['form_id']."' name='news_sub' method='POST' action='".FUSION_SELF."?step=subscribe'>\n";
		echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
		echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
		echo "<input type='submit' name='subscribe' value='".$locale['nl_472']."' class='button' />\n";
		echo "</form>\n</div>\n";
		$data = dbarray(dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS.""));
		echo "<br /><div style='text-align:center'>".$locale['nl_473']." ".$data['sub_no']."</div>\n";
	}
	else {
		echo "<div align='center'>".$locale['nl_474']."<br /><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
		echo "<form id='".$options['form_id']."' name='news_unsub' method='POST' action='".FUSION_SELF."?step=unsubscribe'>\n";
		echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
		echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
		echo "<input type='submit' name='unsubscribe' value='".$locale['nl_475']."' class='button' />\n";
		echo "</form>\n</div>\n";
		$sql_new = dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS."");
		$data = dbarray($sql_new);
		echo "<br /><div style='text-align:center'>".$locale['nl_473']." ".$data['sub_no']."</div>\n";
	}
} else {
	if (isset($_POST['subscribe'])) {
		$time = time();
		$email = stripinput(trim(preg_replace("/ +/i", "", $_POST['mail_addr'])));
		if ($email == $locale['nl_477']) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_478']."<br />\n";
		}
		if ($email == "") {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_478']."<br />\n";
		}
		if (!preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_479']."<br />\n";
		}
		$email_domain = substr(strrchr($email, "@"), 1);
		$result = dbquery("SELECT * FROM ".DB_BLACKLIST." WHERE blacklist_email='".$email."' OR blacklist_email='".$email_domain."'");
		if (dbrows($result) != 0) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_480']."<br />\n";
		}
		$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$email."'");
		if (dbrows($result) != 0) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_481']."<br />\n";
		}
		$name = stripinput(trim($_POST['mail_name']));
		if ($name == $locale['nl_492']) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_493']."<br />\n";
		}
		if ($name == "") {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_493']."<br />\n";
		}
		if (!preg_match("/^[\p{L}\sA-Za-z]+$/", $name)) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_494']."<br />\n";
		}
		require_once INCLUDES."sendmail_include.php";
		if ($error == "") {
			$userow = dbrows(dbquery("SELECT * FROM ".DB_USERS." WHERE user_email='".$email."'"));
			if ($userow == 1) { $who = 1;} else { $who = 0;}
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." VALUES('', '".$_POST['mail_addr']."','".$_POST['mail_name']."','0','0','".$time."','".$who."')");
			$get_id = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$get_val = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_VALIDATE." VALUES('', '".md5($get_val['nl_sub_id'].$time)."','".$get_id['nl_sub_id']."')");
			$get_code = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'"));
			$get_val = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$local_1 = $locale['nl_482'];
			$local_2 = $locale['nl_483'];
			$activation_url = $settings['siteurl']."infusions/news_letter_panel/subscribe.php?id=".$get_id['nl_sub_id']."&activate=".$get_code['validate_code'];
			if (sendemail("",$email,$settings['siteusername'],$settings['siteemail'],$local_1, $local_2.$activation_url)) {
				echo "<div align='center'><font color='red'>".$locale['nl_484']."</font><br />";
			}
			else {
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'");
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'");
				echo "<div align='center'><font color='red'>".$locale['nl_485']."</font><br />";
			}
		}
		elseif ($error != "") {
			echo $locale['nl_486']."<br />\n".$error."<br /><div align='center'>\n";
		}
	}
	if (isset($_POST['unsubscribe'])) {
		$time = time();
		$email = stripinput(trim(preg_replace("/ +/i", "", $_POST['mail_addr'])));
		if ($email == $locale['nl_477']) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_478']."<br />\n";
		}
		if ($email == "") {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_478']."<br />\n";
		}
		if (!preg_match("/^[-0-9A-Z_\.]{1,50}@([-0-9A-Z_\.]+\.){1,50}([0-9A-Z]){2,4}$/i", $email)) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_479']."<br />\n";
		}
		$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$email."'");
		if (dbrows($result) == 0) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_487']."<br />\n";
		}

		require_once INCLUDES."sendmail_include.php";
		if ($error == "") {
			$local_1 = $locale['nl_488'];
			$local_2 = $locale['nl_489'];
			$get_id =   dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_VALIDATE." VALUES('', '".md5($get_id['nl_sub_id'].$time)."','".$get_id['nl_sub_id']."')");
			$get_code = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'"));
			$deactivation_url = $settings['siteurl']."infusions/news_letter_panel/unsubscribe.php?id=".$get_id['nl_sub_id']."&deactivate=".$get_code['validate_code'];
			if (sendemail("",$email,$settings['siteusername'],$settings['siteemail'],$local_1, $local_2.$deactivation_url)) {
				echo "<div align='center'><font color='red'>".$locale['nl_490']."</font><br />";
			}
			else {
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'");
				echo "<div align='center'><font color='red'>".$locale['nl_485']."</font><br />";
			}
		}
		elseif ($error != "") {
			echo $locale['nl_486']."<br />\n".$error."<br /><div align='center'>";}
		}
		if (!isset($_POST['subscribe']) AND !isset($_POST['unsubscribe'])) {
			echo "<div align='center'><div style='text-align:center'>".$locale['nl_496']."</div><br />";
		}
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."' name='letter_subs' method='POST' action='".FUSION_SELF."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<input type='text' class='textbox' name='mail_addr' value='".$locale['nl_477']."'  onBlur=\"if(this.value=='') this.value='".$locale['nl_477']."';\" onFocus=\"if(this.value=='".$locale['nl_477']."') this.value='';\" size='25px' /><br /><br />\n";
	echo "<input type='submit' name='unsubscribe' value='".$locale['nl_475']."' class='button' />\n";
	$data = dbarray(dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS.""));
	echo "<br /><br /><div style='text-align:center'>".$locale['nl_473']." ".$data['sub_no']."</div>\n";
	echo "</form>\n</div>\n";
}
closetable();

require_once THEMES."templates/footer.php";
?>
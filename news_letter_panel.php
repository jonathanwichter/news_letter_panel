<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_panel.php
| Author: Terry Broullette(Grimloch)
| Email: webmaster@whisperwillow.com
| Website: http://www.whisperwillow.com
+--------------------------------------------------------+
| Some code and processes taken from:
+--------------------------------------------------------+
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
$settings = fusion_get_settings();
include INFUSIONS."news_letter_panel/infusion_db.php";
// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}
$error = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";

//openside($locale['nl_102']);
echo "<table align='center' width='100%' class='tbl-brdr'><tr><td>\n";
echo "<table align='center' width='100%'><tr><td align='center'><img width='100' src='".INFUSIONS."news_letter_panel/img/nletter.png' alt='' /></td><td valign='middle'></td></tr></table><br />\n";

if (iMEMBER) {
	$time = time();
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$userdata['user_email']."'");
	if (dbrows($result) == 0) {
		if (isset($_POST['subscribe'])) {
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." VALUES('', '".$userdata['user_email']."','".$userdata['user_name']."','1','0','".$time."','1')");
			redirect(FUSION_SELF.(FUSION_QUERY ? "?".FUSION_QUERY : ""));
		}
	echo "<div  align='center'>".$locale['nl_471']."<br /><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='newsletter' method='POST' action='".FUSION_SELF."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<input type='submit' name='subscribe' value='".$locale['nl_472']."' class='button' />\n";
	echo "</form></div>\n";
		$sql_n = dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS."");
		$data = dbarray($sql_n);
	echo "<br /><div align='left'>".$locale['nl_473']." ".$data['sub_no']."</div>";
	} else {
		if (isset($_POST['unsubscribe'])) {
			$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$userdata['user_email']."'");
			redirect(FUSION_SELF.(FUSION_QUERY ? "?".FUSION_QUERY : ""));
		}
	echo "<center><table  ><tr><td><img src='".IMAGES."avatars/".$userdata['user_avatar']."' width='45' alt='".$userdata['user_name']."' /></td><td>".$userdata['user_name']."<br />".$locale['nl_245']."".$locale['nl_253']."</td></tr></table>\n";
	echo "<div align='center'><br /><br />".$locale['nl_474']."<br /><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='newsletter' method='POST' action='".FUSION_SELF."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<input type='submit' name='unsubscribe' value='".$locale['nl_475']."' class='button' />\n";
	echo "</form></div>\n";
		$sql_n = dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS."");
		$data = dbarray($sql_n);
	echo "<br /><div align='center'>".$locale['nl_473']." ".$data['sub_no']."</div>\n";
	}
} else {
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 1) {
	if (isset($_POST['p_subscribe'])) {
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
		if (!preg_match("/[^a-zA-Z][][a-zA-Z]/", $name)) {
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_494']."<br />\n";
		}
		require_once INCLUDES."sendmail_include.php";
		if ($error == "") {
			$userow = dbrows(dbquery("SELECT * FROM ".DB_USERS." WHERE user_email='".$_POST['mail_addr']."'"));
			if ($userow == 1) { $who = 1;} else { $who = 0;}
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." VALUES('', '".$_POST['mail_addr']."','".$_POST['mail_name']."','0','0','".$time."','".$who."')");
			$get_id = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$get_val = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_VALIDATE." VALUES('', '".md5($get_val['nl_sub_id'].$time)."','".$get_id['nl_sub_id']."')");
			$get_code = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'"));
			$local_1 = $locale['nl_482'];
			$local_2 = $locale['nl_483'];
			$activation_url = $settings['siteurl']."infusions/news_letter_panel/subscribe.php?id=".$get_id['nl_sub_id']."&activate=".$get_code['validate_code'];
			if (sendemail("",$email,$settings['siteusername'],$settings['siteemail'],$local_1, $local_2.$activation_url)) {
				echo "<div align='center'><font color='red'>".$locale['nl_484']."</font></div><br />";
			}
			else {
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'");
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'");
				echo "<div align='center'><font color='red'>".$locale['nl_485']."</font></div><br />";
			}
		}
		else if ($error != "") {
			echo $locale['nl_486']."<br />\n".$error."<br /><div align='center'>";
		}
	}
	if (isset($_POST['p_unsubscribe'])) {
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
			$error .= "<font color='red'><strong>¤</strong></font> ".$locale['nl_481']."<br />\n";
		}
		require_once INCLUDES."sendmail_include.php";
		if ($error == "") {
			$local_1 = $locale['nl_488'];
			$local_2 = $locale['nl_489'];
			$get_id =   dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$_POST['mail_addr']."'"));
			$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_VALIDATE." VALUES('', '".md5($get_id['nl_sub_id'].$time)."','".$get_id['nl_sub_id']."')");
			$get_code = dbarray(dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'"));
			$activation_url = $settings['siteurl']."infusions/news_letter_panel/unsubscribe.php?id=".$get_id['nl_sub_id']."&deactivate=".$get_code['validate_code'];
			if (sendemail("",$email,$settings['siteusername'],$settings['siteemail'],$local_1, $local_2.$activation_url)) {
				echo "<div align='center'><font color='red'>".$locale['nl_490']."</font></div><br />";
			}
			else {
				$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$get_id['nl_sub_id']."'");
				echo "<div align='center'><font color='red'>".$locale['nl_485']."</font></div><br />";
			}
		}
		elseif ($error != "") {
			echo $locale['nl_486']."<br />\n".$error."<br />";
		}
	}
	if (!isset($_POST['p_subscribe']) AND !isset($_POST['p_unsubscribe'])) {
		echo "<div align='center'>".$locale['nl_491']."</div><br />";
	}
	echo "<div align='center'>\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='nwsltr' method='POST' action='".FUSION_SELF."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<input type='text' class='textbox' name='mail_addr' value='".$locale['nl_477']."'  onBlur=\"if(this.value=='') this.value='".$locale['nl_477']."';\" onFocus=\"if(this.value=='".$locale['nl_477']."') this.value='';\" size='25px' /><br />\n";
	echo "<input type='text' class='textbox' name='mail_name' value='".$locale['nl_492']."'  onBlur=\"if(this.value=='') this.value='".$locale['nl_492']."';\" onFocus=\"if(this.value=='".$locale['nl_492']."') this.value='';\" size='25px' /><br />".$locale['nl_496']."<br /><br />\n";
	echo "<input type='submit' name='p_subscribe' value='".$locale['nl_472']."' class='button' />\n";
	echo "<input type='submit' name='p_unsubscribe' value='".$locale['nl_475']."' class='button' />\n";
	$sql_n = dbquery("SELECT COUNT(nl_sub_mail) as sub_no FROM ".DB_NEWS_LETTER_SUBS."");
	$data = dbarray($sql_n);
	echo "<br /><br />".$locale['nl_473']." ".$data['sub_no']."</div>\n";
	echo "</form></div>\n";
	} else {
		echo "<div align='center'>".$locale['nl_495']."</div><br />";
	}
}
	echo "</td></tr></table>\n";
//closeside();
?>
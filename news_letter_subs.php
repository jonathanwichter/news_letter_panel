<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_subs.php
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
require_once THEMES."templates/admin_header.php";
require_once INCLUDES."sendmail_include.php";
include INFUSIONS."news_letter_panel/infusion_db.php";
// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}
//Define aidlink,
$aidlink = fusion_get_aidlink();

if (!checkrights("GNS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }
add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/nl_style.css' type='text/css' />");

$rowstart = (isset($_REQUEST['rowstart']) AND isnum($_REQUEST['rowstart'])) ? $_REQUEST['rowstart'] : "0";
$sub_id = (isset($_REQUEST['sub_id']) AND isnum($_REQUEST['sub_id'])) ? $_REQUEST['sub_id'] : "";
$step = (isset($_REQUEST['step']) AND isnum($_REQUEST['step'])) ? $_REQUEST['step'] : "0";
$do = isset($_REQUEST['do']) ? $_REQUEST['do'] : "";
$error = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";
if($do == "") { $step = "none"; }

opentable($locale['nl_200']);
echo "<div align='center'><span style='font-weight: bold; font-size: 13px;'>".$locale['nl_602']."</span><br /><br /><br /><hr width='90%'></div>\n";
echo "<table cellpadding='0' cellspacing='4' width='95%' align='center'><tr>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_605']."</a></td>\n";
echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
echo "<td align='center' width='16%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_606']."</a></td>\n";
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 1) {
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
echo "</table>\n";
closetable();
echo "<br />";

if ($step == 1 AND $sub_id != "") {
	if ($do == "activate") {
opentable($locale['nl_204']);
		$result = dbquery("UPDATE ".DB_NEWS_LETTER_SUBS." SET nl_sub_stat='1' WHERE nl_sub_id ='".$sub_id."'");
	$codes = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='0' AND nl_sub_id='".$sub_id."'");
	if(dbrows($codes)) {
		$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$sub_id."'");
	}
	echo "<div style='text-align:center'><br /><strong>".$locale['nl_205']."</strong><br /><br /><br /></div>\n";

		closetable();
		echo "<br />";
	}
	elseif ($do == "deactivate") {
opentable($locale['nl_207']);
		$result = dbquery("UPDATE ".DB_NEWS_LETTER_SUBS." SET nl_sub_stat='0' WHERE nl_sub_id ='".$sub_id."'");
	echo "<div style='text-align:center'><br /><strong>".$locale['nl_208']."</strong><br /><br /><br /></div>\n";

		closetable();  
		echo "<br />";
	}
	elseif ($do == "delete") {
opentable($locale['nl_209']);
	$codes = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='0' AND nl_sub_id='".$sub_id."'");
	if(dbrows($codes)) {
		$del1 = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='0' AND nl_sub_id='".$sub_id."'");
		$del2 = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='".$sub_id."'");
	} else {
		$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='1' AND nl_sub_id='".$sub_id."'");
}
	echo "<div style='text-align:center'><br /><strong>".$locale['nl_210']."</strong><br /><br /><br /></div>\n";

		closetable();  
		echo "<br />";
	}
}
if ($step == 1 AND $sub_id == "" AND $do == "add") {
opentable($locale['nl_211']);
	if (isset($_POST['add_sub'])) {
		$time = time();
		echo "<div style='text-align:center'><br />";
		if ($_POST['subs_type'] == 1) {
			if (isnum($_POST['subs_user_id'])) {
			$usern = dbquery("SELECT * FROM ".DB_USERS." WHERE user_id='".$_POST['subs_user_id']."'");
				if (dbrows($usern) != 0) {
					$usern_a = dbarray($usern);
					$usern_s =  dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." (nl_sub_mail, nl_sub_name, nl_sub_stat, nl_admin_add, nl_sub_date, nl_sub_who) VALUES('".$usern_a['user_email']."','".$usern_a['user_name']."','1','0','".$time."','1')");
					echo $locale['nl_212'];
				}
				else {
					echo $locale['nl_213']." ".$_POST['subs_user_id'];
				}
			}
			else {
				echo $locale['nl_214'];
			}
		}
		elseif ($_POST['subs_type'] == 2) {
			$time = time();
			$email = stripinput(trim(preg_replace("/ +/i", "", $_POST['sub_mail'])));
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
			if ($error == "") {
				$userow = dbrows(dbquery("SELECT * FROM ".DB_USERS." WHERE user_email='".$_POST['sub_mail']."'"));
				if ($userow == 1) { $who = 1;} else { $who = 0;}
				$result = dbquery("INSERT INTO ".DB_NEWS_LETTER_SUBS." (nl_sub_mail, nl_sub_name, nl_sub_stat, nl_admin_add, nl_sub_date, nl_sub_who) VALUES('".$_POST['sub_mail']."','".$_POST['mail_name']."','0','".$_POST['sub_add']."','".$time."','".$who."')");
				echo $locale['nl_215'];
			}
			elseif ($error != "") {
				echo $locale['nl_486']."<br />\n".$error."<br />";
			}
		}
		else {
			echo $locale['nl_216'];
		}
		echo "<br /><br />\n";
		echo "<table cellpadding='0' cellspacing='4' width='95%' align='center'><tr>\n";
		echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
		echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_605']."</a></td>\n";
		echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
		echo "<td align='center' width='16%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_606']."</a></td>\n";
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 1) {
		echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
		echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
		echo "</table>\n";
		echo "</div>\n";
	} else {
		$result = dbquery("SELECT * FROM ".DB_USERS." ORDER BY user_name ASC");
		if (dbrows($result) != 0) {
			$editlist = '';
			$sel = '';
			while ($data = dbarray($result)) {
				if (isset($user_id)) { $sel = ($data['user_id'] == $user_id ? " selected" : ""); }
				$cu = dbrows(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_mail='".$data['user_email']."'"));
				if ($cu == 0) {
					$editlist .= "<option value='".$data['user_id']."'".$sel.">".$data['user_name']." - ".$data['user_email']."</option>\n";
				}
			}
		}
		echo "<div style='text-align:center'>\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
		echo "<form id='".$options['form_id']."' name='publish' method='POST' action='".FUSION_SELF.$aidlink."&step=1&do=add'>\n";
		echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
		echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
		echo "<table width='600' cellpadding='10' cellspacing='1' align='center'><tr>\n";
		echo "<td class='tbl1' colspan='4' width='100%'><b>".$locale['nl_211']."</b></td>\n";
		echo "</tr><tr>\n";
		echo "<td align='left' class='tbl1'>".$locale['nl_217']."</td><td><input type='radio' name='subs_type' value='1' checked='checked' /></td><td class='tbl2' align='left'>".$locale['nl_246']."</td><td class='tbl2' align='left'><select name='subs_user_id' class='textbox' style='width:252px' />".$editlist."</select></td>\n";
		echo "</tr>\n";
	if($pub_allow == 2) {
		echo "<tr><td align='left' class='tbl1'>".$locale['nl_218']."</td><td><input type='radio' name='subs_type' value='2' /></td><td class='tbl2' align='left'>".$locale['nl_226']."</td><td class='tbl2' align='left'><input type='text' class='textbox' name='mail_name' style='width:250px' /></td>\n";
		echo "</tr><tr>\n";
		echo "<td align='left' class='tbl1' colspan='3'>".$locale['nl_219']."<input type='hidden' name='sub_add' value='1' /></td><td align='left' class='tbl2'><input type='text' class='textbox' name='sub_mail' style='width:250px' /></td>\n";
		echo "</tr>\n";
}
		echo "<tr><td colspan='4' height='20'></td>\n";
		echo "</tr><tr>\n";
		echo "<td colspan='4' width='100%' align='center'><input type='submit' name='add_sub' class='button' value='".$locale['nl_223']."' /></td></tr>\n";
		echo "</table></form></div>";
	}
	closetable();
} else {
	opentable($locale['nl_221']);
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS."");
	$rows = dbrows($result);
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." ORDER BY nl_sub_stat LIMIT ".$rowstart.",50");

	if (dbrows($result) != 0) {
		echo "<table border='0' cellpadding='0' cellspacing='3' width='100%' align='center'><tr>\n";
		echo "<td class='tbl2' align='center' width='100%' colspan='4'>".$locale['nl_222']." [ <a href='".FUSION_SELF.$aidlink."&step=1&do=add'>".$locale['nl_220']."</a> ]</td>\n";
		echo "</tr><tr>\n";
		echo "<td class='tbl1' align='center' width='25%'><b>".$locale['nl_247']."</b></td>\n";
		echo "<td class='tbl1' align='center' width='25%'><b>".$locale['nl_225']."</b></td>\n";
		echo "<td class='tbl1' align='center' width='25%'><b>".$locale['nl_227']."</b></td>\n";
		echo "<td class='tbl1' align='center' width='25%'><b>".$locale['nl_228']."</b></td></tr>\n";
		while ($data = dbarray($result)) {
			$cell_color = ($i % 2 == 0 ? "tbl2" : "tbl1"); $i++;
			echo "<tr><td class='".$cell_color."' width='25%' align='left'><a href='mailto:".$data['nl_sub_mail']."'>".$data['nl_sub_mail']."</a></td>\n";
			echo "<td class='".$cell_color."' width='25%' align='left' valign='middle'>\n";
			if ($data['nl_sub_who'] == 1) {
				$rescum = dbquery("SELECT * FROM ".DB_USERS." WHERE user_email='".$data['nl_sub_mail']."'");
				if (dbrows($rescum) != 0) {
					$resc = dbarray($rescum);
					echo "<strong><a href='".BASEDIR."profile.php?lookup=".$resc['user_id']."'>".$resc['user_name']."</a></strong>\n";
				}
				else {
					echo $locale['nl_229'];
				}
			}
			elseif ($data['nl_sub_who'] != 1) {
				echo "<font color='red'>".$locale['nl_230']."".$data['nl_sub_name']."] ";if($data['nl_admin_add'] ==1) { echo " - ".$locale['nl_867'].""; } echo "</font>";
			}
			echo "</td><td class='".$cell_color."' width='25%' align='center'>".showdate("shortdate",$data['nl_sub_date'])."</td>\n";
			echo "<td class='".$cell_color."' width='25%' align='center'>\n";
			if ($data['nl_sub_stat'] == 0) {
				echo "<a href='".FUSION_SELF.$aidlink."&step=1&sub_id=".$data['nl_sub_id']."&do=activate'>".$locale['nl_231']."</a>";
			}
			elseif ($data['nl_sub_stat'] == 1) {
				echo "<a href='".FUSION_SELF.$aidlink."&step=1&sub_id=".$data['nl_sub_id']."&do=deactivate'>".$locale['nl_232']."</a>";
			}
			echo " / <a href='".FUSION_SELF.$aidlink."&step=1&sub_id=".$data['nl_sub_id']."&do=delete'>".$locale['nl_239']."</a></td></tr>\n";
		}
		echo "</table>";
		if ($rows > 500) {
			echo "<div align='center' style='margin-top:5px;'>\n".makePageNav($rowstart,50,$rows,3,FUSION_SELF.$aidlink."&")."\n</div>\n";
		}
	}
	else {
		echo "<br /><br /><div style='text-align:center'>".$locale['nl_240']."<br /><br />\n";
		echo "<a href='".FUSION_SELF.$aidlink."&step=1&do=add'>".$locale['nl_223']."</a>
</div><br /><br />\n";
	}
	closetable();

	opentable($locale['nl_234']);
	$maxsub = dbrows(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS.""));
	$maxmem = dbrows(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='1'"));
	$maxgue = dbrows(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='0'"));
	$inactiv = dbrows(dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_stat='0'"));
	echo "<table border='0' cellpadding='0' cellspacing='1' class='tbl-border' width='600px' align='center'><tr>\n";
	echo "<td class='tbl1' align='center' width='25%'>".$locale['nl_235']."</td>\n";
	echo "<td class='tbl1' align='center' width='25%'>".$locale['nl_236']."</td>\n";
	echo "<td class='tbl1' align='center' width='25%'>".$locale['nl_237']."</td>\n";
	echo "<td class='tbl1' align='center' width='25%'>".$locale['nl_238']."</td>\n";
	echo "</tr><tr>\n";
	echo "<td class='tbl2' align='center' width='25%'>".$maxsub."</td>\n";
	echo "<td class='tbl2' align='center' width='25%'>".$maxmem."</td>\n";
	echo "<td class='tbl2' align='center' width='25%'>".$maxgue."</td>\n";
	echo "<td class='tbl2' align='center' width='25%'>".$inactiv."</td>\n";
	echo "</tr></table>";
	closetable();
}

require_once THEMES."templates/footer.php";
?>
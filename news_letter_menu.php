<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_menu.php
| Author: Terry Broullette(Grimloch)
| Email: webmaster@whisperwillow.com
| Website: http://www.whisperwillow.com
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
include INFUSIONS."news_letter_panel/infusion_db.php";

// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}
if (!checkrights("GNS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }
$aidlink = fusion_get_aidlink();
// Add crumb header
add_breadcrumb(array('link' => INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink, 'title' => "News Letter Main Menu"));

add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/nl_style.css' type='text/css' />");

if (isset($_POST['pub_sub'])) {
	$result = dbquery("UPDATE ".DB_NEWS_LETTER_SETTINGS." SET allow_public_subs='".$_POST['subs_allow']."'");
}

	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$allow = $data['allow_public_subs'];

opentable($locale['nl_600']);

	echo "<div align='center'><span style='background-color: #C7F3DE; font-weight: bold; font-size: 18px;'>&nbsp;".$locale['nl_602']."&nbsp;</span></div><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "1";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='sub_select' method='POST' action='".FUSION_SELF.$aidlink."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<table align='center' cellspacing='0' cellpadding='0' border='0' class='tbl-border'><tr>\n";
	echo "<td align='center' class='tbl2' colspan='3'><b>".$locale['nl_250']."</b></td>\n";
	echo "</tr><tr>\n";
	echo "<td class='tbl1'><b>".$locale['nl_861']."</b>&nbsp;</td><td class='tbl1'><input type='radio' name='subs_allow' value='0' /></td><td>&nbsp;&nbsp;&nbsp;".$locale['nl_864']."</td>\n";
	echo "</tr><tr>\n";
	echo "<td class='tbl1'><b>".$locale['nl_862']."</b>&nbsp;</td><td class='tbl1'><input type='radio' name='subs_allow' value='1' /></td><td>&nbsp;&nbsp;&nbsp;".$locale['nl_865']."</td>\n";
	echo "</tr><tr>\n";
	echo "<td class='tbl1'><b>".$locale['nl_863']."</b>&nbsp;</td><td class='tbl1'><input type='radio' name='subs_allow' value='2' /></td><td>&nbsp;&nbsp;&nbsp;".$locale['nl_866']."</td>\n";
	echo "</tr><tr>\n";
	echo "<td align='center' class='tbl2' colspan='3'><input type='submit' name='pub_sub' value='".$locale['nl_244']."' class='button'></td>\n";
	echo "</tr></table>\n";
	echo "</form><br />\n";
	echo "<div align='center'>";
if($allow == 0) {
	echo "<b>".$locale['nl_868']."</b></div>\n";
} elseif($allow == 1) {
	echo "<b>".$locale['nl_869']."</b></div>\n";
} else {
	echo "<b>".$locale['nl_870']."</b></div>\n";
}
	echo "<hr width='95%'>\n";
	echo "<table align='center' cellpadding='0' cellspacing='0' width='95%'><tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
      
closetable();

require_once THEMES."templates/footer.php";
?>
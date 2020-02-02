<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_archive_admin.php
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
//Define aidlink,
$aidlink = fusion_get_aidlink();
if (!checkrights("GNS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }

add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/nl_style.css' type='text/css' />");

define("ARCHIVE_FOLDER", INFUSIONS."news_letter_panel/archive/");
opentable($locale['nl_110']);

if (isset($_POST['delete'])) {

	$id_array = ($_POST['checkbox']);
	$id_list = implode(",",$id_array);
	$del_id = $id_list;
	$list_array = explode(",",$del_id);
	reset($list_array);

foreach($list_array AS $id2_del) {
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_ARCHIVE." WHERE id='$id2_del'");
		while($data = dbarray($result)) {
		$remove = $data['nl_content'];
	if ($remove) { @unlink(ARCHIVE_FOLDER.$remove); }
	}
	$result = dbquery("DELETE FROM ".DB_NEWS_LETTER_ARCHIVE." WHERE id='$id2_del'");
	}
}

echo "<br /><br />\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
echo "<form id='".$options['form_id']."' name='delete_select' method='POST' action='".FUSION_SELF.$aidlink."'>\n";
echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
echo "<div align='center'><span style='font-size: 20px;'>".$locale['nl_105']."</span><br /><br /><br /></div>\n";
echo "<table class='tbl-border' width='600' align='center' cellspacing='1' cellpadding='4'><tr class='tbl2'>\n";
echo "<td align='center'><strong>".$locale['nl_106']."</strong></td><td align='center'><strong>".$locale['nl_108']."</strong></td><td align='center'><strong>".$locale['nl_107']."</strong></td>\n";
echo "<tr>\n";

	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_ARCHIVE." ORDER BY datestamp DESC");
	if(dbrows($result) != 0) {
	$count = dbrows($result);
	while($data = dbarray($result)) {
	$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2");
		$id = $data['id'];
		$title = $data['nl_subject'];
		$link = $data['nl_content'];
		$sent = $data['nl_date_sent'];

echo "<tr class='$cell_color'><td align='left'><a href='".INFUSIONS."news_letter_panel/archive/$link' target='_new'><b>$title</b></a></td><td align='center'>$sent</td><td align='center'><input name='checkbox[]' type='checkbox' value='$id'></td></tr>\n";
	$i++;
	}
echo "</table><br /><br />\n";

	echo "<div style='text-align:center'>\n";
	echo "<input type='submit' id='delete' name='delete' value='".$locale['nl_244']."' class='butt2'><br /><br /></div></form><br /><hr width='90%'><br />\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 1) {
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table><br /><br />\n";
} else {
echo "<tr><td align='center' colspan='3'>".$locale['nl_111']."</td></tr></table><br /><br />\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 1) {
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
echo "</tr></table>\n";
}
closetable();
require_once THEMES."templates/footer.php";
?>
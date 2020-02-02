<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_validate_admin.php
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

opentable($locale['nl_200']);
echo "<table cellpadding='0' cellspacing='4' width='95%' align='center'><tr>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_605']."</a></td>\n";
echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_607']."</a></td>\n";
echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
echo "</table>\n";
closetable();
echo "<br />";
opentable($locale['nl_241']);

if (isset($_POST['valcode'])) {
	$code = $_POST['subscript_id'];
	$del1 = dbquery("DELETE FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_who='0' AND nl_sub_id='$code'");
	$del2 = dbquery("DELETE FROM ".DB_NEWS_LETTER_VALIDATE." WHERE subscript_id='$code'");
	echo $locale['nl_248']."<br /><br />";
}

$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_VALIDATE."");
if (dbrows($result) !=0) {
	echo "<table width='840' border='0' align='center' class='tbl-border' cellpadding='0' cellspacing='1'><tr>\n";
	echo "<td class='tbl2' width='200'>\n";
$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."' name='val_form' method='POST' action='".FUSION_SELF.$aidlink."'>".$locale['nl_224']."</td>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<td class='tbl2' width='200'>".$locale['nl_242']."</td>\n";
	echo "<td class='tbl2' width='150'>".$locale['nl_227']."</td>\n";
	echo "<td class='tbl2' width='40'>".$locale['nl_249']."</td>\n";
	echo "<td class='tbl2' width='250'>".$locale['nl_228']."</td></tr>\n";	
	while ($data = dbarray($result)) {
		$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
		$ccd = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_id='".$data['subscript_id']."'");
		$ccd_a = dbarray($ccd);
		echo "<tr><td class='".$cell_color."' width='200'><a href='mailto:".$ccd_a['nl_sub_mail']."'>".$ccd_a['nl_sub_mail']."</a></td>\n";
		echo "<td class='".$cell_color."' width='200'>".$data['validate_code']."</td>\n";
		echo "<td class='".$cell_color."' width='150'>".showdate("shortdate", $ccd_a['nl_sub_date'])."</td>\n";
		echo "<td class='".$cell_color."' width='40'>".$data['subscript_id']."</td>\n";
		echo "<td class='".$cell_color."' width='250'><input type='hidden' name='subscript_id' value='".$data['subscript_id']."'><input type='submit' name='valcode' value='".$locale['nl_239']."'></td></tr>\n";
	}
	echo "</form></table>";
}
else{
	echo "<div style='text-align:center'>".$locale['nl_243']."</div>";
}
closetable();

require_once THEMES."templates/footer.php";
?>
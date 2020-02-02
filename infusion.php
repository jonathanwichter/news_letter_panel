<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion.php
| Author: Terry Broullette(Grimloch)
| Email: webmaster@whisperwillow.com
| Web: http://www.whisperwillow.com
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) {
    die("Access Denied");
}
$settings = fusion_get_settings();
include INFUSIONS."news_letter_panel/infusion_db.php";
// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}

// Infusion Information
$inf_title = $locale['nl_100'];
$inf_description = $locale['nl_101'];
$inf_version = $locale['nl_114'];
$inf_developer = "Terry Broullette(Grimloch)";
$inf_email = "webmaster@whisperwillow.com";
$inf_weburl = "http://www.whisperwillow.com/";
$inf_folder = "news_letter_panel";
$inf_image = "nletter.png";

// Create tables
$inf_newtable[] = DB_NEWS_LETTER." (
nl_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
nl_subject VARCHAR(200) NOT NULL DEFAULT '',
nl_head VARCHAR(200) NOT NULL DEFAULT '',
nl_message TEXT NOT NULL,
nl_format VARCHAR(5) NOT NULL DEFAULT '',
nl_delivery VARCHAR(3) NOT NULL DEFAULT '',
nl_style VARCHAR(6) NOT NULL DEFAULT '',
nl_sent INT(1) UNSIGNED NOT NULL DEFAULT '0',
nl_sent_date VARCHAR(12) NOT NULL DEFAULT '',
nl_datestamp INT(10) UNSIGNED NOT NULL DEFAULT '0',
PRIMARY KEY (nl_id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";

$inf_newtable[] = DB_NEWS_LETTER_SUBS." (
nl_sub_id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
nl_sub_mail VARCHAR(100) NOT NULL DEFAULT 'user@domain.com',
nl_sub_name VARCHAR(100) NOT NULL DEFAULT '',
nl_sub_stat TINYINT(1) NOT NULL DEFAULT '0',
nl_admin_add TINYINT(1) NOT NULL DEFAULT '0',
nl_sub_date INT(10) NOT NULL DEFAULT '0',
nl_sub_who TINYINT(1) NOT NULL DEFAULT '0',
PRIMARY KEY (nl_sub_id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";

$inf_newtable[] = DB_NEWS_LETTER_VALIDATE." (
validate_id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
validate_code VARCHAR(32) NOT NULL,
subscript_id SMALLINT(5) NOT NULL,
PRIMARY KEY (validate_id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";

$inf_newtable[] = DB_NEWS_LETTER_SETTINGS." (
id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
allow_public_subs TINYINT(1) NOT NULL DEFAULT '0',
PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";

$inf_newtable[] = DB_NEWS_LETTER_ARCHIVE." (
id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
nl_subject VARCHAR(100) NOT NULL DEFAULT '',
nl_content VARCHAR(100) NOT NULL DEFAULT '',
nl_date_sent VARCHAR(12) NOT NULL DEFAULT '',
datestamp INT(10) UNSIGNED NOT NULL DEFAULT '0',
PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=UTF8 COLLATE=utf8_unicode_ci";

// Insert dbrows
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 01','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl01','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 02','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl02','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 03','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl03','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 04','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl04','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 05','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl05','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 06','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl06','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 07','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl07','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 08','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl08','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 09','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl09','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('Template 10','News Header Text - Change Me','
Erase me and replace with newsletter or notice content.','html','um1','tpl10','0','xxx xx, xxxx','".time()."')";
$inf_insertdbrow[] = DB_NEWS_LETTER_SETTINGS." (allow_public_subs) VALUES ('1')";

// Insert Sitelinks
$inf_insertdbrow[] = DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order, link_status, link_language) VALUES('".$locale['nl_470']."', 'infusions/news_letter_panel/subscribe.php', '101', '1', '0', '2', '1', '".LANGUAGE."')";
$inf_insertdbrow[] = DB_SITE_LINKS." (link_name, link_url, link_visibility, link_position, link_window, link_order, link_status, link_language) VALUES('".$locale['nl_110']."', 'infusions/news_letter_panel/news_letter_archive.php', '101', '1', '0', '2', '1', '".LANGUAGE."')";

// Insert Panel
$inf_insertdbrow[] = DB_PANELS." (panel_name, panel_filename, panel_content, panel_side, panel_order, panel_type, panel_access, panel_display, panel_status, panel_url_list, panel_restriction, panel_languages) VALUES('".$locale['nl_102']."', 'news_letter_panel.php', '', '4', '2', 'file', '0', '1', '1', '', '3', '".fusion_get_settings('enabled_languages')."')";

// Adminlink
$inf_adminpanel[] = array(
	"image" => $inf_image,
	"page" => 5,
	"rights" => "GNS",
	"title" => $locale['nl_100'],
	"panel" => "news_letter_menu.php",
);

// Deinstallation
$inf_droptable[] = DB_NEWS_LETTER;
$inf_droptable[] = DB_NEWS_LETTER_SUBS;
$inf_droptable[] = DB_NEWS_LETTER_VALIDATE;
$inf_droptable[] = DB_NEWS_LETTER_SETTINGS;
$inf_droptable[] = DB_NEWS_LETTER_ARCHIVE;
$inf_deldbrow[] = DB_ADMIN." WHERE admin_rights='GNS'";
$inf_deldbrow[] = DB_SITE_LINKS." WHERE link_url='infusions/news_letter_panel/subscribe.php'";
$inf_deldbrow[] = DB_SITE_LINKS." WHERE link_url='infusions/news_letter_panel/news_letter_archive.php'";
$inf_deldbrow[] = DB_PANELS." WHERE panel_filename='news_letter_panel'";
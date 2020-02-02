<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: infusion_db.php
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

if (!defined("DB_NEWS_LETTER")) {
	define("DB_NEWS_LETTER", DB_PREFIX."news_letter");
}
if (!defined("DB_NEWS_LETTER_SUBS")) {
	define("DB_NEWS_LETTER_SUBS", DB_PREFIX."news_letter_subs");
}
if (!defined("DB_NEWS_LETTER_VALIDATE")) {
	define("DB_NEWS_LETTER_VALIDATE", DB_PREFIX."news_letter_validate");
}
if (!defined("DB_NEWS_LETTER_SETTINGS")) {
	define("DB_NEWS_LETTER_SETTINGS", DB_PREFIX."news_letter_settings");
}
if (!defined("DB_NEWS_LETTER_ARCHIVE")) {
	define("DB_NEWS_LETTER_ARCHIVE", DB_PREFIX."news_letter_archive");
}
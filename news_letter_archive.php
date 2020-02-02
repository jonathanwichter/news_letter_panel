<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_archive.php
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
require_once THEMES."templates/header.php";
include INFUSIONS."news_letter_panel/infusion_db.php";

// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}

opentable($locale['nl_104']);

echo "<div align='center'><span style='font-size: 20px;'>".$locale['nl_105']."</span><br /><br /></div>\n";

echo "<table class='tbl-border center' width='400' cellspacing='0' cellpadding='0' border='0'><tr><td>\n";
echo "<table width='400' align='center' cellspacing='3' cellpadding='16'><tr>\n";
echo "<td align='center' class='tbl1'><strong>".$locale['nl_106']."</strong></td><td align='center' class='tbl1'><strong>".$locale['nl_108']."</strong></td>\n";
echo "</tr>\n";

	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_ARCHIVE." ORDER BY datestamp DESC");
	if(dbrows($result) != 0) {
	while($data = dbarray($result)) {
	$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2");
		$title = $data['nl_subject'];
		$link = $data['nl_content'];
		$sent = $data['nl_date_sent'];

echo "<tr><td align='left' class='$cell_color'><a href='".INFUSIONS."news_letter_panel/archive/$link' target='_new'><b>$title</b></a></td><td align='center' class='$cell_color'>$sent</td></tr>\n";
	$i++;
	}
echo "</table></td></tr></table><br /><br />\n";
closetable();
} else {
echo "<tr><td align='center' colspan='2'>".$locale['nl_111']."</td></tr>\n";
echo "</table></td></tr></table><br /><br />\n";
closetable();
}
require_once THEMES."templates/footer.php";
?>
<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) PHP-Fusion Inc
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_admin.php
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
// Add crumb header
add_breadcrumb(array('link' => INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink, 'title' => "Newsletters"));

include INFUSIONS."news_letter_panel/include/attach_include.php";
define("ARCHIVE_FOLDER", INFUSIONS."news_letter_panel/archive/");
define("ATTACH_FOLDER", INFUSIONS."news_letter_panel/attach/");
define("TEMPLATE_FOLDER", INFUSIONS."news_letter_panel/templates/");
$nl_id = (isset($_REQUEST['nl_id']) AND isnum($_REQUEST['nl_id'])) ? $_REQUEST['nl_id'] : "";
$usrtxt = isset($_REQUEST['usrtxt']) ? $_REQUEST['usrtxt'] : "";
$template = isset($_REQUEST['template']) ? $_REQUEST['template'] : "";
$style = isset($_REQUEST['style']) ? $_REQUEST['style'] : "";
$subject = isset($_REQUEST['subject']) ? $_REQUEST['subject'] : "";
$news_head = isset($_REQUEST['news_head']) ? $_REQUEST['news_head'] : "";
$send_date = isset($_REQUEST['send_date']) ? $_REQUEST['send_date'] : "";
$archive_bit = isset($_REQUEST['archive_bit']) ? $_REQUEST['archive_bit'] : "";
$addies = isset($_REQUEST['addies']) ? $_REQUEST['addies'] : "";
add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/nl_style.css' type='text/css' />");
add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/balloontip.css' type='text/css' />");
add_to_head("<script type='text/javascript' src='".INFUSIONS."news_letter_panel/include/balloontip.js'>
/***********************************************
* Rich HTML Balloon Tooltip- � Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>");

	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];

global $settings, $userdata, $locale;

if (isset($_POST['save_newsletter'])) {
	$subject = addslashes($_POST['subject']);
	$news_head = addslashes($_POST['nl_head']);
	$usrtxt = addslashes($_POST['msg']);
	$format = "html";
	$delivery = (preg_check("/^(um1|um2|um3)$/", $_POST['delivery']) ? $_POST['delivery'] : "um1");
	$time_text = "xxx xx, xxxx";
	$result = dbquery("SELECT nl_subject, nl_style  FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");
			while ($data = dbarray($result)) {
			$style = $data['nl_style'];
			$newsub = $data['nl_subject'];
	}
	if ($nl_id != '' && $_POST['subject'] == $newsub) {
	$result = dbquery("UPDATE ".DB_NEWS_LETTER." SET nl_subject='".$subject."', nl_head='".$news_head."', nl_message='".$usrtxt."', nl_format='".$format."', nl_delivery='".$delivery."', nl_style='".$style."', nl_sent_date='".$time_text."' WHERE nl_id='".$_POST['nl_id']."'");
opentable($locale['nl_411']);
	echo "<div style='text-align:center'><br />\n".$locale['nl_414']."<br /><br /></div>\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
closetable();
} else {
	$result = dbquery("INSERT INTO ".DB_NEWS_LETTER." (nl_subject, nl_head, nl_message, nl_format, nl_delivery, nl_style, nl_sent, nl_sent_date, nl_datestamp) VALUES('".$subject."', '".$news_head."', '".$usrtxt."', '".$format."', '".$delivery."', '".$style."', '0', '".$time_text."', '".time()."')");
opentable($locale['nl_410']);
	echo "<div style='text-align:center'><br />\n".$locale['nl_415']."<br /><br /></div>\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
closetable();
	}
} else if(isset($_POST['send'])) {

if(isset($_POST['archv']) && ($_POST['archv']) == "yes") {
	$num = rand(100000,999999);
	$epoch = time();
	$queit = $num."_".date("M_d_Y",$epoch);
$web_read = $queit.".html";
$archive_bit = "href='".$settings['siteurl']."infusions/news_letter_panel/archive/$web_read'>".$locale['nl_935']."";
} else {
$archive_bit = "";
}
// Switch code dependant on value of $delivery
$delivery = (preg_check("/^(um1|um2|um3)$/", $_POST['delivery']) ? $_POST['delivery'] : "um1");
// Mail send routine for single/multiple/all users
switch ($delivery) {
	case ($delivery == 'um1'):
	$error = "";
include INCLUDES."sendmail_include.php";

$epoch = time();
$sent = date("M d, Y",$epoch);
$result = dbquery("UPDATE ".DB_NEWS_LETTER." SET nl_sent='1', nl_sent_date='$sent' WHERE nl_id='".$_POST['nl_id']."'");
$result = dbquery("SELECT nl_id, nl_style, nl_sent_date FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");

	$data=dbarray($result);
	$style = $data['nl_style'];
	$send_date = $data['nl_sent_date'];
	$subject = stripslashes($_POST['subject']);
	$news_head = stripslashes($_POST['nl_head']);
	$usrtxt = stripslashes($_POST['msg']);

	if($style=="tpl01") { $template = "tpl01.php"; }
	else if($style=="tpl02") { $template = "tpl02.php"; }
	else if($style=="tpl03") { $template = "tpl03.php"; }
	else if($style=="tpl04") { $template = "tpl04.php"; }
	else if($style=="tpl05") { $template = "tpl05.php"; }
	else if($style=="tpl06") { $template = "tpl06.php"; }
	else if($style=="tpl07") { $template = "tpl07.php"; }
	else if($style=="tpl08") { $template = "tpl08.php"; }
	else if($style=="tpl09") { $template = "tpl09.php"; }
	else if($style=="tpl10") { $template = "tpl10.php"; }
	else if($style=="tpl11") { $template = "tpl11.php"; }
	else if($style=="tpl12") { $template = "tpl12.php"; }

include TEMPLATE_FOLDER."$template";

	$html_version = $content;









if(isset($_POST['archv']) && ($_POST['archv']) == "yes") {
// archive html version
		$subj = $subject;
		$qpage = $web_read;
		$webpage = $html_version;
		$nwsltr = ARCHIVE_FOLDER."$qpage";
		$handle = fopen($nwsltr, 'w') or die("File could not be created");
		fwrite($handle, $webpage);
		fclose($handle);
$archive = dbquery("INSERT INTO ".DB_NEWS_LETTER_ARCHIVE." (id, nl_subject, nl_content, nl_date_sent, datestamp) VALUES('', '".$subj."', '".$qpage."', '".$send_date."', '".time()."')");
}
// boundary 
$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$mime_boundary\"\n";
	$headers .= "Content-Transfer-Encoding: 7bit\n";
	$body	 = "This is a multi-part message in mime format.\n\n";

// text
	$body	.= "Content-Type: multipart/alternative; boundary=\"--$mime_boundary\n";
	$body	.= "Content-Type: text/plain; charset=\"us-ascii\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit";
	$body	.= "\n\n";

// html
	$body	.= "--$mime_boundary\n";
	$body	.= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit\n\n";
	$body	.= $html_version;
	$body	.= "\n\n";
	$body	.= "--$mime_boundary\n";

// attachments
if(isset($_POST['fileattach']) && ($_POST['fileattach']) == "yes") {

	if(isset($_POST['attach_files'])) {
	$file_array = ($_POST['attach_files']);
	$file_list = implode(",",$file_array);
	$my_list = $file_list;
	$new_list = explode(",",$my_list);
	reset($new_list);

		foreach($new_list AS $new_file) {
		include INFUSIONS."news_letter_panel/include/mime_type.php";
		$handle = fopen(ATTACH_FOLDER.$new_file, "rb");
		$file_data = fread($handle, filesize(ATTACH_FOLDER.$new_file));
		fclose($handle);
		$attachment = chunk_split(base64_encode($file_data));

	$body	.= "Content-Type: $mime_type;" . " name=\"$new_file\"\n" . "Content-Transfer-Encoding: base64\n" . "Content-Disposition: attachment;" . " filename=\"$new_file\"\n\n" . $attachment . "\n";
	$body	.= "--$mime_boundary\n";
		}
	}
	$body	.= "--$mime_boundary--\n";
} else {
	$body	.= "--$mime_boundary--\n";
}

	$headers .= "From: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n"; 
	$headers .= "Reply-To: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n";
	$headers .= 'Date: '.date('n/d/Y g:i A')."\n";

	$send_array = ($_POST['send_to']);
	$list = implode(",",$send_array);
	$to_email = $list;
	$list_array = explode(",",$to_email);
	reset($list_array);

foreach($list_array AS $to_mail) {
	$result = dbquery("SELECT *	FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_stat='1' AND nl_sub_mail='$to_mail'");
	if (dbrows($result)) {
		$k = 1;
		$rows = dbrows($result);
		while ($data = dbarray($result)) {
		$to = $data['nl_sub_mail'];
				if ($rows == 1 || $k == 99) {
		if (!mail($to, $subject, $body, $headers)) {
					$error = $locale['nl_417'];
				}
			}
		if ($k != 99) { $k++; } else { $k = 1; }
		$rows--;
		}
	}
}
opentable($locale['nl_412']);
	echo "<div style='text-align:center'><br />\n";
	if (!$error) {
		echo $locale['nl_416']."<br /><br />\n";
	echo "<table class='tbl-border' align='center' width='400' cellpadding='4' cellspacing='0'><tr>\n";
	echo "<td align='center'>".$locale['nl_425']."</td>\n</tr><tr>";
	echo "<td align='left'>\n";
		$rows = array_chunk($send_array, 2);
		foreach($rows  as $emails) {
    	    	    	echo implode(', ', $emails) . "<br />";
		}
	echo "</td>\n";
	echo "</tr></table><br /><br />\n";
	} else {
		echo $locale['nl_417']."<br /><br />\n".$error."<br /><br />\n";
	}
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
	echo "</div>\n";
closetable();
break;
// End members single/multiple/all user send
// Mail send routine to send to a site user group
	case ($delivery == 'um2'):
	$error = "";
include INCLUDES."sendmail_include.php";

$epoch = time();
$sent = date("M d, Y",$epoch);
$result = dbquery("UPDATE ".DB_NEWS_LETTER." SET nl_sent='1', nl_sent_date='$sent' WHERE nl_id='".$_POST['nl_id']."'");
$result = dbquery("SELECT nl_id, nl_style, nl_sent_date FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");

	$data=dbarray($result);
	$style = $data['nl_style'];
	$send_date = $data['nl_sent_date'];
	$subject = stripslashes($_POST['subject']);
	$news_head = stripslashes($_POST['nl_head']);
	$usrtxt = stripslashes($_POST['msg']);

	if($style=="tpl01") { $template = "tpl01.php"; }
	else if($style=="tpl02") { $template = "tpl02.php"; }
	else if($style=="tpl03") { $template = "tpl03.php"; }
	else if($style=="tpl04") { $template = "tpl04.php"; }
	else if($style=="tpl05") { $template = "tpl05.php"; }
	else if($style=="tpl06") { $template = "tpl06.php"; }
	else if($style=="tpl07") { $template = "tpl07.php"; }
	else if($style=="tpl08") { $template = "tpl08.php"; }
	else if($style=="tpl09") { $template = "tpl09.php"; }
	else if($style=="tpl10") { $template = "tpl10.php"; }
	else if($style=="tpl11") { $template = "tpl11.php"; }
	else if($style=="tpl12") { $template = "tpl12.php"; }

include TEMPLATE_FOLDER."$template";

	$html_version = $content;

if(isset($_POST['archv']) && ($_POST['archv']) == "yes") {
// archive html version
		$subj = $subject;
		$qpage = $web_read;
		$webpage = $html_version;
		$nwsltr = ARCHIVE_FOLDER."$qpage";
		$handle = fopen($nwsltr, 'w') or die("File could not be created");
		fwrite($handle, $webpage);
		fclose($handle);
$archive = dbquery("INSERT INTO ".DB_NEWS_LETTER_ARCHIVE." (id, nl_subject, nl_content, nl_date_sent, datestamp) VALUES('', '".$subj."', '".$qpage."', '".$send_date."', '".time()."')");
}
// boundary 
$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$mime_boundary\"\n";
	$headers .= "Content-Transfer-Encoding: 7bit\n";

	$body	 = "This is a multi-part message in mime format.\n\n";
// text
	$body	.= "Content-Type: multipart/alternative; boundary=\"--$mime_boundary\"\n";
	$body	.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit";
	$body	.= "\n\n";

// html
	$body	.= "--$mime_boundary\n";
	$body	.= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit\n\n";
	$body	.= $html_version;
	$body	.= "\n\n";
	$body	.= "--$mime_boundary\n";

// attachments
if(isset($_POST['fileattach']) && ($_POST['fileattach']) == "yes") {

	if(isset($_POST['attach_files'])) {
	$file_array = ($_POST['attach_files']);
	$file_list = implode(",",$file_array);
	$my_list = $file_list;
	$new_list = explode(",",$my_list);
	reset($new_list);

		foreach($new_list AS $new_file) {
		include INFUSIONS."news_letter_panel/include/mime_type.php";
		$handle = fopen(ATTACH_FOLDER.$new_file, "rb");
		$file_data = fread($handle, filesize(ATTACH_FOLDER.$new_file));
		fclose($handle);
		$attachment = chunk_split(base64_encode($file_data));

	$body	.= "Content-Type: $mime_type;" . " name=\"$new_file\"\n" . "Content-Transfer-Encoding: base64\n" . "Content-Disposition: attachment;" . " filename=\"$new_file\"\n\n" . $attachment . "\n\n";
	$body	.= "--$mime_boundary\n";
		}
	}
	$body	.= "--$mime_boundary--\n";
} else {
	$body	.= "--$mime_boundary--\n";
}

	$headers .= "From: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n"; 
	$headers .= "Reply-To: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n";
	$headers .= 'Date: '.date('n/d/Y g:i A')."\n";

	$group_id = ($_POST['send_to']);
	$list = implode(",",$group_id);
	$to_group = $list;
	$group_list_array = explode(",",$to_group);
	reset($group_list_array);

foreach($group_list_array AS $grpid) {
$result = dbquery("SELECT user_email FROM ".DB_USERS." WHERE user_status='0' AND user_groups REGEXP('^\\\.{$grpid}$|\\\.{$grpid}\\\.|\\\.{$grpid}$')");
	if (dbrows($result)) {
}
	while ($data = dbarray($result)) {
		$adr = $data['user_email'];
		$my_array = explode(",",$adr);
		foreach($my_array as $peeps) {
		$prep_adr = $peeps;
		$mail_array[] = $prep_adr;
	$list = implode(",",$mail_array);
	$email = $list;
	$list_array = explode(",",$email);
		}
	}
}
reset($list_array);

foreach($list_array AS $to_mail) {
	$result = dbquery("SELECT *	FROM ".DB_USERS." WHERE user_status='0' AND user_email='$to_mail'");
	if (dbrows($result)) {
}
		$k = 1;
		$rows = dbrows($result);
		while ($data = dbarray($result)) {
		$to = $data['user_email'];
				if ($rows == 1 || $k == 99) {
		if (!mail($to, $subject, $body, $headers)) {
					$error = $locale['nl_417'];
				}
			}
		if ($k != 99) { $k++; } else { $k = 1; }
		$rows--;
	}
}

opentable($locale['nl_412']);





	echo "<div style='text-align:center'><br />\n";
	if (!$error) {
		echo $locale['nl_416']."<br /><br />\n";
	echo "<table class='tbl-border' align='center' width='400' cellpadding='4' cellspacing='0'><tr>\n";
	echo "<td align='center'>".$locale['nl_426']."</td>";
	echo "</tr></table><br /><br />\n";
	} else {
		echo $locale['nl_417']."<br /><br />\n".$error."<br /><br />\n";
	}
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='17%'><a class='button' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='17%'><a class='button' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='button' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='button' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='17%'><a class='button' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
echo "<td align='center' width='17%'><a class='button' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
	echo "</div>\n";
closetable();
break;
// End sending to a user group
// Mail send routine for guest single/multiple/all send
	case ($delivery == 'um3'):
	$error = "";
include INCLUDES."sendmail_include.php";

$epoch = time();
$sent = date("M d, Y",$epoch);
$result = dbquery("UPDATE ".DB_NEWS_LETTER." SET nl_sent='1', nl_sent_date='$sent' WHERE nl_id='".$_POST['nl_id']."'");
$result = dbquery("SELECT nl_id, nl_style, nl_sent_date FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");

	$data=dbarray($result);
	$style = $data['nl_style'];
	$send_date = $data['nl_sent_date'];
	$subject = stripslashes($_POST['subject']);
	$news_head = stripslashes($_POST['nl_head']);
	$usrtxt = stripslashes($_POST['msg']);

	if($style=="tpl01") { $template = "tpl01.php"; }
	else if($style=="tpl02") { $template = "tpl02.php"; }
	else if($style=="tpl03") { $template = "tpl03.php"; }
	else if($style=="tpl04") { $template = "tpl04.php"; }
	else if($style=="tpl05") { $template = "tpl05.php"; }
	else if($style=="tpl06") { $template = "tpl06.php"; }
	else if($style=="tpl07") { $template = "tpl07.php"; }
	else if($style=="tpl08") { $template = "tpl08.php"; }
	else if($style=="tpl09") { $template = "tpl09.php"; }
	else if($style=="tpl10") { $template = "tpl10.php"; }
	else if($style=="tpl11") { $template = "tpl11.php"; }
	else if($style=="tpl12") { $template = "tpl12.php"; }

include TEMPLATE_FOLDER."$template";

	$html_version = $content;

if(isset($_POST['archv']) && ($_POST['archv']) == "yes") {
// archive html version
		$subj = $subject;
		$qpage = $web_read;
		$webpage = $html_version;
		$nwsltr = ARCHIVE_FOLDER."$qpage";
		$handle = fopen($nwsltr, 'w') or die("File could not be created");
		fwrite($handle, $webpage);
		fclose($handle);
$archive = dbquery("INSERT INTO ".DB_NEWS_LETTER_ARCHIVE." (id, nl_subject, nl_content, nl_date_sent, datestamp) VALUES('', '".$subj."', '".$qpage."', '".$send_date."', '".time()."')");
}
// boundary 
$mime_boundary = 'Multipart_Boundary_x'.md5(time()).'x';

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"$mime_boundary\"\n";
	$headers .= "Content-Transfer-Encoding: 7bit\n";

	$body	 = "This is a multi-part message in mime format.\n\n";
// text
	$body	.= "Content-Type: multipart/alternative; boundary=\"--$mime_boundary\"\n";
	$body	.= "Content-Type: text/plain; charset=\"charset=us-ascii\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit";
	$body	.= "\n\n";

// html
	$body	.= "--$mime_boundary\n";
	$body	.= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
	$body	.= "Content-Transfer-Encoding: 7bit\n\n";
	$body	.= $html_version;
	$body	.= "\n\n";
	$body	.= "--$mime_boundary\n";

// attachments
if(isset($_POST['fileattach']) && ($_POST['fileattach']) == "yes") {

	if(isset($_POST['attach_files'])) {
	$file_array = ($_POST['attach_files']);
	$file_list = implode(",",$file_array);
	$my_list = $file_list;
	$new_list = explode(",",$my_list);
	reset($new_list);

		foreach($new_list AS $new_file) {
		include INFUSIONS."news_letter_panel/include/mime_type.php";
		$handle = fopen(ATTACH_FOLDER.$new_file, "rb");
		$file_data = fread($handle, filesize(ATTACH_FOLDER.$new_file));
		fclose($handle);
		$attachment = chunk_split(base64_encode($file_data));

	$body	.= "Content-Type: $mime_type;" . " name=\"$new_file\"\n" . "Content-Transfer-Encoding: base64\n" . "Content-Disposition: attachment;" . " filename=\"$new_file\"\n\n" . $attachment . "\n\n";
	$body	.= "--$mime_boundary\n";
		}
	}
	$body	.= "--$mime_boundary--\n";
} else {
	$body	.= "--$mime_boundary--\n";
}

	$headers .= "From: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n"; 
	$headers .= "Reply-To: ".$settings['siteusername']." <".$settings['siteemail'].">\r\n";
	$headers .= 'Date: '.date('n/d/Y g:i A')."\n";

	$send_array = ($_POST['send_to']);
	$list = implode(",",$send_array);
	$to_email = $list;
	$list_array = explode(",",$to_email);
	reset($list_array);

foreach($list_array AS $to_mail) {
	$result = dbquery("SELECT *	FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_stat='1' AND nl_sub_mail='$to_mail'");
	if (dbrows($result)) {
		$k = 1;
		$rows = dbrows($result);
		while ($data = dbarray($result)) {
		$to = $data['nl_sub_mail'];
				if ($rows == 1 || $k == 99) {
		if (!mail($to, $subject, $body, $headers)) {
					$error = $locale['nl_417'];
				}
			}
		if ($k != 99) { $k++; } else { $k = 1; }
		$rows--;
		}
	}
}
opentable($locale['nl_412']);
	echo "<div style='text-align:center'><br />\n";
	if (!$error) {
		echo $locale['nl_416']."<br /><br />\n";
	echo "<table class='tbl-border' align='center' width='400' cellpadding='4' cellspacing='0'><tr>\n";
	echo "<td align='center'>".$locale['nl_425']."</td>\n</tr><tr>";
	echo "<td align='left'>\n";
		$rows = array_chunk($send_array, 2);
		foreach($rows  as $emails) {
    	    	    	echo implode(', ', $emails) . "<br />";
		}
	echo "</td>\n";
	echo "</tr></table><br /><br />\n";
	} else {
		echo $locale['nl_417']."<br /><br />\n".$error."<br /><br />\n";
	}
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
	echo "</div>\n";
closetable();
break;
default:
	echo $locale['nl_463'];
break;
}
// End all switch case code
} else if (isset($_POST['delete']) && (isset($_POST['nl_id']) && isnum($_POST['nl_id']))) {
	$result = dbquery("DELETE FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");
opentable($locale['nl_413']);
	echo "<div style='text-align:center'><br />\n".$locale['nl_420']."<br /><br />\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'>\n<tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
	echo "</div><br /><br />\n";
closetable();
} else {
	if (isset($_POST['preview']) && (isset($_POST['nl_id']) && isnum($_POST['nl_id']))) {

$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");
	$data = dbarray($result);
		$subject = html_entity_decode(stripslashes($_POST['subject']));
		$news_head = html_entity_decode(stripslashes($_POST['nl_head']));
		$usrtxt = html_entity_decode(stripslashes($_POST['msg']));
		$um1 = ($_POST['delivery'] == "um1" ? " checked" : "");
		$um2 = ($_POST['delivery'] == "um2" ? " checked" : "");
		$um3 = ($_POST['delivery'] == "um3" ? " checked" : "");
	$style = $data['nl_style'];
	$send_date = $data['nl_sent_date'];

	if($style=="tpl01") { $template = "tpl01.php"; }
	else if($style=="tpl02") { $template = "tpl02.php"; }
	else if($style=="tpl03") { $template = "tpl03.php"; }
	else if($style=="tpl04") { $template = "tpl04.php"; }
	else if($style=="tpl05") { $template = "tpl05.php"; }
	else if($style=="tpl06") { $template = "tpl06.php"; }
	else if($style=="tpl07") { $template = "tpl07.php"; }
	else if($style=="tpl08") { $template = "tpl08.php"; }
	else if($style=="tpl09") { $template = "tpl09.php"; }
	else if($style=="tpl10") { $template = "tpl10.php"; }
	else if($style=="tpl11") { $template = "tpl11.php"; }
	else if($style=="tpl12") { $template = "tpl12.php"; }

include TEMPLATE_FOLDER."$template";

	$html_version = $content;

		$message = $html_version;
		$message_preview = html_entity_decode($message);
opentable($subject.$locale['nl_405']);
	echo "<table align='center' cellpadding='0' cellspacing='0' width='100%'><tr>\n";
	echo "<td align='center' width='100%'>\n";
	echo $message_preview."\n";
	echo "</td></tr></table><br />\n";
closetable();
}
opentable($locale['nl_400']);
echo "<div style='text-align:center'><span style='background-color: #C7F3DE; font-weight: bold; font-size: 18px;'>&nbsp;".$locale['nl_602']."&nbsp;</span></div><br />\n";
	$editlist = ""; $sel = "";
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER." ORDER BY nl_datestamp DESC");
	if (dbrows($result) != 0) {
		while ($data = dbarray($result)) {
                	if (isset($_POST['nl_id']) && isnum($_POST['nl_id'])) {
			      $sel = ($_POST['nl_id'] == $data['nl_id'] ? " selected" : "");
			}
			$editlist .= "<option value='".$data['nl_id']."'$sel>".$data['nl_subject']."</option>\n";
		}
	}
	echo "<div style='text-align:center'>\n";

$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "10";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='edit_select' method='POST' action='".FUSION_SELF.$aidlink."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo $locale['nl_404']."<select id='nl_id' name='nl_id' class='textbox' style='width:250px;'>\n".$editlist."</select>\n";
	echo "<input type='submit' name='edit' value='".$locale['nl_401']."' class='butt2'>\n";
	echo "<input type='submit' name='delete' value='".$locale['nl_402']."' onclick='return DeleteNewsletter();' class='butt2'>\n";
	echo "</form>\n";
	echo "<table align='center' cellpadding='0' cellspacing='0' width='600'><tr>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_604']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
if($pub_allow == 1) {
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='20%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_uploads.php".$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table>\n";
	echo "</div>\n";
closetable();
	if (isset($_POST['edit']) && (isset($_POST['nl_id']) && isnum($_POST['nl_id']))) {
		$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER." WHERE nl_id='".$_POST['nl_id']."'");
		if (dbrows($result) != 0) {
			$data = dbarray($result);
			$nl_id = $data['nl_id'];
			$style = $data['nl_style'];

	if($style=="tpl01") { $template = "tpl01.php"; }
	else if($style=="tpl02") { $template = "tpl02.php"; }
	else if($style=="tpl03") { $template = "tpl03.php"; }
	else if($style=="tpl04") { $template = "tpl04.php"; }
	else if($style=="tpl05") { $template = "tpl05.php"; }
	else if($style=="tpl06") { $template = "tpl06.php"; }
	else if($style=="tpl07") { $template = "tpl07.php"; }
	else if($style=="tpl08") { $template = "tpl08.php"; }
	else if($style=="tpl09") { $template = "tpl09.php"; }
	else if($style=="tpl10") { $template = "tpl10.php"; }
	else if($style=="tpl11") { $template = "tpl11.php"; }
	else if($style=="tpl12") { $template = "tpl12.php"; }

include TEMPLATE_FOLDER."$template";

			$subject = html_entity_decode(stripslashes($data['nl_subject']));
			$news_head = html_entity_decode(stripslashes($data['nl_head']));
			$usrtxt = html_entity_decode(stripslashes($data['nl_message']));
			$um1 = ($data['nl_delivery'] == "um1" ? " checked='checked'" : "");
			$um2 = ($data['nl_delivery'] == "um2" ? " checked='checked'" : "");
			$um3 = ($data['nl_delivery'] == "um3" ? " checked='checked'" : "");
		}
	}
	if ((isset($_POST['nl_id']) && isnum($_POST['nl_id'])) || (isset($_GET['nl_id']) && isnum($_GET['nl_id']))) {
		opentable($locale['nl_411']);
	} else {
		if (!isset($_POST['preview'])) {
			$subject = "";
			$news_head = "";
			$usrtxt = "";
			$um1 = "";
			$um2 = "";
			$um3 = "";
		}
		$action = FUSION_SELF;
opentable($locale['nl_410']);
}

$options['form_id'] = rand(100000,900000);
$options['max_tokens'] = "1";
$token = \Defender\Token::generate_token($options['form_id'], $options['max_tokens']);
	echo "<form id='".$options['form_id']."'  name='nlform' method='POST' action='".FUSION_SELF.$aidlink."'>\n";
	echo "<input type='hidden' name='fusion_token' value='".$token."' />\n";
	echo "<input type='hidden' name='form_id' value='".$options['form_id']."' />\n";
	echo "<div id='balloon1' class='balloonstyle'>".$locale['nl_928']."</div>\n";
	echo "<div id='balloon2' class='balloonstyle'>".$locale['nl_929']."</div>\n";
	echo "<div id='balloon3' class='balloonstyle'>".$locale['nl_930']."</div>\n";
	echo "<div id='balloon4' class='balloonstyle'>".$locale['nl_931']."</div>\n";
	echo "<div id='balloon5' class='balloonstyle'>".$locale['nl_932']."</div>\n";
	echo "<div id='balloon6' class='balloonstyle'>".$locale['nl_933']."</div>\n";
	echo "<div id='balloon7' class='balloonstyle'>".$locale['nl_934']."</div>\n";
	echo "<table align='center' cellspacing='0' cellpadding='0' border='1'><tr>\n";
	echo "<td class='tbl2' valign='top'><a rel='balloon1' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_429']."</td>\n";
	echo "<td class='tbl1' valign='top'>\n";
        if (isset($nl_id)) { echo "<input type='hidden' name='nl_id' value=".$nl_id.">"; }
	echo "<input type='text' name='subject' value='$subject' class='textbox' style='width:600px;'></td>\n";
	echo "</tr><tr>\n";
// Newsletter heading text
	echo "<td class='tbl2' valign='top' align='left'><a rel='balloon2' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_650']."</td>\n";
	echo "<td class='tbl1'><input type='text' name='nl_head' value='$news_head' class='textbox' style='width:600px;'></td></tr>\n";
// End Newsletter heading text
// Setting archive bit
	echo "<tr><td class='tbl2' valign='top' align='left'><a rel='balloon3' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_651']."</td>\n";
	echo "<td class='tbl1' valign='top' align='left'>".$locale['nl_652']."&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='archv' value='yes' /> ".$locale['nl_406']."<img src='".INFUSIONS."news_letter_panel/images/clearpix.gif' width='20' height='1' alt='' /><input type='radio' name='archv' value='no' checked /> ".$locale['nl_407']."</td>\n";
// End archive bit
	echo "</tr><tr>\n";
// Select site users single/multiple/all send
	echo "<td class='tbl2' valign='top' align='left'><a rel='balloon4' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_464']."</td><td class='tbl1' valign='top' align='left'><table cellspacing='0' cellpadding='0' border='0'><tr>\n";
	echo "<td valign='top' align='left' width='260'><input type='radio' name='delivery' value='um1'".$um1." checked />&nbsp;".$locale['nl_442']."</td>\n";
	echo "<td valign='top' align='center'><select name='send_to[]'  multiple='true' size='6' class='textbox' style='width:295px;'>";
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_stat ='1' AND nl_sub_who='1' ORDER BY nl_sub_name");
	if (dbrows($result) != 0) {
	while ($data = dbarray($result)) {
            $selected = (isset($_GET['nl_sub_mail']) && $_GET['nl_sub_mail'] == $data['nl_sub_mail']) ? 'selected="selected"' : '';
            echo "<option value='".$data['nl_sub_mail']."'$selected>".$data['nl_sub_name']." - ".$data['nl_sub_mail']."</option>\n";
          }
}
	echo "</select></td></tr></table></td>\n";
	echo "</tr><tr>\n";
// End select site users single/multiple/all send
// Select site user group
	echo "<td class='tbl2' valign='top' align='left'><a rel='balloon5' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_465']."</td><td class='tbl1' valign='top' align='left'><table cellspacing='0' cellpadding='0' border='0'><tr>\n";
	echo "<td valign='top' align='left' width='260'><input type='radio' name='delivery' value='um2'".$um2.">&nbsp;".$locale['nl_443']."</td>\n";
	echo "<td valign='top' align='center'><select name='send_to[]' multiple='true' size='6' class='textbox' style='width:295px;'>";
	$result = dbquery("SELECT group_id, group_name FROM ".DB_USER_GROUPS." ORDER BY group_name");
	if (dbrows($result)) {
		$sel = "";
		while ($data = dbarray($result)) {
			if (isset($_GET['group_id']) && isnum($_GET['group_id'])) $sel = ($_GET['group_id'] == $data['group_id'] ? " selected='selected'" : "");
			echo "<option value='".$data['group_id']."'$sel>".$data['group_name']."</option>\n";
	}

}
	echo "</select>\n";
	echo "</td></tr></table></td>\n";
	echo "</tr><tr>\n";
// End select site user group
if($pub_allow > 0) {
// Select site guest single/multiple/all send auto setting
	echo "<td class='tbl2' valign='top' align='left'><a rel='balloon6' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_466']."</td><td class='tbl1' valign='top' align='left'><table cellspacing='0' cellpadding='0' border='0'><tr>\n";
	echo "<td valign='top' align='left' width='260'><input type='radio' name='delivery' value='um3'".$um3." />&nbsp;".$locale['nl_444']."</td>\n";
	echo "<td valign='top' align='center'><select name='send_to[]'  multiple='true' size='6' class='textbox' style='width:295px;'>";
	$result = dbquery("SELECT * FROM ".DB_NEWS_LETTER_SUBS." WHERE nl_sub_stat ='1' AND nl_sub_who='0' ORDER BY nl_sub_name");
	if (dbrows($result) != 0) {
	while ($data = dbarray($result)) {
            $selected = (isset($_GET['nl_sub_mail']) && $_GET['nl_sub_mail'] == $data['nl_sub_mail']) ? 'selected="selected"' : '';
            echo "<option value='".$data['nl_sub_mail']."'$selected>".$data['nl_sub_name']." - ".$data['nl_sub_mail']."</option>\n";
          }
}
	echo "</select>\n";
	echo "</td></tr></table>\n";
// End select site guest single/multiple/all send
	echo "</td></tr><tr>\n";
}
// Select file attachments
	echo "<td class='tbl2' valign='top' align='left'><a rel='balloon7' href=''><img src='images/help.png' border='0' alt='' /></a>&nbsp;".$locale['nl_860']."</td><td class='tbl1' valign='top' align='left'><table cellspacing='0' cellpadding='0' border='0'><tr>\n";
	echo "<td valign='top' align='left' width='260'><input type='radio' name='fileattach' value='yes' /> ".$locale['nl_406']."<img src='".INFUSIONS."news_letter_panel/images/clearpix.gif' width='20' height='1' alt='' /><input type='radio' name='fileattach' value='no' checked /> ".$locale['nl_407']."</td>\n";
	echo "<td align='left'>\n";
    $attach_list = load_Attach();
    if(is_array($attach_list))
    {
	echo "<select name='attach_files[]'  multiple='true' size='6' class='textbox' style='width:295px;'>";
        foreach($attach_list AS $file)
        {
            $selected = (isset($_POST['attach_files']) && $_POST['attach_files'] == $file ) ? 'selected="selected"' : '';

            echo "<option value='$file'$selected>$file</option>\n";
          }
}
	echo "</select>\n";
	echo "</td>\n</tr></table>\n";
	echo "</td>\n";
// End file attachments
	echo "</tr><tr>\n";
	echo "<td class='tbl2' valign='middle' align='left'>".$locale['nl_431']."</td>\n";
	echo "<td class='tbl1'><textarea id='msg' name='msg' cols='95' rows='10' class='textbox'>".html_entity_decode(stripslashes($usrtxt))."</textarea></td>\n";






	echo "</tr><tr>\n";
	echo "<td class='tbl2' valign='middle'>".$locale['nl_432']."</td>\n";
// Begin html buttons
require_once INFUSIONS."news_letter_panel/include/html_buttons.php";
	echo "<td class='tbl1' align='left'>".display_html("nlform", "msg", true, true, true, null)."</td>\n";
// End buttons colors and smileys
	echo "</tr><tr>\n";
	echo "<td class='tbl3' align='center' colspan='2'>\n";
	echo "<input class='butt2' type='submit' name='preview' value='".$locale['nl_436']."' />&nbsp;&nbsp;&nbsp;<input class='butt2' type='submit' name='save_newsletter' value='".$locale['nl_437']."' />&nbsp;&nbsp;&nbsp;\n";
	echo "<input class='butt2' type='submit' name='send' value='".$locale['nl_438']."' />&nbsp;&nbsp;&nbsp;<input class='butt2' type='reset' name='reset' value='".$locale['nl_439']."' /></td>\n";
	echo "</tr></table><br /><br />\n";
echo "</form>\n";
closetable();
}
require_once THEMES."templates/footer.php";
?>
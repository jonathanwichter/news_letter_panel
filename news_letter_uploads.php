<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright � 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: news_letter_uploads.php
| Author: Grimloch, Wooya
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
include INFUSIONS."news_letter_panel/include/functions.php";
//if (file_exists(INFUSIONS."news_letter_panel/locale/".$settings['locale'].".php")) {
	//include INFUSIONS."news_letter_panel/locale/".$settings['locale'].".php";
//} else {
	include INFUSIONS."news_letter_panel/locale/English/English.php";
//}
if (!checkrights("GNS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }
add_to_head("<link rel='stylesheet' href='".INFUSIONS."news_letter_panel/include/nl_style.css' type='text/css' />");

global $locale, $settings;

$upload_folder = isset($_REQUEST['upload_folder']) ? $_REQUEST['upload_folder'] : "";
$error = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";
$del_stat = isset($_REQUEST['del_stat']) ? $_REQUEST['del_stat'] : "";
$up_stat = isset($_REQUEST['up_stat']) ? $_REQUEST['up_stat'] : "";

$maxup = return_bytes(ini_get('post_max_size'));

if (!isset($_GET['upload_folder'])) { $upload_folder = INFUSIONS."news_letter_panel/attach/"; }

if (isset($_GET['del'])) {
	@unlink($_GET['del']);
	if(!file_exists($_GET['del'])) {
		$disply = $locale['nl_804'];
		$del_stat = $locale['nl_807'];
	} else {
		$disply = $locale['nl_805'];
		$del_stat = $locale['nl_808'];
}
opentable($locale['nl_806']);
	echo "<div style='text-align:center'><br /><strong>".$del_stat."</strong><br /><br />".$disply."<br /><br />\n";
	echo "<a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_604']."</a>&nbsp;&nbsp;&nbsp;<a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_802']."</a></div><br /><br />\n";
closetable();
	
} else if(isset($_POST['upload_file'])) {

if (substr($settings['version'], 2,2) == '02') {
require_once INCLUDES."infusions_include.php";
}
	$error = 0;
if (is_uploaded_file($_FILES['upload']['tmp_name'])) {
	$source_file = $_FILES['upload'];
	$file_type = array(".txt",".htm",".html",".php",".css",".js",".json",".xml",".swf",".flv",".png",".jpe",".jpeg",".jpg",".gif",".bmp",".ico",".tiff",".tif",".svg",".svgz",
".zip",".rar",".tar",".bz2",".7z",".mp2",".mpa",".mpe",".mpeg",".mpg",".mpv2",".mp3",".mid",".rmi",".ra",".ram",".qt",".mov",".movie",".pdf",".psd",".ai",".eps",".ps",".dot",".doc",".docx",".mdb",".rtf",".xla",".xlc",".xlm",".xls",".xlt",".xlw",".ppt",".pps",".pot",".doc",".docx");
	$upload_file = str_replace(" ", "_", strtolower(substr($source_file['name'], 0, strrpos($source_file['name'], "."))));
	$file_ext = strtolower(strrchr($source_file['name'],"."));
	$target_dir = INFUSIONS.'news_letter_panel/attach/';
		if (!preg_match("/^[-0-9a-z_\.\[\]]+$/i", $upload_file)) { $error = 1; }
		elseif ($source_file['size'] > $maxup) { $error = 2; }
		elseif (!in_array($file_ext, $file_type)) { $error = 3; }
	if($error == 0) {
	$up_stat = $locale['nl_823']; $disply = $locale['nl_827'];
	$upload_name = filename_exists($target_dir, $upload_file.$file_ext);
	move_uploaded_file($source_file['tmp_name'], $target_dir.$upload_name);
	} else if($error == 1) {
		$up_stat = $locale['nl_810']; $disply = $locale['nl_825']; }
	else if($error == 2) {
		$up_stat = $locale['nl_811']; $disply = $locale['nl_825']; }
	else if($error == 3) {
		$up_stat = $locale['nl_812']; $disply = $locale['nl_825']; }
}
opentable($locale['nl_820']);
	echo "<div style='text-align:center'><br /><strong>".$up_stat."</strong><br /><br />".$disply."<br /><br />\n";
	echo "<a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_604']."</a>&nbsp;&nbsp;&nbsp;<a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_802']."</a></div><br /><br />\n";
closetable();
} else {

opentable($locale['nl_603']);
	echo "<div align='center'><strong>".$locale['nl_602']."</strong><br /><br /></div>\n";
	echo "<table align='center' cellpadding='0' cellspacing='4' width='95%'><tr>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_menu.php".$aidlink."'>".$locale['nl_603']."</a></td>\n";
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_admin.php".$aidlink."'>".$locale['nl_605']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_archive_admin.php".$aidlink."'>".$locale['nl_609']."</a></td>\n";
	echo "<td align='center' width='16%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_subs.php".$aidlink."'>".$locale['nl_606']."</a></td>\n";
	$result = dbquery("SELECT allow_public_subs FROM ".DB_NEWS_LETTER_SETTINGS."");
	$data=dbarray($result);
	$pub_allow = $data['allow_public_subs'];
if($pub_allow == 0) {
	echo "<td align='center' width='17%'><a class='butt2' href='".INFUSIONS."news_letter_panel/news_letter_validate_admin.php".$aidlink."'>".$locale['nl_607']."</a></td>\n";
}
	echo "<td align='center' width='17%'><a class='butt2' href='".FUSION_SELF.$aidlink."'>".$locale['nl_608']."</a></td>\n";
	echo "</tr></table><br /><br />\n";
closetable();

	opentable($locale['nl_820']." <span class='small'>".$locale['nl_822']."$maxup</span>");
		





echo "<form name='uploadform' method='post' action='".FUSION_SELF.$aidlink."' enctype='multipart/form-data'>
		<table style='width:500px' align='center' cellspacing='0' cellpadding='0' class='tbl'>
		<tr>
		<td colspan='2'><div style='text-align:center'>".$locale['nl_826']."</div></td>
		<tr>
		<td colspan='2'><input type='hidden' name='upload_folder' value='".$upload_folder."' />
		</td>
		</tr><tr>
		<td align='center' colspan='2'><br /><strong>".$locale['nl_829']."</strong><br /><br /></td>
		</tr><tr>
		<td align='right'>".$locale['nl_821']."&nbsp;&nbsp;&nbsp;</td>
		<td><input type='file' name='upload' class='textbox' style='width:250px;' /></td>
		</tr>
		<tr>
		<td align='center' colspan='2'><br /><br />
		<input type='submit' name='upload_file' value='".$locale['nl_820']."' class='butt2' style='width:100px;' /><br />
		</td>
		</tr>
		</table></form>\n";
	
closetable();

// files in upload folder
	$updir_list[] = $upload_folder;
	$file_list[] = $upload_folder;
	for ($i=0; $i < sizeof($updir_list); $i++) {
		if ($handle = opendir($updir_list[$i])) {
			while (false !== ($file = readdir($handle))) {
				if (!in_array($file, array(".", "..", "/", "index.php"))) {
					if (is_dir($updir_list[$i].$file)) {
						$file_list[] = $updir_list[$i].$file."/";
					} else {
						$file_list[] = $updir_list[$i].$file;
					}
				}
			}
		}
		closedir($handle);
	}
	for ($i=0; $i < sizeof($file_list); $i++) {
		$sort = strpos(str_replace($upload_folder,"",$file_list[$i]),'/') ? strpos(str_replace($upload_folder,"",$file_list[$i]),'/') : 0;
		$get_folder[] = $sort."|".$file_list[$i];
	}
	if (isset($get_folder)) sort($get_folder);
	if (!isset($_GET['open_folder'])) $_GET['open_folder'] = $upload_folder;
	 
opentable($locale['nl_840']);
		echo "<br /><br /><table style='width:500px' align='center' cellpadding='0' cellspacing='1' class='tbl-border'><tr>
		<td class='tbl2' style='width:350px'><span style='font-weight:bold;'>".$locale['nl_841']."</span></td>
		<td class='tbl2' style='width:100px' align='center'><span style='font-weight:bold;'>".$locale['nl_842']."</span></td>
		<td class='tbl2' style='width:50px' align='center'><span style='font-weight:bold;'>".$locale['nl_843']."</span></td>
		</tr>\n";
		$i = 0;
		if (!isset($get_folder)) { $file_count = 0; } else { $file_count = count($get_folder); }
		for ($i=0; $i < $file_count; $i++) {
			$get_folder[$i]=substr($get_folder[$i],strpos($get_folder[$i],'|')+1,strlen($get_folder[$i]));
			$file_size = filesize($get_folder[$i]);
			if (is_dir($get_folder[$i])) {
				if ($i != 0) {
					echo "</table>\n</td>\n</tr>\n";
				}
				if ($_GET['open_folder'] == $get_folder[$i]) {
					$of = 'off';
					$dsply = 'block';
				} else {
					$of = 'on';
					$dsply = 'none';
				}
				echo "<tr>";
			if ($upload_folder==$get_folder[$i]) {
				echo "<td colspan='2' class='tbl1'><span style='font-weight:bold;'>".$locale['nl_835']."</span><i>".str_replace('../','',$get_folder[$i])."</i></td>\n";
				echo "<td class='tbl1'><img src='".THEME."images/panel_$of.gif' name='b_$i' alt='' onClick=\"flipBox($i);\" /></td>\n";
			} else {
				echo "<td style='width:350px' class='tbl1'><span style='font-weight:bold;'>".$locale['nl_835']."</span><i>".str_replace('../','',$get_folder[$i])."</i></td>\n";
				echo "<td align='center' class='tbl1'><a href='".FUSION_SELF.$aidlink."&amp;delfol=".$get_folder[$i]."' onClick=\"return DeleteItem('dir');\">".$locale['nl_844']."</a></td>\n";
				echo "<td class='tbl1'><img src='".THEME."images/panel_$of.gif' name='b_$i' alt='' onClick=\"flipBox($i);\" /></td>\n";
			}
				echo "</tr>\n";
				echo "<tr>\n";
				echo "<td style='width:350px' colspan='3'>\n";
				echo "<div id='box_$i' style='display:$dsply'>\n";
				echo "<table width='100%' cellspacing='1' cellpadding='0'>\n";
			} else {
				$only_file = substr(str_replace($upload_folder,"",$get_folder[$i]), strpos(str_replace($upload_folder,"",$get_folder[$i]),'/'),strlen($get_folder[$i]));
				echo "<tr>\n";
				echo "<td style='width:350px' class='tbl2'><a href='".$get_folder[$i]."' target='_blank'>".str_replace('/','',$only_file)."</a></td>\n";
				echo "<td style='width:100px;' align='center' class='tbl2'>".($file_size > 0 ? parseByteSize($file_size) : "-----")."</td>\n";
				echo "<td style='width:50px' align='center' class='tbl2'><a href='".FUSION_SELF.$aidlink."&amp;del=".$get_folder[$i]."' onClick=\"return DeleteItem('file');\">".$locale['nl_844']."</a></td>\n";
				echo "</tr>\n";
			}
		}
		echo "</table></div>\n</td></tr></table><br /><br />\n";
	closetable();
	echo "<script type='text/javascript'>
	function DeleteItem(item) {
		if (item == 'file') {
			return confirm('".$locale['nl_850']."');
		} else {
			return confirm('".$locale['nl_851']."');
		}
	}
	</script>\n";
}
require_once THEMES."templates/footer.php";
?>
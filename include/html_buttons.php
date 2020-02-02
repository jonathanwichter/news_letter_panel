<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2012 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: html_buttons.php
| Author: Nick Jones (Digitanium)
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

// Locale
if (file_exists(INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php")) {
    include INFUSIONS."news_letter_panel/locale/".LOCALESET."English.php";
} else {
    include INFUSIONS."news_letter_panel/locale/English/English.php";
}

function display_html($formname, $textarea, $html = true, $colors = false, $smiles = false, $folder = "") {

global $settings, $locale; $res = "";

if ($html) {
	$res .= "<input type='button' value='break' class='butt1' onclick=\"addText('".$textarea."', '&lt;br&gt;', '', '".$formname."');\" />\n";
	$res .= "<input type='button' value='indent' class='butt1' onclick=\"addText('".$textarea."', '&lt;p style=\'text-indent: 40px;\'&gt;', '&lt;/p&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='p' class='butt1' onclick=\"addText('".$textarea."', '&lt;p&gt;', '&lt;/p&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='div' class='butt1' onclick=\"addText('".$textarea."', '&lt;div&gt;', '&lt;/div&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='table' class='butt1' onclick=\"addText('".$textarea."', '&lt;table align=\'center\' border=\'0\'&gt;', '&lt;/table&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='tr' class='butt1' onclick=\"addText('".$textarea."', '&lt;tr&gt;', '&lt;/tr&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='td' class='butt1' onclick=\"addText('".$textarea."', '&lt;td align=\'center\'&gt;', '&lt;/td&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='ul' class='butt1' onclick=\"addText('".$textarea."', '&lt;ul&gt;', '&lt;/ul&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='ol' class='butt1' onclick=\"addText('".$textarea."', '&lt;ol&gt;', '&lt;/ol&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='li' class='butt1' onclick=\"addText('".$textarea."', '&lt;li&gt;', '&lt;/li&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='font' class='butt1' onclick=\"addText('".$textarea."', '&lt;font size=\'\' color=\'\'&gt;', '&lt;/font&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='bold' class='butt1' style='font-weight:bold;' onclick=\"addText('".$textarea."', '&lt;b&gt;', '&lt;/b&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='italic' class='butt1' style='font-style:italic;' onclick=\"addText('".$textarea."', '&lt;i&gt;', '&lt;/i&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='underline' class='butt1' style='text-decoration:underline;' onclick=\"addText('".$textarea."', '&lt;u&gt;', '&lt;/u&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='link' class='butt1' onclick=\"addText('".$textarea."', '&lt;a href=\'', '\' target=\'_blank\'>Link&lt;/a&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='image' class='butt1' onclick=\"addText('".$textarea."', '&lt;img src=\'".str_replace("../","",$folder)."', '\' style=\'margin:5px\' alt=\'\' align=\'left\' /&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='center' class='butt1' onclick=\"addText('".$textarea."', '&lt;center&gt;', '&lt;/center&gt;', '".$formname."');\" />\n";
	$res .= "<input type='button' value='small' class='butt1' onclick=\"addText('".$textarea."', '&lt;span class=\'small\'&gt;', '&lt;/span&gt;', '".$formname."');\" />\n";
}

if ($html && ($colors || $smiles)) { $res .= "<br /><br />\n"; }

if ($colors) {
	$res .= "<select name='setcolor' class='textbox' style='margin-top:5px' onchange=\"addText('".$textarea."', '&lt;span style=\'color:' + this.options[this.selectedIndex].value + '\'&gt;', '&lt;/span&gt;', '".$formname."');this.selectedIndex=0;\">\n";
	$res .= "<option value=''>".$locale['html400']."</option>\n";
	$res .= "<option value='maroon' style='color:maroon'>".$locale['html402']."</option>\n";
	$res .= "<option value='red' style='color:red'>".$locale['html403']."</option>\n";
	$res .= "<option value='orange' style='color:orange'>".$locale['html404']."</option>\n";
	$res .= "<option value='brown' style='color:brown'>".$locale['html405']."</option>\n";
	$res .= "<option value='yellow' style='color:yellow'>".$locale['html406']."</option>\n";
	$res .= "<option value='green' style='color:green'>".$locale['html407']."</option>\n";
	$res .= "<option value='lime' style='color:lime'>".$locale['html408']."</option>\n";
	$res .= "<option value='olive' style='color:olive'>".$locale['html409']."</option>\n";
	$res .= "<option value='cyan' style='color:cyan'>".$locale['html410']."</option>\n";
	$res .= "<option value='blue' style='color:blue'>".$locale['html411']."</option>\n";
	$res .= "<option value='navy' style='color:navy'>".$locale['html412']."</option>\n";
	$res .= "<option value='purple' style='color:purple'>".$locale['html413']."</option>\n";
	$res .= "<option value='violet' style='color:violet'>".$locale['html414']."</option>\n";
	$res .= "<option value='black' style='color:black'>".$locale['html415']."</option>\n";
	$res .= "<option value='gray' style='color:gray'>".$locale['html416']."</option>\n";
	$res .= "<option value='silver' style='color:silver'>".$locale['html417']."</option>\n";
	$res .= "<option value='white' style='color:white'>".$locale['html418']."</option>\n";
	$res .= "<option value='crimson' style='color:crimson'>".$locale['html419']."</option>\n";
	$res .= "<option value='firebrick' style='color:firebrick'>".$locale['html420']."</option>\n";
	$res .= "<option value='magenta' style='color:magenta'>".$locale['html421']."</option>\n";
	$res .= "</select>\n";
}

if ($html && ($colors || $smiles)) { $res .= "<br /><br />\n"; }

if ($smiles) {
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi01.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi01.gif\' width=\'40\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi02.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi02.gif\' width=\'45\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi03.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi03.gif\' width=\'19\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi04.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi04.gif\' width=\'39\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi05.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi05.gif\' width=\'22\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi06.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi06.gif\' width=\'43\' height=\'18\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi07.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi07.gif\' width=\'19\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi08.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi08.gif\' width=\'26\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi09.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi09.gif\' width=\'35\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi10.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi10.gif\' width=\'42\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi11.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi11.gif\' width=\'30\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi12.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi12.gif\' width=\'19\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi13.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi13.gif\' width=\'35\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi14.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi14.gif\' width=\'36\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi15.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi15.gif\' width=\'35\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi16.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi16.gif\' width=\'50\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi17.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi17.gif\' width=\'26\' height=\'20\' alt=\'\' />', 'nlform');\" /><br />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi18.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi18.gif\' width=\'32\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi19.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi19.gif\' width=\'19\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi20.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi20.gif\' width=\'29\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi21.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi21.gif\' width=\'19\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	$res .="<img src='".INFUSIONS."news_letter_panel/images/smi22.gif' onClick=\"insertText('msg', '<img src=\'".$settings['siteurl']."infusions/news_letter_panel/images/smi22.gif\' width=\'35\' height=\'20\' alt=\'\' />', 'nlform');\" />\n";
	}

	return $res;
}
?>
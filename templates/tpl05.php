<?php

$content = "<html>\n";

$content .= "<head>\n";

$content .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";

$content .= "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n";

$content .= "<title>$subject</title>\n";

$content .= "</head>\n";

$content .= "<body bgcolor='#000000'>\n";

$content .= "<table border='0' cellspacing='0' cellpadding='0' width='100%' height='auto' bgcolor='#d7eae9'><tr>\n";

$content .= "<td align='center'>\n";

$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr>\n";

$content .= "<td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:10px;line-height:18px;color:#000000;'><span style='color:#000000; font-size: 10px;'>".$locale['nl_913']."</span><br><br></td></tr>\n";

$content .= "<tr><td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;'>\n";

$content .= "<a style='color: #000099;' $archive_bit</a>\n";

$content .= "<br><br></td></tr></table>\n";

$content .= "<table width='100%' bgcolor='#d7eae9' border='0' cellpadding='0' cellspacing='0'><tr>\n";

$content .= "<td width='100%' align='center'>\n";

$content .= "<table width='600' bgcolor='#7d4636' border='0' cellpadding='0' cellspacing='0'><tr>\n";

$content .= "<td width='600' height='3' bgcolor='#000000'></td></tr>\n";

$content .= "<tr><td style='font-family:Verdana, Geneva, sans-serif;font-size:18px;line-height:18px;color:#7d4636;' bgcolor='#7d4636' align='center' width='600' valign='top'><img src='https://buhlmodeltrainsociety.com/v9/images/newsletterbanner.png' height= '250'/>".$settings['sitename']."<p></td></tr>\n";

$content .= "<tr><td bgcolor='#7d4636' align='center' width='600' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:18px;line-height:18px;color:#000000;'><span style='color:#ffffff; font-size: 18px;'>$news_head</span></td></tr>\n";

$content .= "<tr><td bgcolor='#7d4636' align='center' width='600' valign='top'><table width='570'><tr>\n";

$content .= "<td bgcolor='#7d4636' align='right' width='100%' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:9px;line-height:18px;color:#000000;'><span style='color:#ffffff; font-size: 9px;'><b>".$locale['nl_112']." $send_date</b></span></td></tr>\n";

$content .= "</table></td></tr>\n";
$content .= "<tr><td align='center' width='600' valign='top' bgcolor='#ffffff'><table width='570'><tr>\n";

$content .= "<td align='left' width='100%' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;color:#000000;'><br><span style='color:#000000; font-size: 13px;'>$usrtxt</span></td></tr>";


$content .= "<tr><td width='100%'><br></td></tr></table></td></tr>\n";

$content .= "<tr><td align='center' width='600' valign='top' bgcolor='#7d4636'><br><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_920']."</span>\n";

$content .= "<a style='color: #0000dd;' href='mailto:".$settings['siteemail']."'><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_923']."</span></a><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_921']."</span></td></tr>\n";

$content .= "<tr><td align='center' width='600' valign='top' bgcolor='#7d4636'><br><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_900']." ".$settings['sitename']."<br>".$locale['nl_924']."</span>\n";

$content .= "<a style='color: #0000dd;' href='".$settings['siteurl']."'><span style='color:#ffffff; font-size: 11px;'>".$settings['siteurl']."</span></a><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_901']."</span><br><br></td></tr>\n";

$content .= "<tr><td width='600' height='3' bgcolor='#000000'></td>\n";

$content .= "</tr></table></td></tr></table>\n";

$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' style='font-family:Verdana, Geneva, sans-serif;font-size:11px;line-height:18px;color:#000000;'><br><br><span style='color:#000000; font-size: 11px;'>".$locale['nl_902']."</span><br><br>\n";

$content .= "<a style='color: #000099;' href='".$settings['siteurl']."infusions/news_letter_panel/unsubscribe.php'><span style='color:#000099; font-size: 11px;'>".$locale['nl_903']."</span></a><br><br>\n";

$content .= " <a style='color: #000099;' href='".$settings['siteurl']."privacy_policy.php'><span style='color:#000099; font-size: 11px;'>".$locale['nl_904']."</span></a>\n";

$content .= "<br><br></td></tr></table>\n";

$content .= "</td></tr></table>\n";

$content .= "</body></html>\n";

?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
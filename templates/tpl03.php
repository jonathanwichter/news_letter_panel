<?php
$content = "<html>\n";
$content .= "<head>\n";
$content .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
$content .= "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n";
$content .= "<title>$subject</title>\n";
$content .= "</head>\n";
$content .= "<body bgcolor='#c0c0c0'>\n";
$content .= "<table border='0' cellspacing='0' cellpadding='0' width='100%' height='auto' bgcolor='#c0c0c0'><tr>\n";
$content .= "<td align='center'><table align='center' border='0' cellspacing='0' cellpadding='0'><tr>\n";
$content .= "<td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:10px;line-height:18px;color:#000000;'><span style='color:#000000; font-size: 10px;'>".$locale['nl_913']."<span><br><br></td></tr>\n";
$content .= "<tr><td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;'>\n";
$content .= "<a style='color: #000099;' $archive_bit</a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "<table bgcolor='#c0c0c0' border='0' cellspacing='0' cellpadding='0' width='600' align='center'><tr>\n";
$content .= "<td align='center'><table border='0' cellspacing='0' cellpadding='0' width='100%'><tr>\n";
$content .= "<td align='center' width='600' height='18' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl03/top.jpg' alt='' border='0' style='display: block;'></td></tr>\n";
$content .= "<tr><td align='center' valign='top' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl03/mid.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<span style='font-family:Verdana, Geneva, sans-serif;font-size:22px;line-height:18px;color:#840000;'><b>".$settings['sitename']."</b><span><br><br>\n";
$content .= "<span style='font-family:Verdana, Geneva, sans-serif;font-size:18px;line-height:18px;color:#004000;'><b>$news_head</b></span><br><br></td></tr>\n";
$content .= "<tr><td background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl03/mid.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table width='92%' align='center' border='0' cellpadding='0' cellspacing='0'><tr><td align='right' style='font-family:Verdana, Geneva, sans-serif;font-size:9px;line-height:18px;color:#000000;'><span style='color:#000000; font-size: 9px;'><b>".$locale['nl_112']." $send_date</b></span></td>\n";
$content .= "</tr><tr>\n";
$content .= "<td align='center'><hr width='100%' color='#7f7f7f' size='0.1em'></td>\n";
$content .= "</tr></table>\n";
$content .= "<table align='center' width='92%' border='0' cellpadding='0' cellspacing='0'><tr>\n";
$content .= "<td align='left' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;color:#000000;'><span style='color:#000000; font-size: 13px;'>$usrtxt</span></td>\n";
$content .= "</tr><tr>\n";
$content .= "<td align='center'><hr width='100%' color='#7f7f7f' size='0.1em'></td>\n";
$content .= "</tr></table></td></tr>\n";
$content .= "<tr><td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl03/mid.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<span style='color:#000000; font-size: 11px;'>".$locale['nl_920']."</span><a style='color: #000040;' href='mailto:".$settings['siteemail']."'><span style='color:#000040; font-size: 11px;'>".$locale['nl_923']."</span></a><span style='color:#000000; font-size: 11px;'>".$locale['nl_921']."</span><br><br>\n";
$content .= "<span style='color:#000000; font-size: 11px;'>".$locale['nl_900']." ".$settings['sitename']."<br>".$locale['nl_924']."</span><a style='color: #000040;' href='".$settings['siteurl']."'><span style='color:#000040; font-size: 11px;'>".$settings['siteurl']."</span></a>\n";
$content .= "<span style='color:#000000; font-size: 11px;'>".$locale['nl_901']."</span></td></tr>\n";
$content .= "<tr><td width='600' height='32' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl03/bot.jpg' alt='' border='0' style='display: block;'></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' style='font-family:Verdana, Geneva, sans-serif;font-size:11px;line-height:18px;color:#000000;'><br><br><span style='color:#000000; font-size: 11px;'>".$locale['nl_902']."</span><br><br>\n";
$content .= "<a style='color: #000099;' href='".$settings['siteurl']."infusions/news_letter_panel/unsubscribe.php'><span style='color:#000099; font-size: 11px;'>".$locale['nl_903']."</span></a><br><br>\n";
$content .= " <a style='color: #000099;' href='".$settings['siteurl']."privacy_policy.php'><span style='color:#000099; font-size: 11px;'>".$locale['nl_904']."</span></a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "</body></html>\n";
?>
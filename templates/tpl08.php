<?php
$content = "<html>\n";
$content .= "<head>\n";
$content .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
$content .= "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n";
$content .= "<title>$subject</title>\n";
$content .= "</head>\n";
$content .= "<body bgcolor='#000000'>\n";
$content .= "<table border='0' cellspacing='0' cellpadding='0' width='100%' height='auto' bgcolor='#000000'><tr>\n";
$content .= "<td align='center'>\n";
$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr>\n";
$content .= "<td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:10px;line-height:18px;color:#ffffff;'><span style='background-color:#FFFF00; color:#000000; font-size: 10px;'>&nbsp;".$locale['nl_913']."&nbsp;</span><br><br></td></tr>\n";
$content .= "<tr><td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;'>\n";
$content .= "<a style='color: #0080ff;' $archive_bit</a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "<table border='0' cellspacing='0' cellpadding='0' width='600' align='center' bgcolor='#000000'><tr>\n";
$content .= "<td align='center'><table bgcolor='#000000' border='0' cellspacing='0' cellpadding='0' width='100%'><tr>\n";
$content .= "<td align='center' valign='middle' width='600' height='256' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/header.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<br><br><br><br><span style='font-family:Verdana, Geneva, sans-serif;font-size:32px;line-height:18px;color:#D1F7A8;'><b>".$settings['sitename']."</b></span><br><br><br>\n";
$content .= "<span style='font-family:Verdana, Geneva, sans-serif;font-size:18px;line-height:18px;color:#FFD2FF;'><b>$news_head</b></span>\n";
$content .= "</td></tr>\n";
$content .= "<tr><td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/cntr.jpg' alt='' border='0' style='display: block;'><br><br>\n";
$content .= "</td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/cntr.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table width='520'><td align='right' style='font-family:Verdana, Geneva, sans-serif;font-size:9px;line-height:18px;color:#ffffff;'><span style='color:#ffffff; font-size: 9px;'><b>".$locale['nl_112']." $send_date</b></span><br></td></tr>\n";
$content .= "<tr><td height='1' width='100%'><hr /></td></tr></table><br></td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/cntr.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table align='center' width='84%' border='0' cellpadding='0' cellspacing='0'><tr>\n";
$content .= "<td align='left' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;color:#ffffff;'><span style='color:#ffffff; font-size: 13px;'>$usrtxt</span></td>\n";
$content .= "</tr></table><br></td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/cntr.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table width='520' align='center'><tr><td height='1' width='100%'><hr /></td></tr><tr><td align='center' valign='bottom'>\n";
$content .= "<span style='color:#ffffff; font-size: 11px;'>".$locale['nl_920']."</span><a style='color: #FFBA75;' href='mailto:".$settings['siteemail']."'><span style='color:#FFBA75; font-size: 11px;'>".$locale['nl_923']."</span></a><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_921']."</span>\n";
$content .= "<br><br><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_900']." ".$settings['sitename']."<br>".$locale['nl_924']."</span><a style='color: #0080ff;' href='".$settings['siteurl']."'><span style='color:#0080ff; font-size: 11px;'>".$settings['siteurl']."</span></a>\n";
$content .= "<span style='color:#ffffff; font-size: 11px;'>".$locale['nl_901']."</span></td>\n";
$content .= "</tr></table>\n";
$content .= "</td></tr><tr>\n";
$content .= "<td align='center' valign='bottom' width='600' height='50' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl08/footer.jpg' alt='' border='0' style='display: block;'></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' style='font-family:Verdana, Geneva, sans-serif;font-size:11px;line-height:18px;color:#ffffff;'><br><br><span style='color:#ffffff; font-size: 11px;'>".$locale['nl_902']."</span><br><br>\n";
$content .= "<a style='color: #0080FF;' href='".$settings['siteurl']."infusions/news_letter_panel/unsubscribe.php'><span style='color:#0080FF; font-size: 11px;'>".$locale['nl_903']."</span></a><br><br>\n";
$content .= " <a style='color: #0080FF;' href='".$settings['siteurl']."privacy_policy.php'><span style='color:#0080FF; font-size: 11px;'>".$locale['nl_904']."</span></a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "</body></html>\n";
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
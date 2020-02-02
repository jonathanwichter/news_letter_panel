<?php
$content = "<html>\n";
$content .= "<head>\n";
$content .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
$content .= "<meta name='viewport' content='width=device-width, initial-scale=1.0' />\n";
$content .= "<title>$subject</title>\n";
$content .= "</head>\n";
$content .= "<body bgcolor='#ffffff'>\n";
$content .= "<table border='0' cellspacing='0' cellpadding='0' width='100%' height='auto' bgcolor='#ffffff'><tr>\n";
$content .= "<td align='center'>\n";
$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr>\n";
$content .= "<td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:10px;line-height:18px;color:#ffffff;'><span style='background-color: #000000; color:#62FF62; font-size: 10px;'>&nbsp;".$locale['nl_913']."&nbsp;</span><br><br></td></tr>\n";
$content .= "<tr><td align='center' valign='top' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;'>\n";
$content .= "<a style='color: #003300;' $archive_bit</a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "<table border='0' cellspacing='0' cellpadding='0' width='600' align='center' bgcolor='#BA1C25'><tr>\n";
$content .= "<td align='center'><table bgcolor='#BA1C25' border='0' cellspacing='0' cellpadding='0' width='100%'><tr>\n";
$content .= "<td align='center' valign='middle' width='600' height='89' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/header.jpg' alt='' border='0' style='display: block;'></td></tr>\n";
$content .= "<tr><td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/middle.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<img src='https://buhlmodeltrainsociety.com/v9/images/newsletterbanner.png' height= '208'/></b></span><br><br><br>\n";
$content .= "<span style='font-family:Verdana, Geneva, sans-serif;font-size:18px;line-height:18px;color:#003300;'><b>$news_head</b></span>\n";
$content .= "<br><br></td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/middle.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table width='520'><td align='right' style='font-family:Verdana, Geneva, sans-serif;font-size:9px;line-height:18px;color:#000033;'><span style='color:#000033; font-size: 9px;'><b>".$locale['nl_112']." $send_date</b></span><br></td></tr>\n";
$content .= "<tr><td height='1' width='100%'><hr /></td></tr></table><br></td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/middle.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table align='center' width='84%' border='0' cellpadding='0' cellspacing='0'><tr>\n";
$content .= "<td align='left' style='font-family:Verdana, Geneva, sans-serif;font-size:13px;line-height:18px;color:#003300;'><span style='color:#003300; font-size: 13px;'>$usrtxt</span></td>\n";


$content .= "</tr></table><br></td></tr><tr>\n";
$content .= "<td align='center' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/middle.jpg' alt='' border='0' style='display: block;'>\n";
$content .= "<table width='520' align='center'><tr><td height='1' width='100%'><hr /></td></tr><tr><td align='center' valign='bottom'>\n";
$content .= "<span style='color:#003300; font-size: 11px;'>".$locale['nl_920']."</span><a style='color: #840000;' href='mailto:".$settings['siteemail']."'><span style='color:#840000; font-size: 11px;'>".$locale['nl_923']."</span></a>\n";
$content .= "<span style='color:#003300; font-size: 11px;'>".$locale['nl_921']."</span><br><br>\n";
$content .= "<span style='color:#003300; font-size: 11px;'>".$locale['nl_900']." ".$settings['sitename']."<br>".$locale['nl_924']."</span><a style='color: #840000;' href='".$settings['siteurl']."'><span style='color:#840000; font-size: 11px;'>".$settings['siteurl']."</span></a>\n";
$content .= "<span style='color:#003300; font-size: 11px;'>".$locale['nl_901']."</span>\n";
$content .= "</td></tr></table>\n";
$content .= "</td></tr><tr>\n";
$content .= "<td align='center' valign='top' width='600' height='91' background='".$settings['siteurl']."infusions/news_letter_panel/images/tmpl10/footer.jpg' alt='' border='0' style='display: block;'></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "<table align='center' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' style='font-family:Verdana, Geneva, sans-serif;font-size:11px;line-height:18px;color:#003300;'><br><br><span style='color:#003300; font-size: 11px;'>".$locale['nl_902']."</span><br><br>\n";
$content .= "<a style='color: #003300;' href='".$settings['siteurl']."infusions/news_letter_panel/unsubscribe.php'><span style='color:#003300; font-size: 11px;'>".$locale['nl_903']."</span></a><br><br>\n";
$content .= " <a style='color: #003300;' href='".$settings['siteurl']."privacy_policy.php'><span style='color:#003300; font-size: 11px;'>".$locale['nl_904']."</span></a>\n";
$content .= "<br><br></td></tr></table>\n";
$content .= "</td></tr></table>\n";
$content .= "</body></html>\n";
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
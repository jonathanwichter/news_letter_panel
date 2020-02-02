<?php
$handle = isset($_REQUEST['handle']) ? $_REQUEST['handle'] : "";
$attach_files = isset($_REQUEST['attach_files']) ? $_REQUEST['attach_files'] : "";
function load_Attach()
{
    if($handle = opendir(ATTACH_FOLDER))
    {
        while(false !== ($file = readdir($handle)))
        {
            if(preg_match('/(\.txt$|\.htm$|\.html$|\.php$|\.css$|\.js$|\.json$|\.xml$|\.swf$|\.flv$|\.png$|\.jpe$|\.jpeg$|\.jpg$|\.gif$|\.bmp$|\.ico$|\.tiff$|\.tif$|\.svg$|\.svgz$|\.zip$|\.rar$|\.tar$|\.bz2$|\.7z$|\.mp2$|\.mpa$|\.mpe$|\.mpeg$|\.mpg$|\.mpv2$|\.mp3$|\.mid$|\.rmi$|\.ra$|\.ram$|\.qt$|\.mov$|\.movie$|\.pdf$|\.psd$|\.ai$|\.eps$|\.ps$|\.dot$|\.doc$|\.docx$|\.mdb$|\.rtf$|\.xla$|\.xlc$|\.xlm$|\.xls$|\.xlt$|\.xlw$|\.ppt$|\.pps$|\.pot)$/is', $file))
            {
                $attach_files[] = $file;
            }
        }
        closedir($handle);
        return (isset($attach_files)) ? $attach_files : false;
    }
    return false;
}

?>
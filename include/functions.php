<?php
global $settings;

function return_bytes($val) {
global $settings;
    $val = trim($val);
    $last = strtolower(substr($val, -1));
    if($last == 'g')
        $val = $val*1024*1024*1024;
    if($last == 'm')
        $val = $val*1024*1024;
    if($last == 'k')
        $val = $val*1024;
    return $val;
}

if (substr($settings['version'], 2,2) == '01') {
function filename_exists($dir, $file) {
	$i = 1;
	$file_name = substr($file, 0, strrpos($file, "."));
	$file_ext = strrchr($file, ".");
	while (file_exists($dir.$file)) {
		$file = $file_name."_".$i.$file_ext;
		$i++;
		}
	return $file;
	}
}
?>
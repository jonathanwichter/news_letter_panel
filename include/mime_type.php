<?php
global $new_file;

$file_ext = strrchr($new_file,".");

switch ($file_ext) {

	case ".txt":
		$mime_type = "text/plain";
		return $mime_type;
	break;
	case ".htm":
	case ".html":
	case ".php":
		$mime_type = "text/html";
		return $mime_type;
	break;
	case ".css":
		$mime_type = "text/css";
		return $mime_type;
	break;
	case ".js":
		$mime_type = "application/javascript";
		return $mime_type;
	break;
	case ".json":
		$mime_type = "application/json";
		return $mime_type;
	break;
	case ".xml":
		$mime_type = "application/xml";
		return $mime_type;
	break;
	case ".swf":
		$mime_type = "application/x-shockwave-flash";
		return $mime_type;
	break;
	case ".flv":
		$mime_type = "video/x-flv";
		return $mime_type;
	break;
	case ".png":
		$mime_type = "image/png";
		return $mime_type;
	break;
	case ".jpe":
	case ".jpeg":
	case ".jpg":
		$mime_type = "image/jpeg";
		return $mime_type;
	break;
	case ".gif":
		$mime_type = "image/gif";
		return $mime_type;
	break;
	case ".bmp":
		$mime_type = "image/bmp";
		return $mime_type;
	break;
	case ".ico":
		$mime_type = "image/vnd.microsoft.icon";
		return $mime_type;
	break;
	case ".tiff":
	case ".tif":
		$mime_type = "image/tiff";
		return $mime_type;
	break;
	case ".svg":
	case ".svgz":
		$mime_type = "image/svg+xml";
		return $mime_type;
	break;
	case ".zip":
		$mime_type = "application/zip";
		return $mime_type;
	break;
	case ".rar":
		$mime_type = "application/x-rar-compressed";
		return $mime_type;
	break;
	case ".tar":
		$mime_type = "application/x-tar-compressed";
		return $mime_type;
	break;
	case ".bz2":
		$mime_type = "application/x-bz2-compressed";
		return $mime_type;
	break;
	case ".7z":
		$mime_type = "application/x-7z-compressed";
		return $mime_type;
	break;
	case ".mp2":
	case ".mpa":
	case ".mpe":
	case ".mpeg":
	case ".mpg":
	case ".mpv2":
		$mime_type = "video/mpeg";
		return $mime_type;
	break;
	case ".mp3":
		$mime_type = "audio/mpeg";
		return $mime_type;
	break;
	case ".mid":
	case ".rmi":
		$mime_type = "audio/mid";
		return $mime_type;
	break;
	case ".ra":
	case ".ram":
		$mime_type = "audio/x-pn-realaudio";
		return $mime_type;
	break;
	case ".qt":
	case ".mov":
		$mime_type = "video/quicktime";
		return $mime_type;
	break;
	case ".movie":
		$mime_type = "video/x-sgi-movie";
		return $mime_type;
	break;
	case ".pdf":
		$mime_type = "application/pdf";
		return $mime_type;
	break;
	case ".psd":
		$mime_type = "image/vnd.adobe.photoshop";
		return $mime_type;
	break;
	case ".ai":
	case ".eps":
	case ".ps":
		$mime_type = "application/postscript";
		return $mime_type;
	break;
	case ".dot":
	case ".doc":
	case ".docx":
		$mime_type = "application/msword";
		return $mime_type;
	break;
	case ".mdb":
		$mime_type = "application/x-msaccess";
		return $mime_type;
	break;
	case ".rtf":
		$mime_type = "application/rtf";
		return $mime_type;
	break;
	case ".xla":
	case ".xlc":
	case ".xlm":
	case ".xls":
	case ".xlt":
	case ".xlw":
		$mime_type = "application/vnd.ms-excel";
		return $mime_type;
	break;
	case ".ppt":
	case ".pps":
	case ".pot":
		$mime_type = "application/vnd.ms-powerpoint";
		return $mime_type;
	break;
	default :
		$mime_type = "application/octet-stream";
		return $mime_type;
}
?>
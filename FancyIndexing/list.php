<?php include $_SERVER['DOCUMENT_ROOT'].'/FancyIndexing/includes/header.php';
$siteName = 'files.z14n.com'; // Change to your website's name

// Number of characters allowed in a name and extension
// Set to null for default listing (unlimited lengths)
$fixedWidth = null;
$fixedWidthExt = null; ?>

<table id="list">

<!-- Site name row -->
<tr><td colspan="2" align="center" style="padding: 3px; padding-bottom: 8px;">
 <div id="shadow" style="color: black; font-weight: 800; letter-spacing: 5px;"><big>
 <?php echo $siteName; ?>
</big></div></td></tr>

<!-- Breadcrumbs row -->
<tr><td colspan="2" align="center" style="border-bottom: 1px solid #000011;">
<span id="breadcrumbs">
<i>Index of: <?php
			if($fixedWidth != null){
            $path = substr($path, 0, $fixedWidth);
			if(strlen($path) >= $fixedWidth) {
				$path = $path.' ...';
			}
			echo $path . "\n";
			}
			else { echo $path . "\n"; } ?>
</i></span><div style="padding: 1px; border-bottom: 1px solid #000011;"></div></td></tr>
<!-- /Breadcrumbs row -->

<tr>
<td><div class="name-size" style="padding-left: 14px;">[Name]</div></td>
<td align="center"><div class="name-size">[Size]</div></td></tr>

<?php
$path = $_SERVER['REQUEST_URI']; // Fix path length for file listing

// Echo recursive directory link if not at server root
if($path != '/') {
 echo '<tr>';
 echo '<td><a href="../"><div id="list"><img src="/FancyIndexing/gfx/icons/purple/trackback.png" id="icon">[../]</div></a></td>'."\n";
 echo '<td align="center" style="background-color: #000011;"><div id="list">*</div></td>'."\n";
 echo '</tr>'."\n\n";
}

// Get files and directories
$dir = $_SERVER['DOCUMENT_ROOT'].$path;
$directories = array();
$files_list  = array();
$files = scandir($dir);
foreach($files as $file){
   if(($file != '.') && ($file != '..')
                     && substr(strrchr($file, "."), 1) != 'ext'){ // Hide by an extension 
      if(is_dir($dir.'/'.$file)){
         $directories[]  = $file;

      }else{
         $files_list[]    = $file;

      }
   }
}

// Returns 'h' for hidden files - Returns 's' for system files
function is_hidden_file($fn) {
    $attr = trim(exec('FOR %A IN ("'.$fn.'") DO @ECHO %~aA'));

    if($attr[3] == 'h')
        return true;
	
    return false;
}

foreach($directories as $directory){
	// Check if hidden or system file
	if(is_hidden_file($_SERVER['DOCUMENT_ROOT'].$path.$directory) != 'h' or is_hidden_file($_SERVER['DOCUMENT_ROOT'].$path.$directory) != 's') {
         
        $file = $directory;
		// Truncate string
		if($fixedWidth != null) {
			$file = substr($directory, 0, $fixedWidth); // Fix the width
			if(strlen($file) > $fixedWidth) {$file = $file.' ...';} // Add elipses to end of truncated files
		}
        echo '<tr>'."\n";
        echo '<td><a href="'.$path.$directory.'/"><div id="list"><img src="/FancyIndexing/gfx/icons/purple/folder.png" id="icon">'.$file.'</div></a></td>'."\n";
        echo '<td align="center" style="background-color: #000011;"><div id="list">*</div></td>'."\n";
        echo '</tr>'."\n\n";
	}
}
foreach($files_list as $file_list){
	// Get file size
	$file = $_SERVER['DOCUMENT_ROOT'].$path.$file_list;
	$fileSize = filesize($file);
	$fileSize = round($fileSize / 1024, 2);
	// Set file-size to KB or MB
	if ($fileSize > 1024) {
		$file = $_SERVER['DOCUMENT_ROOT'].$path.$file_list;
		$fileSize = filesize($file);
		$fileSize = round($fileSize / 1024 / 1024, 2);
		$size = number_format($fileSize, 2).'&nbsp;MB';
	}
	else {
		$size = number_format($fileSize, 2).'&nbsp;KB';
	}
	$fileSize = filesize($file);
	$fileSize = round($fileSize / 1024, 2);
	if ($fileSize > 1024000) {
		$file = $_SERVER['DOCUMENT_ROOT'].$path.$file_list;
		$fileSize = filesize($file);
		$fileSize = round($fileSize / 1024 / 1024 /1024, 2);
		$size = number_format($fileSize, 2).'&nbsp;GB';
	}

    $ext = explode(".", $path.$file_list);
	$ext = end($ext);
	if ($fixedWidthExt != null) { $ext = substr($ext, 0, $fixedWidthExt); }  // Set extension width

	if ($ext == 'doc' or $ext == 'docx' or $ext == 'htm' or $ext == 'html' or $ext == 'ini' or $ext == 'pdf' or $ext == 'php' or $ext == 'rtf' or $ext == 'shtml' or $ext == 'txt' or $ext == 'xml') {$icon = 'document.png';}
	elseif ($ext == 'bmp' or $ext == 'gif' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'png') {$icon = 'picture.png';}
	elseif ($ext == 'aac' or $ext == 'flac' or $ext == 'mp3' or $ext == 'ogg' or $ext == 'wav') {$icon = 'sound.png';}
	elseif ($ext == 'avi' or $ext == 'm4v' or $ext == 'mpg' or $ext == 'mp4' or $ext == 'mpeg' or $ext == 'mkv') {$icon = 'film.png';}
	elseif ($ext == '7z' or $ext == 'gz' or $ext == 'rar' or $ext == 'tar' or $ext == 'zip') {$icon = 'compress.png';}
	elseif ($ext == 'bat' or $ext == 'cmd' or $ext == 'ps1' or $ext == 'vbs') {$icon = 'script.png';}
	elseif ($ext == 'exe' or $ext == 'msi' or $ext == 'jar') {$icon = 'windows.png';}
	elseif ($ext == 'img' or $ext == 'iso') {$icon = 'cd.png';}
	else {$icon = 'file.png';}

	// Check if hidden or system file
	if(is_hidden_file($_SERVER['DOCUMENT_ROOT'].$path.$file_list) != 'h' or is_hidden_file($_SERVER['DOCUMENT_ROOT'].$path.$file_list) != 's') {

		$file = str_replace('.'.$ext, '', $file_list); // Removes extension
		// Truncate string
		if($fixedWidth != null) {
			$file = substr($file, 0, $fixedWidth); // Fix the width
			if(strlen($file) > $fixedWidth) {$file = $file.' ...';} // Add elipses to end of truncated files
		}
	    if($fixedWidthExt != null) { if(strlen($ext) > $fixedWidthExt) {$ext = $ext.' ...';} } // Truncate and add elipses to end of truncated extension

        echo '<tr>'."\n";
        echo '<td><a href="'.$path.$file_list.'"><div id="list"><img src="/FancyIndexing/gfx/icons/purple/'.$icon.'" id="icon">'.$file.' <span style="color: #bb11ee;"><i>'.strtolower($ext).'</i></span></div></a></td>'."\n";
        echo '<td align="right" style="background-color: #000011; color: #f0f0f0; width: 1px;"><div id="list">'.$size.'</div></td>'."\n";
        echo '</tr>'."\n\n";
	}
}
?></table>

<?php include $_SERVER['DOCUMENT_ROOT'].'/FancyIndexing/includes/footer.php'; ?>






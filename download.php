<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
$flag=0;
if($_GET['enc']){
$dec=base64_decode(base64_decode($_GET['enc']));
$jdec=json_decode($dec);
if((time()-$jdec->timestamp)<3600){
	$albums=$dbfunc->albums();
foreach ($albums as $key => $album) {
	if($album['id']==$jdec->id){
		$title=$album['album_title'];
		$link=$album['link'];
		$flag=1;
	}
	if($album['childs']!=null){
	foreach ($album['childs'] as $track) {
	if($track['id']==$jdec->id){
		$title=$album['track_title'];
		$link=$album['link'];
		$flag=1;
	}	
	}	
	}
}
if($flag==1){
	
		$file_name = str_replace(' ', '_', $title);
		$fakeFileName = $file_name.".zip";

$file = $link;
$fp = fopen($file, 'rb');

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$fakeFileName");
fpassthru($fp);
	}
}
	}
else{
	echo "some internal error occured";
}
?>
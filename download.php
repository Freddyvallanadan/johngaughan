<?php
include_once './classes/Dbfunction.php';
$dbfunc=new Dbfunction();
if($_GET['enc']){
$dec=base64_decode(base64_decode($_GET['enc']));
$jdec=json_decode($dec);
if((time()-$jdec->timestamp)<3600){
	$albums=$dbfunc->albums();
foreach ($albums as $key => $album) {
	if($album['id']==$jdec->id){
		$file_name = str_replace(' ', '_', $album['album_title']);
		$fakeFileName = $file_name.".zip";

$file = $album['link'];
$fp = fopen($file, 'rb');

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=$fakeFileName");
fpassthru($fp);
	}
}
	
}
}
else{
	echo "some internal error occured";
}
?>
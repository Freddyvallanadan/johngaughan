<?php  
	include_once './classes/Dbfunction.php';
	$dbfunc=new Dbfunction();
	$album_id = $_REQUEST['id']; 
	$email = $_REQUEST['email']; 
	$album_title="";
	foreach ($dbfunc->albums() as $album) {
		if($album["id"]==$album_id){
			$album_title=$album['album_title'];
			$album_price=$album['album_price'];
		}
	}
if($album_title==""){
	echo "Sorry, some error occured! Please try again later...";
	exit();
}
$json=array(
"email"=>$email,
"album_id"=>$album_id
	);
$send=base64_encode(base64_encode(json_encode($json)));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Initializing payment...</title>
</head>
<body>

	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" name="paypal">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="jgaughanie@googlemail.com">   
				<input type="hidden" name="lc" value="US">
				<input type="hidden" name="item_name" value="<?php echo 'Album : '.$album_title.'- by John Gaughan'; ?>" > 
				<input type="hidden" name="item_number" value="<?php echo $album_id; ?>"> 
				<input type="hidden" name="amount" value="<?php echo $album_price; ?>"> 
				<input type="hidden" name="currency_code" value="GBP">
				<input type="hidden" name="button_subtype" value="services">
				<input type="hidden" name="no_note" value="0">
				<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_SM.gif:NonHostedGuest">
				<input type="hidden" name="return" value="http:/ministries.com/success.php?encoded=<?php echo $send; ?>">
				<label>You will be automatically redirected to Paypal. If not, click here </label>
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form> 

<script>
window.onload = function(){
  document.forms['paypal'].submit();

}
document.forms['paypal'].submit();
</script>
</body>
</html>
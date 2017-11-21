<?php
function sendsms($name,$reading,$cpu,$mob)
{
include('sms/func.php');
error_reporting(0);
set_time_limit(0);
$billamount=$reading*$cpu;
$ser="http://site24.way2sms.com/";
$ckfile = tempnam ("/tmp", "CURLCOOKIE");
$login=$ser."Login1.action";
$uid='9538326966';
// * Reciving Password of Way2sms A/c from Html form //
$pwd='liverpool';
// * To whome the message send to //
$to=$mob;
// * Message to be sended //
$msg='Hello '.$name.',Your Electricity Bill is Rs.'.$billamount.'.You have consumed '.$reading.'kWH units';
flush();
if($uid && $pwd)
{
$ibal="0";
$sbal="0";
$lhtml="0";
$shtml="0";
$khtml="0";
$qhtml="0";
$fhtml="0";
$te="0";
//echo '<div class="content">User: <span class="number"><b>'.$uid.'</b></span><br>';
flush();

$loginpost="gval=&username=".$uid."&password=".$pwd."&Login=Login";

$ch = curl_init();
$lhtml=post($login,$loginpost,$ch,$ckfile);
////curl_close($ch);

if(stristr($lhtml,'Location: '.$ser.'vem.action') || stristr($lhtml,'Location: '.$ser.'MainView.action') || stristr($lhtml,'Location: '.$ser.'ebrdg.action'))
{
preg_match("/~(.*?);/i",$lhtml,$id);
$id=$id['1'];
if(!$id)
{
return false;
//goto end;
}
// * Login Sucess Message//
//goto bal;
}
elseif(stristr($lhtml,'Location: http://site2.way2sms.com/entry'))
{
// * Login Faild or SMS Send Error Message 3//
return false;
//goto end;
}
else
{
// * Login Faild or SMS Send Error Message 2//
return false;
//goto end;
}
//bal:
///$ch = curl_init();
$msg=urlencode($msg);
$main=$ser."smstoss.action";
$ref=$ser."sendSMS?Token=".$id;
$conf=$ser."smscofirm.action?SentMessage=".$msg."&Token=".$id."&status=0";

$post="ssaction=ss&Token=".$id."&mobile=".$to."&message=".$msg."&Send=Send Sms&msgLen=".strlen($msg);
$mhtml=post($main,$post,$ch,$ckfile,$proxy,$ref);
if(stristr($mhtml,'smscofirm.action?SentMessage='))
// * Message Sended Sucessfull Message//
{
	return true;
}
else
// * Login Faild or SMS Send Error Message 1//
{
	return false;
}
curl_close($ch);

//end:

//echo "</div>";
flush();
}
}
?>
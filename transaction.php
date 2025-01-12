<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
define('CORE_API_HTTP_USR', 'merchant_19150');
define('CORE_API_HTTP_PWD', '19150sAmK2OgUS4YI570ZXJrDvi24FfwTN1');
date_default_timezone_set('Asia/Ho_Chi_Minh');

$username = $_SESSION['username'];
$serverId = $_POST['server'];
$_SESSION['server_id'] = $serverId;

include_once($_SERVER['DOCUMENT_ROOT'] . '/function/server.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/db/connect.php');

$bk = 'https://www.baokim.vn/the-cao/restFul/send';
$seri = isset($_POST['txtseri']) ? $_POST['txtseri'] : '';
$sopin = isset($_POST['txtpin']) ? $_POST['txtpin'] : '';
//Loai the cao (VINA, MOBI, VIETEL, VTC, GATE)
$mang = isset($_POST['chonmang']) ? $_POST['chonmang'] : '';

if($mang=='MOBI'){
    $ten = "Mobifone";
}
else if($mang=='VIETEL'){
    $ten = "Viettel";
}
else if($mang=='GATE'){
    $ten = "Gate";
}
else if($mang=='VTC'){
    $ten = "VTC";
}
else $ten ="Vinaphone";

//Mã MerchantID dang kí trên Bảo Kim
$merchant_id = '22337';
//Api username
$api_username = 'pvcaidatgamecom';
//Api Pwd d
$api_password = 'dnJwbGoygRDZsYFmPnVc';
//Mã TransactionId
$transaction_id = time();
//mat khau di kem ma website dang kí trên B?o Kim
$secure_code = '93162f72a6ac940f';

$arrayPost = array(
    'merchant_id'=>$merchant_id,
    'api_username'=>$api_username,
    'api_password'=>$api_password,
    'transaction_id'=>$transaction_id,
    'card_id'=>$mang,
    'pin_field'=>$sopin,
    'seri_field'=>$seri,
    'algo_mode'=>'hmac'
);

ksort($arrayPost);

$data_sign = hash_hmac('SHA1',implode('',$arrayPost),$secure_code);

$arrayPost['data_sign'] = $data_sign;

$curl = curl_init($bk);

curl_setopt_array($curl, array(
    CURLOPT_POST=>true,
    CURLOPT_HEADER=>false,
    CURLINFO_HEADER_OUT=>true,
    CURLOPT_TIMEOUT=>30,
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPAUTH=>CURLAUTH_DIGEST|CURLAUTH_BASIC,
    CURLOPT_USERPWD=>CORE_API_HTTP_USR.':'.CORE_API_HTTP_PWD,
    CURLOPT_POSTFIELDS=>http_build_query($arrayPost)
));

$data = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$result = json_decode($data,true);
$time = time();
//$time = time();
if($status==200){
    $amount = $result['amount'];
    $rate = 1;
    $extraRate = 1;
    if (time() >= strtotime('2016-12-12 10:00:00') &&
        time() <= strtotime('2016-12-12 23:59:59')) {
        $rate = 2;
        $extraRate = 2;
    }

    switch($amount) {
        case 10000: $xu = 1000 * $rate; break;
        case 20000: $xu = 2000 * $rate; break;
        case 30000: $xu = 3000 * $rate; break;
        case 50000: $xu= 5000 * $rate; break;
        case 100000: $xu = 10000 * $rate; break;
        case 200000: $xu = 20000 * $rate; break;
        case 300000: $xu = 30000 * $rate; break;
        case 500000: $xu = 50000 * $extraRate; break;
        case 1000000: $xu = 100000 * $extraRate; break;
    }

    //Chuyen KNB vao game:
	$loginkey = "douge1242821087kaifuytl";
	$sid = $servers[$serverId]['sid'];
	$play_ip = $servers[$serverId]['play_ip'];
	$api_url = $servers[$serverId]['api_url'];
	$http_port = $servers[$serverId]['http_port'];
	$pay_num = $xu;
	$name = $username.'_'.$sid;
	$time = time();
	$oid = $time . rand(100, 999);
	$gold = $pay_num*1;
	$money = 1;
	$apiurl = "$api_url/api/pay.php";
	$sign = md5($name.$loginkey);
	$r = "$apiurl?account=".$name."&gold=".$gold."&ip=".$play_ip."&zz=".$http_port."&sign=".$sign."&action=pay";
	$fanhui = file_get_contents($r);
	
    $serverIdInt = preg_replace('/[^0-9]+/', '', $serverId);
	//Luu card vao db:
	$dbh->prepare("INSERT INTO card_transaction (account, card_pin, card_serial, service, `date`, cost, server_id) VALUES (?, ?, ?, ?, ?, ?, ?)")
		->execute(array($username, $sopin, $seri, $ten, date('Y-m-d H:i:s', $time), $amount, $serverIdInt));
				
    //Luu card ra log:
	$file = "carddung.log";
	$fh = fopen($file,'a') or die("cant open file");
	fwrite($fh,"Tai khoan: ".$username.", Loai the: ".$ten.", Menh gia: ".$amount.",Ma the: ".$sopin.", Seri: ".$seri.", Thoi gian: ".date('Y-m-d H:i:s'));
	fwrite($fh,"\r\n");
	fclose($fh);
	if ($amount>0){
		echo '<script>alert("Bạn đã nạp thành công thẻ '.$ten.' mệnh giá '.$amount.', nếu vẫn chưa nhận được KNB, vui lòng đợi sau ít phút!");location.href="/nap-the";</script>';
		}else{
		echo '<script>alert("Có lỗi xảy ra vui lòng liên hệ với BQT!");location.href="/nap-the";</script>';	
	}
}
else{
				
    echo 'Status Code:' . $status . '<hr >';
    $error = $result['errorMessage'];
    echo $error;
    $file = "cardsai.log";
    $fh = fopen($file,'a') or die("cant open file");
    fwrite($fh,"Tai khoan: ".$username.", Ma the: ".$sopin.", Seri: ".$seri.", Noi dung loi: ".$error.", Thoi gian: ".date('Y-m-d H:i:s'));
    fwrite($fh,"\r\n");
    fclose($fh);
    echo '<script>alert("Thông tin thẻ cào không hợp lệ!");location.href="/nap-the"</script>';    
}
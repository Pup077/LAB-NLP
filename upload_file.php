<html>
<body>

<?php
$menu = "";
$imgName = "PB.jpg";
if(isset($_GET['imgName'])) {
	global $imgName;
    $imgName = $_GET['imgName'];
}
echo '<img src="'.$imgName.'">';

//T-Food
$curl = curl_init();
$img_file = $imgName;	
$img_data = file_get_contents($img_file);
$data = json_encode(array("file" => base64_encode($img_data)));
	
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.aiforthai.in.th/thaifood",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "apikey:  R3f9nXid9uhGX2UE6wdFWCcqV7BkoeMk"
  )
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  $arr = json_decode($response,true);
  //print_r($arr);
  echo "<br>";
  array_walk_recursive($arr, function ($item, $key) {
    //echo "$key holds $item"."<br>";
	if( $key == "result" ){ 
		global $menu;
		$menu = $item; 
	}
  });
}

echo "<br>อาหารนี้ คือ ".$menu." --> (จีน)";
$cnTrans = "";

//Th->Cn
$curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.aiforthai.in.th/th-zh-nmt/".urlencode("$menu"),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Apikey: F0ssKORoZyGSRDibad2TtaP2r2nHFxM2"
  )
));
 
$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);
 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  global $cnTrans;
  $cnTrans = $response;
}

//Cn-Th
echo " --> (ไทย)";
$curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.aiforthai.in.th/zh-th-nmt/".urlencode($cnTrans),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Apikey: F0ssKORoZyGSRDibad2TtaP2r2nHFxM2"
  )
));
 
$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);
 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
echo "<br>(Object recognition)T-Food -->  Machine translate (Th->Cn) --> (Cn->Th)"; 
?>
</body>
</html>
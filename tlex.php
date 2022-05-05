<?php
 
$curl = curl_init();
 
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.aiforthai.in.th/tlexplus?text=ข้าวและแป้งมีสารอาหารหลักคือคาร์โบไฮเดรต",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Apikey: R3f9nXid9uhGX2UE6wdFWCcqV7BkoeMk"
  )
));
 
$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);
 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
//  $response = var_dump(json_decode($response,JSON_UNESCAPED_UNICODE));

  $arr = json_decode($response, true);
  array_walk_recursive($arr, function ($item, $key) {
    echo $key.") ".$item."<br>";
  });
}
 
?>
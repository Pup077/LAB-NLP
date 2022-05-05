<?php
 
$curl = curl_init();
$img_file = ('PB.jpg');
$data = array(
    'src_img' => new CURLFile($img_file, mime_content_type($img_file), basename($img_file)),
    'json_export' => 'true',
    'img_export' => 'true',
);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.aiforthai.in.th/person/human_detect/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: multipart/form-data",
    "apikey: R3f9nXid9uhGX2UE6wdFWCcqV7BkoeMk"
  )
));
 
$response = curl_exec($curl);
$err = curl_error($curl);
 
curl_close($curl);
 
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  foreach(json_decode($response) as $key => $value); {
    echo "<img src='".$value."'>"; echo "<br><br>" ;
  }

  $arr = json_decode($response, true);
  array_walk_recursive($arr, function ($item, $key) {
    echo $key." : ".$item."<br>";
  });
  
}
?>
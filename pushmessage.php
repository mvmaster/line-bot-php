<?php
   $accessToken = "qb3XDr9JvCQDQr79FYKoU/gU0dpXL0/CwVfs/LHRLTlYeAvSNj+3/odAdZJMLC47b5kwQHsuvxlreFaJQTi2td477s+rrwhsCqS9n68F5UXElhp/Ls4Y2fE+5pYg1QJePJzLRNzrwGh+1Yt7nypCHgdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $to ="C270684297b298fad6cea1aa5ce4bf6f2";
   /*$content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);*/
   $arrayPostData = json_decode(file_get_contents('php://input'), true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
//รับข้อความจากผู้ใช้
  /* $message = $arrayJson['events'][0]['message']['text'];
//รับ id ว่ามาจากไหน
   if(isset($arrayJson['events'][0]['source']['userId'])){
      $id = $arrayJson['events'][0]['source']['userId'];
   }
   else if(isset($arrayJson['events'][0]['source']['groupId'])){
      $id = $arrayJson['events'][0]['source']['groupId'];
   }
   else if(isset($arrayJson['events'][0]['source']['room'])){
      $id = $arrayJson['events'][0]['source']['room'];
   }*/
#ตัวอย่าง Message Type "Text + Sticker"
if ($arrayPostData) {
	array_push($arrayPostData, array('to' => $to));
	pushMsg($arrayHeader,$arrayPostData);
}
else {
	 /* $arrayPostData['to'] = $to;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);*/
	  echo "No Input Found";
	  print_r($arrayPostData);
}
   /*if($message == "สวัสดี"){
      $arrayPostData['to'] = $to;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
   }*/
   
function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
exit;
?>
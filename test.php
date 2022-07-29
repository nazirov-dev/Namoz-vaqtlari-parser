<?php
  $post = ['city'=> "Namangan", 'type'=>"ertangi"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,'https://'.$_SERVER['SERVER_NAME'].str_replace("test.php", "index.php", $_SERVER['PHP_SELF']));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $response = curl_exec($ch);
  $result = json_decode($response);
  curl_close($ch);

if($result->status)
  echo "Azon ".$result->result->sahar."<br>Quyosh ".$result->result->quyosh."<br>Peshin ".$result->result->peshin."<br>Asr ".$result->result->asr."<br>Shom ".$result->result->shom."<br>Xufton ".$result->result->xufton;
elseif(!$result->status)
  echo $result->error;

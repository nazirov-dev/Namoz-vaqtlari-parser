<?php
date_default_timezone_set('Asia/Tashkent');

/**
 * @author Abdulaziz Nazirov <
 * @license MIT
 * @source Islom.uz
 * @param string $_GET['city'] => Viloyat nomi 
 * @param string $_GET['type'] => Bugungi yoki ertangi kun vaqtini olish uchun `bugungi` yoki `ertangi` qiymatlarini qabul qiladi
 * @return aplication/json 
 */

$_GET['city'] = isset($_GET['city']) ? $_GET['city'] : 'toshkent'; //Agarda hudud tanlanmasa avtomatik Toshkent viloyati tanlanadi
$_GET['type'] = isset($_GET['type']) ? $_GET['type'] : 'bugungi'; 

$citys = [
    'toshkent'=>27,
    'andijon'=>1,
    'buxoro'=>4,
    'guliston'=>5,
    'samarqand'=>18,
    'namangan'=>15,
    'navoiy'=>14,
    'jizzax'=>9,
    'nukus'=>16,
    'qarshi'=>25,
    'qoqon'=>26,
    'xiva'=>21,
    'margilon'=>13
]; //Qabul qilinadigan shaharlar


$oy = date("m");
    if($oy[0] == "0") $oy = str_replace("0", "", $oy);

$get = file_get_contents("https://islom.uz/vaqtlar/".$citys[str_replace("'", "", strtolower($_GET['city']))]."/".$oy);

$response = [
    'status'=> true,
    'result'=>[],
    'dev'=>"Abdulaziz Nazirov (@Nazirov_Dev)"
];

if(mb_stripos($get, "</tr><tr class='p_day bugun'>")!==false)
    $array = explode("</tr><tr class='p_day bugun'>", $get)[1];
elseif(mb_stripos($get, "</tr><tr class='juma bugun'>")!==false)
    $array = explode("</tr><tr class='juma bugun'>", $get)[1];
else{
    $response['status'] = false;
    $response['result'] = "Ma'lumot topilmadi";
    echo json_encode($response, JSON_PRETTY_PRINT);
    exit;
}
$array = explode("\n", strip_tags($array));
$sahar = trim($array[$_GET['type'] == "bugungi" ? 4 : 14]);
$quyosh = trim($array[$_GET['type'] == "bugungi" ? 5 : 15]);
$peshin = trim($array[$_GET['type'] == "bugungi" ? 6 : 16]);
$asr = trim($array[$_GET['type'] == "bugungi" ? 7 : 17]);
$shom = trim($array[$_GET['type'] == "bugungi" ? 8 : 18]);
$xufton = trim($array[$_GET['type'] == "bugungi" ? 9 : 19]);
$response['result'] = [
    'sahar'=>$sahar,
    'quyosh'=>$quyosh,
    'peshin'=>$peshin,
    'asr'=>$asr,
    'shom'=>$shom,
    'xufton'=>$xufton
];

echo json_encode($response, JSON_PRETTY_PRINT);

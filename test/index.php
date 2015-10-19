<?php
/**
*   Test Canvas
*/

$items = [
    "key" => "mykey",
    "secret" => "mysecretcode",
    "path" => "https://www.somepath.com/Canvas/LTI/",
    "method" => "POST",
    "post" => $_POST
];


$canvas = new \Canvas\CanvasLTI($key, $secret);
$canvas->validate([
    "path" => "",
    "action" => "",
    "parameters" => ""
]);


if($canvas->isSuccess()){
    echo "success";
}else{
    echo "fail";
}
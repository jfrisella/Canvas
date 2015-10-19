<?php
/**
*   Test Canvas
*/

$key = "mypublickey";
$secret = "mysecret";


$canvas = new \VJS\Canvas\CanvasLTI($key, $secret);
$canvas->setPath("https://www.somepath.com/Canvas/App/");
$canvas->setAction("POST");
$output = $canvas->validate($_POST);


if($output->isSuccess()){
    echo $output->getMessage();
    echo $output->getStatus();
    echo $output->getResult();
}else{
    echo $output->getMessage();
    echo $output->getStatus();
}
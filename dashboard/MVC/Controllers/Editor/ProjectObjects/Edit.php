<?php

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

//Load file with class if exists the xml file
if( file_exists($_POST['ObjectPath'])){
    // XML file open
    $xml = simplexml_load_file($_POST['ObjectPath']);
    // XML file to array
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
}

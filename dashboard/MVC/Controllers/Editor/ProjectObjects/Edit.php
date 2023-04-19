<?php

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

//Load file with class if exists the xml file

// $xml = new SimpleXMLElement($Config->get('ROOT_BASEOBJECT'), 0, true);

$XML_PATH = "";

if (isset($_POST['ObjectPath'])) {
    $XML_PATH = $_POST['ObjectPath'];
}else{
    die("Error: No path to xml file");
}

if( $XML_PATH != "" && file_exists($XML_PATH) ){
    // XML file open
    $xml = simplexml_load_file($_POST['ObjectPath']);
    // XML file to array
}else{
    die("Error: File not found");
}

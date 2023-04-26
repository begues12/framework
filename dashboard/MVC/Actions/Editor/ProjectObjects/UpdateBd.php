<?php

require_once($Config->get('ROOT_CORE')."BaseSQL.php");

$BaseSQL = new BaseSQL("asd");

$XML_PATH = "";

$Id_Relation = "";

$Project_Name = "";


if (isset($_POST['XML_FILE'])) {
    $XML_PATH = $_POST['XML_FILE'];
}

if (isset($_POST['ProjectName'])) {
    $Project_Name = $_POST['ProjectName'];
}

// Get if table exists

$Table_Name = "";
$Table_Fields = [];

if (file_exists($XML_PATH) && $Project_Name != "") {
    $XML = simplexml_load_file($XML_PATH);

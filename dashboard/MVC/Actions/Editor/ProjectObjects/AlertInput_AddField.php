<?php

require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_WIDGETS')."InputAlert.php";
use Engine\Utils\Widgets\InputAlert;

require_once $Config->get('ROOT_WIDGETS')."ErrorMsg.php";
use Engine\Utils\Widgets\ErrorMsg;

require_once $Config->get('FILE_BASESQL');
use Engine\Core\BaseSQL;


if (!isset($_POST['ProjectName'])) {
    $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
    $ErrorMsg->render();
    die();
}

if (!isset($_POST['Table'])) {
    $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
    $ErrorMsg->render();
    die();
}

$BaseSQL = new BaseSQL($_POST['ProjectName']);

$InputAlert = new InputAlert("add_field", "New Field Name");

$InputAlert->SubmitButton->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectObjects&Action=AddField");
$InputAlert->SubmitButton->AddAttribute("ProjectName", $_POST['ProjectName']);
$InputAlert->SubmitButton->AddAttribute("Table", $_POST['Table']);

$InputAlert->render();

?>
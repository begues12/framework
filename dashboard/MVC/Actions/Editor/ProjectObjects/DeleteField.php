<?php

require_once 'Config.php';
use Engine\Core\Config;

$Config = new Config();

require_once($Config->get('ROOT_CORE')."BaseSQL.php");
use Engine\Core\BaseSQL;

require_once($Config->get('ROOT_WIDGETS')."ErrorMsg.php");
use Engine\Utils\Widgets\ErrorMsg;

require_once($Config->get('ROOT_WIDGETS')."SuccessMsg.php");
use Engine\Utils\Widgets\SuccessMsg;

$Field = "";
$Table = "";
$ProjectName = "";

if (isset($_POST['Field']) && $_POST['Field'] != "") {
    $Field = $_POST['Field'];
}else{
    $ErrorMsg = new ErrorMsg("Error", "Field name is not set");
    $ErrorMsg->render();
    die();
}

if (isset($_POST['Table']) && $_POST['Table'] != "") {
    $Table = $_POST['Table'];
}else{
    $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
    $ErrorMsg->render();
    die();
}

if (isset($_POST['ProjectName']) && $_POST['ProjectName'] != "") {
    $ProjectName = $_POST['ProjectName'];
}else{
    $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
    $ErrorMsg->render();
    die();
}

$BaseSQL = new BaseSQL($ProjectName);

$BaseSQL->alterTable($Table, "DROP COLUMN", $Field);

$BaseSQL->Apply();

if ($BaseSQL->OK()){
    $SuccessMsg = new SuccessMsg("Success", "Field deleted successfully");
    $SuccessMsg->render();
}else{
    $ErrorMsg = new ErrorMsg("Error", "Field not deleted");
    $ErrorMsg->render();
}

?>
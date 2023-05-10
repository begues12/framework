<?php

require_once 'Config.php';
use Engine\Core\Config;

$Config = new Config();

// Add Exception
// use \Exception;

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

if (isset($_POST['Value']) && $_POST['Value'] != "") {
    $value = $_POST['Value'];
}else{
    $ErrorMsg = new ErrorMsg("Error", "value is not set");
    echo $ErrorMsg->Js;
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



try{
    $BaseSQL->query("SHOW COLUMNS FROM $Table LIKE '$Field'");

    $Result = $BaseSQL->Apply();

    $Type = $Result[0]['Rows'][0]['Type'];

    $Type = explode("(", $Type);

    $Type = str_replace(")", "", $Type[0]);

    $BaseSQL->alterTable($Table, "MODIFY COLUMN", $Field, $Type, $value);

    $BaseSQL->Apply();

    if ($BaseSQL->OK()){
        $SuccessMsg = new SuccessMsg("Success", "Field length changed");
        $SuccessMsg->render();
    }else{
        $ErrorMsg = new ErrorMsg("Error", "Field length not changed");
        $ErrorMsg->render();
    }

}catch(Exception $e){
    $ErrorMsg = new ErrorMsg("Error", "Field length not changed");
    $ErrorMsg->render();
}

?>
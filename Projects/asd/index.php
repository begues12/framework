<?php
require_once "Config.php";

use Engine\Core\Config;

$Config = new Config();

require_once  $Config->get('ROOT_CORE')."BasePage.php";
require_once  $Config->get('ROOT_WIDGETS')."Navbar.php";
require_once  $Config->get('ROOT_WIDGETS')."Sidebar.php";

require_once  $Config->get('FILE_BASECONTROLLER');
require_once  $Config->get('ROOT_IMPORTMVC');

use Engine\Core\ImportMVC;

$ImportMVC = new ImportMVC();
$ImportMVC->execute();

function pre_array(array $array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


?>
<?php

namespace MVC\Controllers\Editor\ProjectObjects;

//Fist load file config
require_once "Config.php";
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once($Config->get('ROOT_WIDGETS')."ErrorMsg.php");
require_once $Config->get('ROOT_WIDGETS')."ConfirmDeleteMsg.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\ConfirmDeleteMsg;

class View extends BaseController{

    function __construct(){
        parent::__construct();
    }

}
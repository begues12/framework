<?php

require_once "Config.php";

use Engine\Core\Config;
$Config = new Config();

use Engine\Core\BaseView;

require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_HTML')."Table.php";
require_once $Config->get('ROOT_HTML')."Tr.php";
require_once $Config->get('ROOT_HTML')."Th.php";
require_once $Config->get('ROOT_WIDGETS')."ErrorMsg.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectObjects\TrProjectObject.php";

use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Th;
use Engine\Utils\HTML\Input;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\ProjectObjects\TrProjectObject;


class Index extends BaseView{

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    { 
    }

}
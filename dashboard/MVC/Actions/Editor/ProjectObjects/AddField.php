<?php
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

echo "Asdasd";

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Select.php";
require_once $Config->get('ROOT_HTML')."Option.php";
require_once $Config->get('ROOT_HTML')."Form.php";
require_once $Config->get('ROOT_HTML')."Table.php";
require_once $Config->get('ROOT_HTML')."Tr.php";
require_once $Config->get('ROOT_HTML')."Td.php";
require_once $Config->get('ROOT_HTML')."Nav.php";
require_once $Config->get('ROOT_WIDGETS')."ErrorMsg.php";
require_once $Config->get('ROOT_WIDGETS')."SuccessMsg.php";
require_once($Config->get('ROOT_CORE')."BaseSQL.php");

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Select;
use Engine\Utils\HTML\Option;
use Engine\Utils\HTML\Form;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Td;
use Engine\Utils\HTML\Nav;

use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\SuccessMsg;

use Engine\Core\BaseSQL;

$Config->pre_array($_POST);


    

?>
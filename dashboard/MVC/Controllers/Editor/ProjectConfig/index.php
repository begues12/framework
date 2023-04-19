<?php

namespace Engine\Core;

require_once "Config.php";

use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('ROOT_BASEOBJECT');

use Engine\Core\BaseObject;

$BaseObject = new BaseObject("C:/xampp\htdocs/framework\Projects\asd\Objects\User.xml");

$BaseObject->Config->pre_array($BaseObject->Data);
?>
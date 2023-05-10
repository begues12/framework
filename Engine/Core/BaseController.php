<?php

namespace Engine\Core;

require_once("Config.php");
use Engine\Core\Config;
use Engine\Core\BaseView;
use Engine\Core\BaseSQL;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Core\BasePage;

class BaseController{

    public $title;
    public $icon;
    public $ajax;
    public $View = null;
    public $Config;
    public $charset = "utf8mb4";
    public $BaseSQL = null;
    private $Vars = array();
    public $BasePage = null;

    function __construct(){
        $this->title = "";
        $this->icon = "";
        $this->ajax = false;
        $this->View = new BaseView();
        $this->charset = "utf8mb4";
        $this->Config = new Config();
        $this->BasePage = new BasePage();
    }

    /*
    *  Prepare the controller
    */

    public function Prepare()
    {
    }

    /*
    *  Finalize the controller
    */

    public function Finish()
    {
    }


    /*
    * Set View
    */

    public function setView(BaseView $view)
    {
        $this->View = $view;
    }

    /*
    * Get View
    */

    public function getView()
    {
        return $this->View;
    }

    /*
    * Set var
    * @param $var
    * @param $value
    */

    public function setVar($var, $value)
    {
        $this->Vars[$var] = $value;
    }

    /*
    * Get var
    * @param $var
    */

    public function getVar($var)
    {
        return $this->Vars[$var];
    }

    /*
    * Get all vars
    */

    public function getVars()
    {
        return $this->Vars;
    }

    /*
    * BasePage
    */

    public function BasePage()
    {
        $this->BasePage->render();
    }


}

?>
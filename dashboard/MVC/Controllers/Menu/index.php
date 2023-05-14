<?php

namespace MVC\Controllers\Menu;

use Engine\Core\BaseController;
use Engine\Core\BasePage;
class Index extends BaseController{

    public $BasePage;

    function __construct(){
        parent::__construct();
        $this->BasePage = new BasePage();
    }

    public function Prepare()
    {
        $this->BasePage();
    }


}


?>
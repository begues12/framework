<?php

namespace MVC\Controllers\Editor;

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

<?php
namespace Engine\Utils\HTML;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\OtherElement.php";

use Core\BaseUtils;
use Engine\Utils\HTML\OtherElement;

class svg extends BaseUtils{
    
    public $Use;

    function __construct(){
        $this->tag = "svg";
        $this->name = "";
        $this->value = "";
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [
            'width' => '24',
            'height' => '24',
            'role' => 'img',
            'aria-label' => 'Home',
        ];
    }

    function AddUse(String $href){
        $this->Use = new OtherElement("use");
        $this->Use->AddAttribute("xlink:href", $href);
        $this->Add($this->Use);
    }


}

####################
#        ,~~~.     #
#       (\___/)    #
#       /_O_O_\    #
#      {=^___^=}   #
#       \_/ \_/    #
#__________________#
# Github:@Begues12 #
####################

?>
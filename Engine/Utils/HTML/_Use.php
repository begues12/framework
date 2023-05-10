<?php
namespace Engine\Utils\HTML;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');

use Core\BaseUtils;

class _Use extends BaseUtils{

    function __construct(){
        $this->tag = "use";
        $this->name = "";
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
        $xlink_href = "";

        $this->attributes["xlink:href"] = $xlink_href;
    }

    function AddElement($element){
        $this->text .= $element;
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
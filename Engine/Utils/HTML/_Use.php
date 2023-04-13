<?php
namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

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
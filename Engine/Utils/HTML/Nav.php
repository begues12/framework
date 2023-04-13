<?php
namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

use Core\BaseUtils;

class Nav extends BaseUtils{

    function __construct(){
        $this->tag = "nav";
        $this->name = "";
        $this->value = "";
        $this->text = "";
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
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
<?php
namespace Engine\Utils;

///Include all of php files in the folder
$DirFiles = glob('.\*.php');

foreach($DirFiles as $file){
    ///Except this file
    if($file != __FILE__){
        include_once($file);
    }
}

?>
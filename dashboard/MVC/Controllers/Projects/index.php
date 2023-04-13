<?php

// Si esta configurado PROJECTS_ROOT en Config.php entonces se muestra todos los proyectos que estan en la carpeta Projects

$Projects = [];

$Projects_dir = scandir($Config->get('ROOT_PROJECT'));

foreach($Projects_dir as $Project){

    if($Project != "." && $Project != ".."){
        $Projects[] = $Project;
    }

}



?>
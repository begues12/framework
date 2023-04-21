<?php

$XML_PATH = "";
$Id_Relation = "";

if (isset($_POST['XML_FILE'])) {
    $XML_PATH = $_POST['XML_FILE'];
}

if (isset($_POST['IdRelation'])) {
    $Id_Relation = $_POST['IdRelation'];
}
echo $XML_PATH;
if ($XML_PATH != "" && $Id_Relation != "") {

    $xml = new SimpleXMLElement($XML_PATH, 0, true);
    
    if ($xml === false) {
        echo "No se pudo cargar el archivo XML";
    } else {
        
        foreach ($xml->xpath("//Relation[@id='$Id_Relation']") as $field) {
            unset($field[0]);
        }

        $xml->asXML($XML_PATH);
        echo "Campo eliminado correctamente del archivo XML";
    }
} else {
    echo "Error en los parámetros";
}
?>
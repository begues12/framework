<?php

$XML_PATH = "";
$ID_FIELD = "";

if (isset($_POST['XML_FILE'])) {
    $XML_PATH = $_POST['XML_FILE'];
}

if (isset($_POST['IdField'])) {
    $ID_FIELD = $_POST['IdField'];
}
echo $XML_PATH;
if ($XML_PATH != "" && $ID_FIELD != "") {

    $xml = new SimpleXMLElement($XML_PATH, 0, true);
    
    if ($xml === false) {
        echo "No se pudo cargar el archivo XML";
    } else {
        
        foreach ($xml->xpath("//Field[@id='$ID_FIELD']") as $field) {
            unset($field[0]);
        }

        $xml->asXML($XML_PATH);
        echo "Campo eliminado correctamente del archivo XML";
    }
} else {
    echo "Error en los parámetros";
}
?>
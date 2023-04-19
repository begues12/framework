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
        
        foreach ($xml->children() as $child) {
            if ($child->getName() == "Fields") {
                foreach ($child->children() as $field) {
                    if ($field->getName() == "Field") {
                        if ($field->attributes()->id == $ID_FIELD) {
                            $dom = dom_import_simplexml($field);
                            $dom->parentNode->removeChild($dom);
                        }
                    }
                }
            }
        }

        $xml->asXML($XML_PATH);
        echo "Campo eliminado correctamente del archivo XML";
    }
} else {
    echo "Error en los parámetros";
}
?>
<?php

$DataJSON = $_POST['Data'];
$Data = json_decode($DataJSON, true);

$XML_FILE = $_POST['XML_FILE'];

// Edit XML file with new data field


$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;
$doc->load($XML_FILE);

// Set Name field
$Name = $doc->getElementsByTagName('Name')->item(0);
$Name->nodeValue = $Data[0]['value'];
unset($Data[0]);

// Set Table field
$Table = $doc->getElementsByTagName('Table')->item(0);
$Table->nodeValue = $Data[1]['value'];
unset($Data[1]);


$Data_Organized = array();

foreach($Data as $key => $value) {

    $Field = explode("_", $value['name']);
     
    if (count($Field) == 4) {
        $Data_Organized[$Field[0]][$Field[1]][(int) $Field[2]][$Field[3]] = $value['value'];
    }

}

// To xml
echo "<pre>";
print_r($Data_Organized);
echo "</pre>";


foreach($Data_Organized as $key => $value) {

    $root = $doc->getElementsByTagName($key)->item(0);
    
    while ($root->hasChildNodes()) {
        $root->removeChild($root->firstChild);
    }

    foreach($value as $key2 => $value2) {

        foreach($value2 as $key3 => $value3) {
            $nuevo_campo = $doc->createElement($key2);

            $nuevo_campo->setAttribute('id',(string) $key3);

            foreach($value3 as $key4 => $value4) {

                $newFieldData = $doc->createElement($key4);
                $newFieldData->appendChild($doc->createTextNode($value4));
                $nuevo_campo->appendChild($newFieldData);
        
                $root->appendChild($nuevo_campo);
            }
    
        }

    }

}

$doc->save($XML_FILE);


?>
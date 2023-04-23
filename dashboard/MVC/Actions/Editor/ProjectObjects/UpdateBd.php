<?php

require_once($Config->get('ROOT_CORE')."BaseSQL.php");

$BaseSQL = new BaseSQL("asd");

$XML_PATH = "";

if (isset($_POST['XML_FILE'])) {
    $XML_PATH = $_POST['XML_FILE'];
}

if (isset($_POST['IdRelation'])) {
    $Id_Relation = $_POST['IdRelation'];
}

// Get if table exists

$Table_Name = "";
$Table_Fields = [];

if (file_exists($XML_PATH)) {
    $XML = simplexml_load_file($XML_PATH);

    $Table = $XML->Table;

    // Comprove if table exists
    $BaseSQL->query("SHOW TABLES LIKE '".$Table->Name."'");

    if ($BaseSQL->getNumRows() > 0) {
        echo json_encode([
            'Error' => 'Table exists',
        ]);
    } else {
        // Table not exists
        // Create table with fields, primary key and foreign keys

        $Table_Name = $Table->Name;

        $Query = "CREATE TABLE ".$Table_Name." (";

        foreach ($XML->Fields->Field as $Field) {
            
            // <Name>email</Name>
            // <Type>varchar</Type>
            // <Length>50</Length>
            // <AutoIncrement>1</AutoIncrement>
            // <Required>1</Required>
            // <Default>NULL</Default>
            // <Unique>1</Unique>
            // <Null>1</Null>
            $Query .= $Field->Name." ".$Field->Type."(".$Field->Length.")
            AUTO_INCREMENT=".$Field->AutoIncrement."
            NOT NULL=".$Field->Required."
            DEFAULT=".$Field->Default."
            UNIQUE=".$Field->Unique."
            NULL=".$Field->Null." ";

            if ($Field->PrimaryKey == 1) {
                $Query .= "PRIMARY KEY (".$Field->Name.") ";
            }

        }
        
        //     <Relation id="3">
        //     <Field>4</Field>
        //     <Type>OneToOne</Type>
        //     <FKTable>Transfers</FKTable>
        //     <FKField>5</FKField>
        //      </Relation>

        foreach ($XML->Relations->Relation as $Relation) {
            $Query .= "FOREIGN KEY (".$Relation->Field.") REFERENCES ".$Relation->FKTable."(".$Relation->FKField."), ";
        }

        $Query = substr($Query, 0, -2);

        $Query .= ");";

        echo $Query;

        $BaseSQL->query($Query);

    }


}
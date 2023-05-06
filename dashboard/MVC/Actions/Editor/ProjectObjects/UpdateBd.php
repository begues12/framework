<?php

require_once($Config->get('ROOT_CORE')."BaseSQL.php");

$BaseSQL = new BaseSQL("asd");

$XML_PATH = "";

$Id_Relation = "";

$Project_Name = "";


if (isset($_POST['XML_FILE'])) {
    $XML_PATH = $_POST['XML_FILE'];
}

if (isset($_POST['ProjectName'])) {
    $Project_Name = $_POST['ProjectName'];
}

// Get if table exists

$Table_Name = "";
$Table_Fields = [];

if (file_exists($XML_PATH) && $Project_Name != "") {
    $XML = simplexml_load_file($XML_PATH);

    echo "<h3>XML</h3>";
    echo $XML->Table."<br>";
    // Comprove if table exists
    $Result = $BaseSQL->showTable($XML->Table);

    $Config->pre_array($Result);

    if ($Result[0]['NumRows'] > 0) {
        
        // Alter table

        $Table_Name = $XML->Table;


        $PrimaryKey = "";

        foreach ($XML->Fields->Field as $Field) {
            
            // <Name>email</Name>
            // <Type>varchar</Type>
            // <Length>50</Length>
            // <AutoIncrement>1</AutoIncrement>
            // <Required>1</Required>
            // <Default>NULL</Default>
            // <Unique>1</Unique>
            // <Null>1</Null>
            $Query = "ALTER TABLE ".$Table_Name." ";

            $Table_Data = $BaseSQL->showColumns($Table_Name);

            if ($Table_Data[0]['NumRows'] > 0) {
                // Field exists in table

                $results = $Table_Data[0]['Result'];

                $AlterModifyData = [];

                foreach($results as $result){

                    if ($result['Field'] == $Field->Name) {
                        // Field exists in table

                        if ($Field->AutoIncrement == 1) {
                            $AlterModifyData['AUTO_INCREMENT'] = '';
                        }

                        if ($Field->Default != "") {
                            $AlterModifyData['DEFAULT'] = "'".$Field->Default."'";
                        }

                        if ($Field->Unique == 1) {
                            $AlterModifyData['UNIQUE'] = '';
                        }

                        if ($Field->Null == 0) {
                            $AlterModifyData['NULL'] = 'NULL';
                        }else{
                            $AlterModifyData['NULL'] = 'NOT NULL';
                        }

                        if ($Field->PrimaryKey == 1) {
                            $PrimaryKey = true;
                        }

                    }

                }

                $Query = substr($Query, 0, -2);

                $Query .= ";";

                echo $Query;

                $BaseSQL->query($Query);

            } else {
                // Field not exists

                $Query .= "ADD ".$Field->Name." ".$Field->Type."(".$Field->Length.")";

                if ($Field->AutoIncrement == 1) {
                    $Query .= " AUTO_INCREMENT";
                }

                if ($Field->Default != "") {
                    $Query .= " DEFAULT ".$Field->Default;
                }

                if ($Field->Unique == 1) {
                    $Query .= " UNIQUE";
                }

                if ($Field->Null == 0) {
                    $Query .= " NOT NULL";
                }

                if ($Field->PrimaryKey == 1) {
                    $PrimaryKey = $Field->Name;
                }

                $Query .= ", ";
                
                $Query = substr($Query, 0, -2);

                $Query .= ";";

                $BaseSQL->query($Query);

            }

        }
        
        $BaseSQL->Apply();



    } else {
        // Table not exists
        // Create table with fields, primary key and foreign keys

        $Table_Name = $XML->Name;

        $Query = "CREATE TABLE ".$Table_Name." (";

        $PrimaryKey = "";

        foreach ($XML->Fields->Field as $Field) {
            
            // <Name>email</Name>
            // <Type>varchar</Type>
            // <Length>50</Length>
            // <AutoIncrement>1</AutoIncrement>
            // <Default>NULL</Default>
            // <Unique>1</Unique>
            // <Null>1</Null>
            
            $Query .= $Field->Name." ".$Field->Type."(".$Field->Length.")";

            if ($Field->AutoIncrement == 1) {
                $Query .= " AUTO_INCREMENT";
            }

            if ($Field->Default != "") {
                $Query .= " DEFAULT ".$Field->Default;
            }

            if ($Field->Unique == 1) {
                $Query .= " UNIQUE";
            }

            if ($Field->Null == 0) {
                $Query .= " NOT NULL";
            }

            if ($Field->PrimaryKey == 1) {
                $PrimaryKey = $Field->Name;
            }

            $Query .= ", ";

        }

        if ($PrimaryKey != "") {
            $Query .= "PRIMARY KEY (".$PrimaryKey."), ";
        }

        foreach ($XML->Relations->Relation as $Relation) {
            
            $XML_REFRENCES = simplexml_load_file($Config->get("URL_PROJECTS").$_POST["ProjectName"]."/Objects/".$Relation->FKTable.".xml");

            // <FKField>4</FKField> is a Id of Table Field
            // Find a field with this Id
            foreach ($XML_REFRENCES->Fields->Field as $Field) {
                if ($Field->Id == $Relation->FKField) {
                    $Query .= "FOREIGN KEY (".$Field->Name.") REFERENCES ".$Relation->FKTable."(".$XML_REFRENCES->PrimaryKey."), ";
                }
            }

        }

        $Query = substr($Query, 0, -2);

        $Query .= ");";

        $BaseSQL->query($Query);

        $BaseSQL->Apply();

    }


}else{
    echo "File not exists";
}
<?PHP

    $file = $_POST['ProjectPath'];

    // PUT $FILE CONTENT IN <CODE>
    $file_content = file_get_contents($file);

    echo "<pre style='width:100%; height:100%;' id='Code'>".$file_content."</pre>";

?>
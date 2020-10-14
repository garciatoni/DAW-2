<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Texto introducido: ".$_REQUEST["mytext"]."<br>";
    echo "Radiobutton elegido: ".$_REQUEST["myradio"]."<br>";
    if (isset($_REQUEST["mycheckbox"])){
        print_r("Checkbox elegido: ".$_REQUEST["mycheckbox"]."<br>");
    }
    echo "Opcion elegida: ".$_REQUEST["myselect"]."<br>";
    echo "Has introducido: ".$_REQUEST["mytextarea"]."<br>";
    $dir_subida = 'archivos/P3';
    $fichero = $dir_subida . basename($_FILES["Archivo"]["name"]);
    if (move_uploaded_file($_FILES['Archivo']['tmp_name'],$fichero)){
        echo "<img src=\"".$fichero."\"><br>";
        echo "<a href=\"",$fichero."\">link del fichero</a>";
    } else{
        echo "ERROR";
    }
} else {

?>
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <title>Exemple de formulari</title>
    
    </head>
    
    <body>
    
    <div style="margin: 30px 10%;">
    <h3>My form</h3>
    <form action="Practica3.php" enctype="multipart/form-data" method="post" id="myform" name="myform">
    
        <label>Text</label> <input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br /><br />
    
        <input type="radio" name="myradio" value="1" /> First radio
        <input type="radio" checked="checked" name="myradio" value="2" /> Second radio<br /><br />
    
        <input type="checkbox" name="mycheckbox" value="1" /> First checkbox
        <input type="checkbox" checked="checked" name="mycheckbox" value="2" /> Second checkbox<br /><br />
    
        <label>Select ... </label>
        <select name="myselect" id="">
            <optgroup label="group 1">
                <option value="1" selected="selected">item one</option>
            </optgroup>
            <optgroup label="group 2" >
                <option value="2">item two</option>
            </optgroup>
        </select><br /><br />
    
        <textarea name="mytextarea" id="" rows="3" cols="30">
        </textarea> <br /><br />
        <label for="Archivo"></label><input type="file" name="Archivo"><br /><br />
    
        <button id="mysubmit" type="submit">Submit</button><br /><br />
    
    </form>
    </div>
    
    </body>
    </html>



<?php

}

?>
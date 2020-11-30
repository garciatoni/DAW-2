<?php
$hora = date("G:a");
echo $hora;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <?php
    for ($i=0;$i<24;$i++){
        echo $i;
    }
    ?>
    </div>
    <div>
    <?php
    for ($i=0;$i<60;$i++){
        echo $i;
    }
    ?>
    </div>
    <div>
    <?php
    for ($i=0;$i<60;$i++){
        echo $i;
    }
    ?>
    </div>
</body>
</html>
<?php
$hora = date("G:a");
echo $hora;

?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>

    <?php
    /*
    for ($i=0;$i<24;$i++){
        if ($i == date(h)){
            echo $i;
        }else{
            echo $i;
        }
    }
    ?>
    </div>
    <div>
    <?php
    for ($i=0;$i<60;$i++){
        if (){

        }else{
            echo $i;
        }
    }
    ?>
    </div>
    <div>
    <?php
    for ($i=0;$i<60;$i++){
        if (){

        }else{
            echo $i;
        }
    }
    ?>
    </div>
</body>
</html>
-->
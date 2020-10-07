<table border="1">
    <?php
    //Cadenas de los dias de la semana y meses
    $mes = date("m"); 
    $año = date ("Y");
    $dia = date("d");
    $diaexacto = date("l");
    $meses = array ("Enero","Febrero", "Marzo", "Abril","Mayo","Junio","Julio","Agosto","Setiembre","Octubre","Noviembre","Diciembre");
    $semana = array ("Lunes","Martes", "Miercoles", "Jueves","Viernes","Sabado","Domingo");
    $semanaingles = array ("Mon","Tue", "Wed", "Thu","Fri","Sat","Sun"); //Esta array la he tenido que poner por unos problemas que explico mas adelante.
    $mess = $meses[$mes-1];
    echo $semana[date("w")];
    //inicio del calendario
    echo "<thead>";
    echo "<tr>";
    echo "<th>",$año,"</th>";
    echo "<th>",$mess,"</th>";
    echo "</tr>";
    echo "<tr>";
    //Printo los dias de la semana.
    for ($i=0;$i<7;$i++) {
    echo "<th>$semana[$i]</th>";}
    echo "</tr>";
    echo "</thead>";
    //Inicio la cuenta de los numeros.He encontrado mktime para poder encotrar que dia es el primer dia del mes. Mktime obtiene la marca de tiempo unix de la fecha (El primero de enero de 1970, la invencion de linux)
    echo "<tbody>";
    echo "<tr>";
    for ($i=0;$i<=6;$i++){ //La funcion de semanaongles, la he tenido que usar para comparar el resultado de mktime, ya que este devuelve el texto en ingles.
        if (date("D",mktime(0,0,0,$mes,1,$año))==$semanaingles[$i]){  //Funciona tal que: los 3 primeros 0 son los segundos, minutos y horas. Luego introduces el mes, el dia y el año. La D que hay justo delante del mktime marca el tipo de fecha que "compara".
            echo "<td>", date("d", mktime(0,0,0,$mes,1,$año)) ,"</td>"; 
            break;
        }else{
            echo  "<td>", "</td>"  ;
        }
    }
    //Aqui genero los otros numeros apartir del primero.
    for ($j=2;$j<=date("t");$j++){
        if ( date("D",mktime(0,0,0,$mes,$j,$año))=="Sun" )  {
            echo      "<td>",   date("d", mktime(0,0,0,$mes,$j,$año)), "</td >", "</tr>", "<tr>"; 
        }else{
            echo      "<td>",   date("d", mktime(0,0,0,$mes,$j,$año)) ,  "</td>" ;
        }
    }
    //La informacion la he sacado de https://www.php.net/
    echo "</tbody>";
    ?>
</table>

<?php
$monthNames = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", 
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

if (!isset($_REQUEST["mes"])) $_REQUEST["mes"] = date("n");
if (!isset($_REQUEST["anio"])) $_REQUEST["anio"] = date("Y");

$cMonth = $_REQUEST["mes"];
$cYear = $_REQUEST["anio"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>
<table width="200" style="border:1px solid #999">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left"><a href="<?php echo $_SERVER["PHP_SELF"]."?mes=". $prev_month."&anio=".$prev_year; ?>" style="color:#FFFFFF">Anterior</a></td>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"]."?mes=". $next_month."&anio=".$next_year; ?>" style="color:#FFFFFF">Siguiente</a></td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Lunes</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Martes</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Miercoles</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Jueves</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Viernes</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Sabado</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>Domingo</strong></td>
</tr>
<?php 
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ) echo "<tr>";
    if($i < $startday) echo "<td></td>";
    else  {?>
		<td align="center" valign="middle" height="20px" <?php if ((date("d")== $i - $startday + 1) && !isset ($_GET['mes'])){?> style="background:#999; color:#FFF"<?php }?>> <?php echo ($i - $startday + 1) ?> </td>
	<?php }
    if(($i % 7) == 6 ) echo "</tr>";
}
?>
</table>
</td>
</tr>
</table>
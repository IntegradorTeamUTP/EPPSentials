<?php
 
require_once ("../../include/initialize.php");

header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header("Content-type:   application/x-msexcel; charset=utf-8");
header('Content-Disposition: attachment; filename=excelClientes.xls');
header('Pragma: no-cache');
header('Expires: 0');
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$query="SELECT *,SUM(ORDEREDQTY) as 'QTY'  FROM `tblproduct` P  ,`tblpromopro` PR ,`tblorder` O, `tblsummary` S ,`tblcustomer` C 
WHERE P.`PROID`=PR.`PROID` AND PR.`PROID`=O.`PROID` AND O.`ORDEREDNUM`=S.`ORDEREDNUM` AND S.`CUSTOMERID`=C.`CUSTOMERID`  
 GROUP BY `PRODESC`";

$mydb->setQuery($query);
$cur = $mydb->loadResultList();

?>
<h4 align="center">REPORTE DE VENTAS</h4>
<table width="80%" border="1" align="center">
  <tr bgcolor="#5970B2" align="center" class="encabezadoTabla">
    <td width="15%" bgcolor="#3399CC">Fecha de Orden</td>
    <td width="30%" bgcolor="#3399CC">Nombres</td>
    <td width="5%" bgcolor="#3399CC">Costo</td>
    <td width="5%" bgcolor="#3399CC">Precio</td>
    <td width="5%" bgcolor="#3399CC">Cantidad</td>
    <td width="5%" bgcolor="#3399CC">SubTotal</td> 
  </tr>
  <?php  
  foreach ($cur as $result) {
      $AMOUNT = $result->PROPRICE * $result->QTY ;
  ?>
  <tr>
    <td><?php echo date_format(date_create($result->ORDEREDDATE),'M/d/Y h:i:s')?></td>
    <td><?php echo $result->PRODESC?></td>
    <td><?php echo $result->ORIGINALPRICE?></td>
    <td><?php echo $result->PROPRICE?></td>
    <td><?php echo $result->QTY?></td>
    <td><?php echo $AMOUNT?></td>
  </tr>
  <?php 
   }//cerrar el while
  ?>
</table>
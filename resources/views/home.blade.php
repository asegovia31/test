@extends('layout')
<?php
   $hoy = date("Y-m-d");
?>

@section('mensajenotas')
   @if(empty($arreglomsj))
    <div style="font-size:26px"><?php echo "Sin Notas para Hoy";?></div>
   @else
      @foreach($arreglomsj as $values)
        <?php
        echo $values->mensaje;
        ?>
      @endforeach
   @endif
@endsection

@section ('actualizados')
  @if(empty($resp))
        Actualizado : Sin Registros
  @else
       @foreach($resp as $resps)
         Actualizado : <?php echo $resps->oc;?>
       @endforeach
  @endif
@endsection


@section ('inconsistencia_en_programacion')
<a href="#top">Inconsistencias en la programación para el día <?php echo $hoy ?></a>
  <table>
     <th>Tipo de error</th>
      <th>Numero de cita</th>
      <th>Hora de inicio</th>
      <th>Fecha de cita</th>
      <th>Descripción de departamento</th>
      <th>Razón social</th>

     @foreach($consutadis as $arr)
           <tr>
             <td>Cita agendada no se encuentra en programación</td>
             <td><?php echo $arr->cita; ?></td>
             <td><?php echo $arr->digita_inicio; ?></td>
             <td><?php echo $arr->fech_cita; ?></td>
             <td><?php echo utf8_encode($arr->decrip_depto); ?></td>
             <td><?php echo utf8_encode($arr->rs);  ?></td>
           </tr>
      @endforeach

     </table>


@endsection

@section('errores_de_agenda')

<a href="#top">Errores de agenda</a>
<table>
  <th>Tipo de error</th>
  <th>OC</th>
      <th>Numero de cita</th>
      <th>Hora de inicio</th>
      <th>Fecha de cancelación</th>
      <th>Descripción de departamento</th>
      <th>Razón social</th>

   @foreach($resultnoagen as $arr2)

      <tr>
        <td>ASR/AWR no agendada en fecha de cancelación </td>
        <td><?php echo $arr2->oc; ?></td>
        <td><?php echo $arr2->cita; ?></td>
        <td><?php echo $arr2->digita_inicio; ?></td>
        <td><?php echo date_format(new DateTime($arr2->cancela_oc), 'Y-m-d H:i:s'); ?></td>
        <td><?php echo utf8_encode($arr2->decrip_depto); ?></td>
        <td><?php echo utf8_encode($arr2->rs);  ?></td>
      </tr>
    @endforeach


     <?php
//while ($arr3=(sqlsrv_fetch_array($resultpre))) { ?>

    @foreach($resultpre as $arr3)
      <tr>
        <td>Almacenaje agendada como predistribuida </td>
        <td><?php echo $arr3->oc; ?></td>
        <td><?php echo $arr3->cita; ?></td>
        <td><?php echo $arr3->digita_inicio; ?></td>
        <td><?php echo date_format(new DateTime($arr3->cancela_oc), 'Y-m-d H:i:s'); ?></td>
        <td><?php echo utf8_encode($arr3->decrip_depto); ?></td>
        <td><?php echo utf8_encode($arr3->rs);  ?></td>
      </tr>
    @endforeach


    <?php
//while ($arr4=(sqlsrv_fetch_array($resulsimple))) { ?>
    @foreach($resulsimple as $arr4)
      <tr>
        <td>Pre distribuida almacenada como almacenaje</td>
        <td><?php echo $arr4->oc; ?></td>
        <td><?php echo $arr4->cita; ?></td>
        <td><?php echo $arr4->digita_inicio; ?></td>
        <td><?php echo date_format(new DateTime($arr4->cancela_oc), 'Y-m-d H:i:s'); ?></td>
        <td><?php echo utf8_encode($arr4->decrip_depto); ?></td>
        <td><?php echo utf8_encode($arr4->rs);  ?></td>
      </tr>
    @endforeach

    @foreach($resultadoasrawr as $arr5)
      <?php
      //while ($arr4=(sqlsrv_fetch_array($resultadoasrawr))) { ?>
      <tr>
        <td>ASR Y AWR unidades en sin pre distribución </td>
        <td><?php echo $arr5->oc; ?></td>
        <td><?php echo $arr5->cita; ?></td>
        <td><?php echo $arr5->digita_inicio; ?></td>
        <td><?php echo date_format(new DateTime($arr5->cancela_oc), 'Y-m-d H:i:s'); ?></td>
        <td><?php echo utf8_encode($arr5->decrip_depto); ?></td>
        <td><?php echo utf8_encode($arr5->rs);  ?></td>
      </tr>
      @endforeach
</table>
@endsection


@section('contenedor_general')

    @foreach($con_d as $con2)
      <?php
       $scaj=$con2->semana;
       $fcaj=$con2->finde;
      ?>
    @endforeach
  <div id="grilla_fila" style="border-top:#FF0000 solid 2px; border-bottom:#FF0000 solid 2px;">
  <div id="grilla_type0">CAJAS</div>
  <div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>
  </div>

  <?php
  //VERDE
  //RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA


  for($i=0 ; $i<=13 ; $i++){
  $d='+ '.$i." ".'day';
  $day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
  $position_day=date("w",strtotime($day));
  $v1=round($scaj-($scaj*20/100));
  $v2=round($fcaj-($fcaj*20/100));
//  while($arr2=sqlsrv_fetch_array($x2)){
$sql_iteracion=DB::select("select (sum(cast(sin_pred as int))+sum((cast(con_pred as int)))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)) as tabla");

?>
  @foreach($sql_iteracion as $arr2)
  <?php
    $n1=$arr2->tot_unid;

    if($n1>=$con2->semana){
  ?>
        <div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
  <?php }elseif(($n1>=$con2->finde)&&($position_day=='6')){?>
        <div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
  <?php }elseif(($n1<=$con2->semana)&&($n1>=$v1)|| ($n1<=$con2->finde)&&($n1>=$v2)&&($position_day=='6')){?>
        <div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
  <?php }elseif($n1<='0'){?>
        <div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
  <?php }else{?>
        <div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
     <?php }?>
   @endforeach
     <?php }?>



     <!-- BUSCAMOS CANTIDAD DE CITAS POR MANEJO-->
     <?php
     //BUSCO LAS CAPACIDAD DE BD
    // $cons="SELECT * FROM capacidad WHERE tipo_manejo='Citas'";
    // $y=sqlsrv_query($conexion,$cons);
    // $con2=sqlsrv_fetch_array($y);
?>

@foreach($cap_cit as $con3)
  <?php
   $scaj=$con3->semana;
   $fcaj=$con3->finde;
  ?>
@endforeach

     <div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
     <?php
     //RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
     for($i=0 ; $i<=13 ; $i++){
     $d='+ '.$i." ".'day';
     $day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
     $position_day=date("w",strtotime($day));
     //EJECUTO LA CONSULTA EN LA ITERACION

     $sql2=DB::select("SELECT COUNT(distinct(cita)) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='CAJ'
      AND tipo_orden <> 'Almacenaje Proveedor' AND  cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");

     //$x3=sqlsrv_query($conexion,$sql2);

     //while($arr3=sqlsrv_fetch_array($x3)){
   ?>
     @foreach($sql2 as $arr3)
    <?php

     $c1=$arr3->tot_cita;
     if($c1>=$con3->semana){
     ?>
     <div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
   <?php }elseif(($c1>=$con3->finde)&&($position_day=='6')){?>
     <div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
   <?php }elseif(($c1<=$con3->semana)&&($c1>=$v1)|| ($c1<=$con3->finde)&&($c1>=$v2)){?>
     <div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
     <?php }elseif($c1<='0'){?>
     <div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
     <?php }else{?>
     <div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

    <?php }?>
    @endforeach
    <?php }?>
     </div>

     <!-- **************************************************************************************************************************-->
     <!-- FIN PRIMER MANEJO(CAJAS) -->
     <!-- **************************************************************************************************************************-->


     <div id="grilla_fila_grupos2" style="border-top:#FF0000 solid 2px; border-bottom:#FF0000 solid 2px;">

     <!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
     <?php
     //BUSCO LAS CAPACIDAD DE BD
     $cons_manejo_und=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG1'");


    ?>
    @foreach ($cons_manejo_und as $cons_ma_un)
    <?php
     $scaj=$cons_ma_un->semana;
     $fcaj=$cons_ma_un->finde;
     ?>
    @endforeach


     <div id="grilla_fila_grupos"  >
     <div id="grilla_type00">Unidad G1(x 100)</div>
     <div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
     <?php

     //RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
     for($i=0 ; $i<=13 ; $i++){
     $d='+ '.$i." ".'day';
     $day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
     $position_day=date("w",strtotime($day));
     $v1=round($scaj-($scaj*20/100));
     $v2=round($fcaj-($fcaj*20/100));
     //EJECUTO LA CONSULTA EN LA ITERACION
     /*
     Consulta original
     $sql2="select (sum(sin_pred)+sum(con_pred)) as tot_unid from
     (select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival ON citas.cod_depto=equival.depto
     where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND equival.grupo='1' GROUP BY citas.cita)
     as tabla ";
     */
     $sql2_iteracion=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
     (select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival ON citas.cod_depto=equival.depto
     where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND equival.grupo='1' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
     as tabla ");

  ?>

     @foreach ($sql2_iteracion as $arr2)
<?php
     $n1=$arr2->tot_unid;
     $n2=$n1*100 ;
     if($n1>=$cons_ma_un->semana){
     ?>
     <a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
     <div id="grilla_type2" style="background-color:#ff5555; color:#fff; font-weight:bold "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

     <?php }elseif(($n1>=$cons_ma_un->finde)&&($position_day=='6')){?>
     <a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
     <div id="grilla_type2" style="background-color:#ff5555; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

     <?php }elseif(($n1<=$cons_ma_un->semana)&&($n1>=$v1)|| ($n1<=$cons_ma_un->finde)&&($n1>=$v2)&&($position_day=='6')){?>
     <a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
     <div id="grilla_type2" style="background-color:#fabb3d; color:#363023; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
     <?php }elseif($n1<='0'){?>

     <a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
     <div id="grilla_type2" style="background-color:#42910e; color:#fff;  text-align:center;"><?php echo ('-');?></div></a>
     <?php }else{?>

     <a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
     <div id="grilla_type2" style="background-color:#42910e; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
     <?php }?>
     @endforeach
     <?php } $n1; ?>
     </div>

<!----------------------------------------------------------------------------------------------------------------->


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G2(X 50)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_50=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG2'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);

foreach($cons_cap_50 as $cap50)
{
$scaj=$cap50->semana;
$fcaj=$cap50->finde;
}
?>


<div id="grilla_fila_grupos" >
<div id="grilla_type00">Unidad G2(x 50)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>


<?php

//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql_ite_50_cap=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden <> 'Almacenaje Proveedor' AND equival.grupo='2' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
?>
@foreach ($sql_ite_50_cap as $arr2)
<?php
$n1=$arr2->tot_unid;
$n2=$n1*50 ;
if($n1>=$cap50->semana){
?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; font-weight:bold "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1>=$cap50->finde)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#ff5555; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>

<?php }elseif(($n1<=$cap50->semana)&&($n1>=$v1)|| ($n1<=$cap50->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }elseif($n1<='0'){?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff;  text-align:center;"><?php echo ('-');?></div></a>
<?php }else{?>

<a href="" title="<?php echo number_format($n2, 0, ",", ".");?>">
<div id="grilla_type2" style="background-color:#42910e; color:#fff; "><?php  echo number_format($n1, 0, ",", ".");?></div></a>
<?php }?>
@endforeach
<?php } $n1; ?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G3(X 1)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_g3=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='UNDG3'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);

foreach($cons_cap_g3 as $con_ca_g3){
$scaj=$con_ca_g3->semana;
$fcaj=$con_ca_g3->finde;
}
?>
<div id="grilla_fila_grupos" >
<div id="grilla_type00">Unidad G3(x 1)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql_ite_ca_g3=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='3' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
?>
@foreach ($sql_ite_ca_g3 as $arr2)
<?php
$g3=$arr2->tot_unid;
if($g3>=$con_ca_g3->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif(($g3>=$con_ca_g3->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif(($g3<=$con_ca_g3->semana)&&($g3>=$v1)|| ($g3<=$con_ca_g3->finde)&&($g3>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }elseif($g3<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center;"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($g3, 0, ",", ".");?></div>
<?php }?>
@endforeach
<?php }?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_g1=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='MAXFG3'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_g1 as $con_cap_g1)
{
$scaj=$con_cap_g1->semana;
$fcaj=$con_cap_g1->finde;
                    }
?>
<div id="grilla_fila_grupos" >
<div id="grilla_type00">Maximo F[G3]</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));

$sql_inte1_capg=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int)))*100 as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='1' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");

//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql_inte1_capg as $sql_inte1_capgs){
 $var1=$sql_inte1_capgs->tot_unid;
}
//}

$sql_inte2_capg=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int)))*50 as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='2' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql_inte2_capg as $sql_inte2_capgs)
{
 $var2=$sql_inte2_capgs->tot_unid;
}

$sql_inte3_capg=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from
(select distinct(citas.cita),citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo from citas INNER JOIN equival
ON citas.cod_depto=equival.depto
where fech_cita ='$day' and manejo='CAJ' and tipo_orden<>'Almacenaje Proveedor' AND equival.grupo='3' GROUP BY citas.cita,citas.sin_pred,citas.con_pred,citas.cod_depto,equival.grupo)
as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2))
foreach($sql_inte3_capg as $sql_inte3_capgs)
{
$var3=$sql_inte3_capgs->tot_unid;
}

$f3=$var1+$var2+$var3 ;
if($f3>=$con_cap_g1->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif(($f3>=$con_cap_g1->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif(($f3<=$con_cap_g1->semana)&&($f3>=$v1)|| ($f3<=$con_cap_g1->finde)&&($f3>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>
<?php }elseif($f3<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center;"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($f3, 0, ",", ".");?></div>

<?php }} ?>


</div>
</div>
@endsection

@section('info_rel_sensible')
<!-- BUSCAMOS INFORMACION RELACIONADA CON SENSIBLES-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cap_man_sen=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='SEN'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);

foreach($cap_man_sen as $cap_man_sens)
{
$scaj=$cap_man_sens->semana;
$fcaj=$cap_man_sens->finde;
}
?>

<div id="grilla_fila" style="border-top:#810081 solid 2px; border-bottom:#810081 solid 2px;">
<div id="grilla_type0">SENSIBLE</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>
</div>

<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
//$sql2="select (sum(sin_pred)+sum(con_pred)) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='SEN' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla";
$sql_ite_capr=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='SEN' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");

//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql_ite_capr as $arr2)
{
$n1=$arr2->tot_unid;
if($n1>=$cap_man_sens->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$cap_man_sens->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$cap_man_sens->semana)&&($n1>=$v1)|| ($n1<=$cap_man_sens->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>


<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_g3_3x=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");

//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_g3_3x as $cons_cap_g3_3xs)
{
$scaj=$cons_cap_g3_3xs->semana;
$fcaj=$cons_cap_g3_3xs->finde;
}
?>

<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2_ite_cap3=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='SEN' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");


foreach($sql2_ite_cap3 as $sql2_ite_cap3s){
//$x3=sqlsrv_query($conexion,$sql2);
//while($arr3=sqlsrv_fetch_array($x3)){
$c1=$sql2_ite_cap3s->tot_cita;

if($c1>=$cons_cap_g3_3xs->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$cons_cap_g3_3xs->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$cons_cap_g3_3xs->semana)&&($c1>=$v1)|| ($c1<=$cons_cap_g3_3xs->finde)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

<?php }
      }
      }?>
</div>

@endsection


@section('info_rel_colgado')
<!-- BUSCAMOS INFORMACION RELACIONADA CON COLGADO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_col=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='COL'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_col as $cons_cap_cols)
{
$scaj=$cons_cap_cols->semana;
$fcaj=$cons_cap_cols->finde;
}
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
?>

<div id="grilla_fila" style="border-top:#fec409 solid 2px; border-bottom:#fec409 solid 2px;">
<div id="grilla_type0">COLGADO</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));

//EJECUTO LA CONSULTA EN LA ITERACION
$sql_ite_col=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='COL' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");

//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql_ite_col as $sql_ite_cols)
{
$n1=$sql_ite_cols->tot_unid;
if($n1>=$cons_cap_cols->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$cons_cap_cols->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$cons_cap_cols->semana)&&($n1>=$v1)|| ($n1<=$cons_cap_cols->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_cit=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_cit as $cons_cap_cits)
{
$scaj=$cons_cap_cits->semana;
$fcaj=$cons_cap_cits->finde;
}
?>
<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql_ite_cit=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='COL' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x3=sqlsrv_query($conexion,$sql2);
//while($arr3=sqlsrv_fetch_array($x3)){
foreach($sql_ite_cit as $sql_ite_cits)
{
$c1=$sql_ite_cits->tot_cita;
if($c1>=$cons_cap_cits->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$cons_cap_cits->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$cons_cap_cits->semana)&&($c1>=$v1)|| ($c1<=$cons_cap_cits->finde)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>

<?php }}}?>
</div>

@endsection

@section('info_rel_gvo')

<!-- BUSCAMOS INFORMACION RELACIONADA CON GVO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$con_cap_gvo=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='GVO'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($con_cap_gvo as $con_cap_gvos)
{
$scaj=$con_cap_gvos->semana;
$fcaj=$con_cap_gvos->finde;
}
?>

<div id="grilla_fila" style="border-top:#895455 solid 2px; border-bottom:#895455 solid 2px;">
<div id="grilla_type0">GVO</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
foreach ($sql2 as $arr2) {
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
$sql3=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid2 from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='CAJ' AND tipo_orden in('Almacenaje Proveedor','OC Almacenaje Proveedor') AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
foreach($sql3 as $arr3)
{
//	$x3=sqlsrv_query($conexion,$sql3);
//	$arr3=sqlsrv_fetch_array($x3);
$n1=$arr2->tot_unid + $arr3->tot_unid2;
}
if($n1>=$con_cap_gvos->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$con_cap_gvos->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$con_cap_gvos->semana)&&($n1>=$v1)|| ($n1<=$con_cap_gvos->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='Citas'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_type1">Citas (<?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?>)</div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
//EJECUTO LA CONSULTA EN LA ITERACION
//consultar esta seccion
$sql2=DB::select("SELECT COUNT(cita) AS tot_cita FROM citas WHERE fech_cita='$day' AND manejo='GVO' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");

//$x3=sqlsrv_query($conexion,$sql2);
//while($arr3=sqlsrv_fetch_array($x3)){
foreach($sql2 as $cita_manejo_gvo){

	$sql3=DB::select("SELECT COUNT(cita) AS tot_cita2 FROM citas WHERE fech_cita='$day' AND manejo='CAJ' AND tipo_orden in('Almacenaje Proveedor','OC Almacenaje Proveedor') AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//	$x3=sqlsrv_query($conexion,$sql3);
//	$arr3_t2=sqlsrv_fetch_array($x3);
foreach($sql3 as $cita_manejo_caj){
$c1=$cita_manejo_gvo->tot_cita + $cita_manejo_caj->tot_cita2;
}
if($c1>=$con2->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1>=$con2->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif(($c1<=$con2->semana)&&($c1>=$v1)|| ($c1<=$con2->finde)&&($c1>=$v2)){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }elseif($c1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($c1, 0, ",", ".");?></div>
<?php }}}?>
</div>
@endsection

@section('info_rel_col_mueb_lin_blanca')


<div id="grilla_fila_grupos2" style="border-top:#895455 solid 2px; border-bottom:#895455 solid 2px;">

<!-- BUSCAMOS INFORMACION RELACIONADA CON COLCHONERÍA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_colch=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='COLC'");

//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_colch as $cons_cap_colchs)
{
$scaj=$cons_cap_colchs->semana;
$fcaj=$cons_cap_colchs->finde;
}
?>

<div id="grilla_fila_grupos">
<div id="grilla_type00">COLCHONERÍA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql_colchoneria=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D360' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql_colchoneria as $sql_colchonerias)
{
$n1=$sql_colchonerias->tot_unid;
if($n1>=$cons_cap_colchs->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$cons_cap_colchs->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$cons_cap_colchs->semana)&&($n1>=$v1)|| ($n1<=$cons_cap_colchs->finde)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON MUEBLERÍA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_mueble=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='MUE'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_mueble as $cons_cap_muebles)
{
$scaj=$cons_cap_muebles->semana;
$fcaj=$cons_cap_muebles->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">MUEBLERÍA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D359' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;

if($n1>=$cons_cap_muebles->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$cons_cap_muebles->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$cons_cap_muebles->semana)&&($n1>=$v1)|| ($n1<=$cons_cap_muebles->finde)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }}}?>

</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON LINEA BLANCA-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons_cap_lin_blan=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='LINB'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons_cap_lin_blan as $cons_cap_lin_blans)
{
$scaj=$cons_cap_lin_blans->semana;
$fcaj=$cons_cap_lin_blans->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">LINEA BLANCA</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D136' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
if($n1>=$cons_cap_lin_blans->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$cons_cap_lin_blans->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$cons_cap_lin_blans->semana)&&($n1>=$v1)|| ($n1<=$cons_cap_lin_blans->finde)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>
@endsection

@section('info_rel_tv_video_alfombras_btcajas')


<!-- BUSCAMOS INFORMACION RELACIONADA CON TV-VIDEO-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='TVV'");

//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons as $con2)
{
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00" >TV-VIDEO</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D171' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
if($n1>=$con2->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$con2->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$con2->semana)&&($n1>=$v1)|| ($n1<=$con2->finde)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>


</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON ALFOMBRAS-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='ALF'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">ALFOMBRAS</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("select (sum(cast(sin_pred as int))+sum(cast(con_pred as int))) as tot_unid from (select distinct(cita),sin_pred,con_pred from citas where fech_cita ='$day' and manejo='GVO' AND cod_depto='D102' AND  cita NOT IN (SELECT (nro_cta) FROM puertaexpress)) as tabla");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
if($n1>=$con2->semana){
?>

<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$con2->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$con2->semana)&&($n1>=$v1)|| ($n1<=$con2->finde)&&($n1>$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>

</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON bt caja-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='BTCAJA'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);
foreach($cons as $con2){
$scaj=$con2->semana;
$fcaj=$con2->finde;
}
?>
<div id="grilla_fila_grupos">
<div id="grilla_type00">BT CAJAS(GVO)</div>
<div id="grilla_type1" style="font-size:11px;"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($day));
$v1=round($scaj-($scaj*20/100));
$v2=round($fcaj-($fcaj*20/100));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cast(con_pred as int))+SUM(cast(sin_pred as int))) AS tot_unid  FROM citas WHERE fech_cita='$day' AND manejo='GVO' AND cita NOT IN (SELECT (nro_cta)  FROM puertaexpress)");
//$x2=sqlsrv_query($conexion,$sql2);
foreach($sql2 as $arr2)
{
//while($arr2=sqlsrv_fetch_array($x2)){
$n1=$arr2->tot_unid;
if($n1>=$con2->semana){
?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1>=$con2->finde)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#ff5555; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif(($n1<=$con2->semana)&&($n1>=$v1)|| ($n1<=$con2->finde)&&($n1>=$v2)&&($position_day=='6')){?>
<div id="grilla_type2" style="background-color:#fabb3d; color:#363023; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>
<?php }elseif($n1<='0'){?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold; text-align:center"><?php echo ('-');?></div>
<?php }else{?>
<div id="grilla_type2" style="background-color:#42910e; color:#FFF; font-weight:bold;"><?php echo number_format($n1, 0, ",", ".");?></div>

<?php }}}?>
</div>
</div>
</div>

@endsection

@section('puertaexpress')

<!-- MOSTRAMOS LAS FECHAS-->
<div id="grilla_fila1">
<div id="grilla_type11">Tipo Manejo</div>
<div id="grilla_type12">Unidades MAX </br>(Lun. a Vier. | Sáb.)</div>
<?php for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$dia=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$position_day=date("w",strtotime($dia));
if($position_day=='0'){
?>
<div id="grilla_type22" style="color:#fff; background-color:#FF0000; font-weight:bold;"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }else if($position_day=='6'){?>
<div id="grilla_type22" style="color:#fff; font-weight:bold;"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }else{?>
<div id="grilla_type22"> <?php echo date("d-M",strtotime($dia));?></div>
<?php }}?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->

<div id="grilla_fila_pta">
<div id="grilla_type00"></div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
$Und="Und.";
$Bulto="Bult.";
?>
<div id="grilla_pta" style="font-weight:bold; color:#333333"><?php echo ($Und);?></div>
<div id="grilla_pta" style="font-weight:bold; color:#333333"><?php echo ($Bulto);?></div>
<?php }?>
</div>

<!-- BUSCAMOS INFORMACION RELACIONADA CON CAJA PUERTA EXPRESS-->

<div id="grilla_fila_pta">
<div id="grilla_type00">CAJA</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cast(cant_unid_agen as int))) AS tot_unid, (SUM(cast(bultos as int))) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='CAJ'");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2){
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
}
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{ ?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>

<?php }?>

<?php
if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">SENSIBLE</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cast(cant_unid_agen as int))) AS tot_unid, (cast(SUM(bultos) as int)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='SEN'");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach ($sql2 as $arr2) {
  $n1=$arr2->tot_unid;
  $n2=$arr2->tot_bult;

}

?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G2(X 50)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">COLGADO</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cast(cant_unid_agen as int))) AS tot_unid, (SUM(cast(bultos as int))) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='COL'");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
}

?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>


<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G3(X 1)-->

<div id="grilla_fila_pta">
<div id="grilla_type00">GVO</div>
<div id="grilla_type1"></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cast(cant_unid_agen as int))) AS tot_unid, (SUM(cast(bultos as int))) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day' AND tipo_manejo='GVO'");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach($sql2 as $arr2)
{
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
}
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>



<!-- BUSCAMOS INFORMACION RELACIONADA CON UNIDAD G1(X 100)-->
<?php
//BUSCO LAS CAPACIDAD DE BD
$cons=DB::select("SELECT * FROM capacidad WHERE tipo_manejo='PtaExpress'");
//$y=sqlsrv_query($conexion,$cons);$con2=sqlsrv_fetch_array($y);

foreach ($cons as $con2) {
  $scaj=$con2->semana;
  $fcaj=$con2->finde;
}

?>
<div id="grilla_fila_pta">
<div id="grilla_type00">TOTAL</div>
<div id="grilla_type1"><?php echo number_format($scaj, 0, ",", ".");?> | <?php echo number_format($fcaj, 0, ",", ".");?></div>
<?php
//RECORRO LAS FECHAS FUTURAS HASTA 14 DIAS, SE GENERA LA VARIABLE DINAMICA
for($i=0 ; $i<=13 ; $i++){
$d='+ '.$i." ".'day';
$day=date("Y-m-d",strtotime($d ,strtotime($hoy)));
//EJECUTO LA CONSULTA EN LA ITERACION
$sql2=DB::select("SELECT (SUM(cant_unid_agen)) AS tot_unid, (SUM(bultos)) AS tot_bult  FROM puertaexpress WHERE fech_cta='$day'");
//$x2=sqlsrv_query($conexion,$sql2);
//while($arr2=sqlsrv_fetch_array($x2)){
foreach ($sql2 as $arr2) {
$n1=$arr2->tot_unid;
$n2=$arr2->tot_bult;
}
?>
<?php
if(empty($n1)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n1, 0, ",", ".");?>
</span>
	<?php echo number_format($n1, 0, ",", ".");?>
</div>


<?php
}

if(empty($n2)){?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext"> - </span>  </div>
<?php }else{?>
<div id="grilla_pta_num" style="color:#333;" class="tooltip">
<span class="tooltiptext">
	<?php echo number_format($n2, 0, ",", ".");?>
</span>
	<?php echo number_format($n2, 0, ",", ".");?>
</div>


<?php }} ?>
</div>




<!-- **************************************************************************************************************************-->
<!-- FIN DE PUERTA EXPRESS-->
<!-- **************************************************************************************************************************-->




@endsection

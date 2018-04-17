<?php
  require_once('../nusoap/lib/nusoap.php');
  
  $campana=$_GET['campana'];
  $parque=$_GET['parque'];
  $codigo=$_GET['codigo'];
  $numero=$_GET['numero'];

  $client = new soapclient('http://192.168.80.73/postventa/detallereporte.php?wsdl');
  $persona = array('campana' => $campana, 'parque' => $parque, 'codigo' => $codigo, 'numero' => $numero, 'usuario' => 'mnunezj', 'valida' => 'sendero01');
  $entrada_detalle_reporte = $client->call('entrada_detalle_reporte', array('entrada_detalle_reporte' => $persona));
  $entrada_reportes = $client->call('entrada_reporte', array('entrada_reporte' => $persona));
  //$entrada_probando = $client->call('entrada_prueba', array('entrada_prueba' => $persona));
   //print_r($entrada_reportes);
$fechas = array("DATOS CONFIRMADOS" => $entrada_reportes[0]['DATOS_CONFIRMADOS'],
                "CERRADO" => $entrada_reportes[0]['CERRADO'],
                "DERIVACION VENTAS" => $entrada_reportes[0]['DERIVACION_VENTAS'],
                "DERIVACION LEGAL" => $entrada_reportes[0]['DERIVACION_LEGAL'],
                "DERIVACION SUPERVISORES" => $entrada_reportes[0]['DERIVACION_SUPERVISORES']);
 $derivacion = array();
 foreach ($fechas as $estado => $fecha) {
   if(strpos($estado, 'DERIVACION') !== false){
    if (empty($fecha) == false) {
      $derivacion[$estado] = $fecha;
      $areaderivacion = explode(" ",$estado)[1];
    }
   }
 }
$entrada_reportes2 = array();
foreach ($entrada_reportes as $key => $value) {
  if($key > 0){
  $entrada_reportes2[$key] = $value;
}
}
foreach ($entrada_reportes2 as $key => $report) {
  foreach ($fechas as $estado => $fecha) {
    if ($estado == $report['ESTADO'] ) {
      if (empty($fecha) == false) {
        foreach ($entrada_reportes2 as $key2 => $noimporta) {
          if ($key2 <= $key) {
            $entrada_reportes2[$key2][$estado] = $fecha;
          }
        }
      }
    }
  }
}
echo "<pre>";
print_r($entrada_reportes2);
 ?>

 <!DOCTYPE html>
 <html lang="en">
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title></title>

     <!-- Bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

     <style>
      body{
        background-image: url('imagenes/fondoportal.png');
        background-repeat: no-repeat;
        background-size: cover;
        font-family: verdana, sans-serif;
        font-size: 12px;
        font-style: normal;
        font-variant: normal;
        font-weight: 300;
      }
      .table{
        font-size:11px;
      }
      .form-group{
        margin-top: 5px;
      }
      .Fields {
        background-color: #F39C12 !important;
        color: white;
        font-size:11px;
        height: 20px;
      }
      .InputStyle {
        font-size:11px;
        height: 20px;
        padding: 2px;
      }

      .InputStyleTable {
        font-size:11px;
        height: 20px;
        text-align: right;
      }
      .btn-default {
        background-color: #F8F9F9  ;
        border-color: #AAB7B8  ;
        font-size:11px;
      }

      .tdTable{
        padding: 2px !important;
      }

      .well{
        margin-top:1px;
        margin-bottom:1px;
        }

      .table-fixed thead {
        width: 97%;
      }
      .table-fixed tbody {
        height: 230px;
        overflow-y: auto;
        width: 100%;
      }
      .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
        display: block;
      }
      .table-fixed tbody td, .table-fixed thead > tr> th {
        float: left;
        border-bottom-width: 0;
      }
      .well-2 {
        background-color: white;
        border-radius: 4px;
        margin-left: -20px;
        margin-right: -20px;
        margin-top: -5px;
        margin-bottom: -5px;
      }
     </style>
   </head>
   <body>
     <div class="container-fluid" align="center" style="margin-top:20px;">
       <div class="row well" style="width: 1050px; height: 579px; padding-top:0px; padding-bottom:0px;">
         <div class="row well-2" align="left">
           <img src="imagenes/logosendero.jpg" style=" padding-left: 5px; padding-bottom: 5px; padding-top: 5px; width:120px; height:auto;">
         </div>
         <div class="row well">
           <div align="left" style="margin-left:20px;">Datos cliente<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
           <!-- Titular -->
             <div class="row">
               <div class="col-sm-11">
                   <div class="col-sm-2">
                     <div class="col-xs-8" style="margin-left:-30px">
                       <small>&nbsp; Rut </small>
                       <input type="text" name="rutTitular" value="<?php echo $entrada_detalle_reporte['CLNT_NMR_RUT']; ?>" style="width:90px;" class="form-control InputStyle" disabled>
                     </div>
                     <div class="col-xs-3" style="margin-left:20px">
                       <small><br></small>
                       <input type="text" name="dvTitular" value="<?php echo $entrada_detalle_reporte['CLNT_DGT_VERIFICADOR']; ?>" style="width:35px;" class="form-control InputStyle" disabled>
                      </div>
                   </div>
                   <div class="col-sm-3">
                     <small>Nombres</small>
                     <input type="text" name="nombreTitular" value="<?php echo $entrada_detalle_reporte['CLNT_NMB']; ?>" style="width:200px;" class="form-control InputStyle" disabled>
                   </div>
                   <div class="col-sm-3">
                     <small>Apellido Paterno</small>
                     <input type="text" name="apePatTitular" value="<?php echo $entrada_detalle_reporte['CLNT_APL_PATERNO']; ?>" style="width:200px;" class="form-control InputStyle" disabled>
                   </div>
                   <div class="col-sm-3">
                     <small>Apellido Materno</small>
                     <input type="text" name="apeMatTitular" value="<?php echo $entrada_detalle_reporte['CLNT_APL_MATERNO']; ?>" style="width:200px;" class="form-control InputStyle" disabled>
                   </div>
                   <div class="col-sm-1"  style="text-align:left;">
                   <small></small>
                   <!--<button type="button" class="btn btn-default btn-xs" style='width:120px;'>Histórico</button>-->
                 </div>
               </div>
             </div> <!-- Fin Titular -->
             <div class="row">
               <div class="col-sm-11">
                 <div class="col-sm-2">
                 </div>
                 <div class="col-sm-3">
                   <small>Telefonos</small>
                   <input type="text" name="fonos" value="<?php echo $entrada_detalle_reporte['TELEFONOS']; ?>" style="width:200px;" class="form-control InputStyle" disabled>
                 </div>
                 <div class="col-sm-3">
                   <small>Direccion</small>
                   <input type="text" name="fonos" value="<?php echo $entrada_detalle_reporte['DIRECCION_PARTICULAR'] ?>" style="width:200px;" class="form-control InputStyle" disabled>
                 </div>
                 <div class="col-sm-3">
                   <small>Correo</small>
                   <input type="text" name="fonos" value="<?php echo $entrada_detalle_reporte['CLNT_DRC_EMAIL_PAR']; ?>" style="width:200px;" class="form-control InputStyle" disabled>
                 </div>
               </div>
             </div>
         </div>
         <div class="row well" style="height: 350px; overflow-y: scroll;"><!-- Tercera fila -->
           <div align="left" style="margin-left:20px;">Gestion historica<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
               <table class="table table-sm ">
                 <thead>
                   <tr>
                     <th scope="col" style="width:13%">Contrato</th>
                     <th scope="col" style="width:9%;">Fecha asignacion</th>
                     <th scope="col" style="width:9%;">Fecha gestion</th>
                     <th scope="col" style="width:11%">Estado</th>
                     <th scope="col" style="width:9%;">Fecha conf. datos</th>
                     <th scope="col" style="width:9%;">Fecha act. datos</th>
                     <th scope="col" style="width:9%;">Fecha derivacion</th>
                     <th scope="col" style="width:2%">Area derivacion</th>
                     <th scope="col" style="width:9%">Fecha cierre</th>
                     <th scope="col" style="width:1%">Calificacion de servicio</th>
                     <th scope="col" style="width:1%">Ind. entrega contrato</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                      $contrato = $entrada_reportes[0]['CONTRATO']; 
                      $f_asignacion = $entrada_reportes[1]['FECHA_ASIGNACION'];
                      $f_derivacionVentas = $entrada_reportes[0]['DERIVACION_VENTAS'];
                      $f_derivacionLegal = $entrada_reportes[0]['DERIVACION_LEGAL'];
                      $f_derivacionSupervisor = $entrada_reportes[0]['DERIVACION_SUPERVISORES'];

                      foreach($entrada_reportes2 as $report){
                   ?>
                   <tr class="tdTable">
                     <td class="tdTable"><input type="text" name="contrato" value="<?php echo $contrato; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.asg" value="<?php echo $f_asignacion; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.gest" value="<?php echo $report['FECHA_ACTUALIZACION'];  ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="estado" value="<?php echo $report['ESTADO'] ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.conf" value="<?php echo $report['DATOS CONFIRMADOS']    ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.act" value="<?php echo ""; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.derv" value="<?php echo $report[$report['ESTADO']]; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="A.derv" value="<?php echo ""; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.cierre" value="<?php echo  $report['CERRADO'];  ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="calf.serv" value="<?php echo $report['CALIFICACION']; ?>" style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="inf.contr" value="<?php echo $report['IND_ENTREGA_CNTR']; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                   </tr>
                   <?php
                   }
                   ?>
                 </tbody>
               </table>
             </div> <!-- Fin tercera fila -->
             <div class="row" style="margin-top:3px; margin-right:-7px;">
               <div class="form-group" style="text-align:right;">
                 <button type="submit" onclick="window.location='./resumenreporte.php'" class="btn btn-default btn-xl">Volver <i class="glyphicon glyphicon-share-alt"></i></button>
               </div>
             </form>
       </div>
     </div>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   </body>
 </html>

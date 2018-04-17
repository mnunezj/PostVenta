<?php

 require_once('../nusoap/lib/nusoap.php');





  $client = new soapclient('http://192.168.80.73/postventa/resumenreporte.php?wsdl');
  $persona = array('usuario' => 'mnunezj', 'valida' => 'sendero01');

  $entrada_resumen = $client->call('entrada_resumen', array('entrada_resumen' => $persona));
  $entrada_estados = $client->call('entrada_estados', array('entrada_estados' => $persona));




foreach ($entrada_estados as $estado) {
  foreach ($estado as $est) {
  if(isset($_POST[$est])){ //check if form was submitted
    $filtro = $_POST[$est]; //get input
  }
  }
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
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
      .btn {
        background-color: #F8F9F9  ;
        border-color: #AAB7B8  ;
        font-size:11px;
        height: 20px;
        padding: 2px;
        cursor: pointer;
      }
      .btn-default {
        background-color: #F8F9F9  ;
        border-color: #AAB7B8  ;
        font-size:11px;
        width: 70px;
        height: 28px;
      }
      .tdTable{
        padding: 2px !important;
        width: 120px;
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
       <div class="row well" style="width: 1150px; height: 723px; padding-top:0px; padding-bottom:0px;">
         <div class="row well-2" align="left">
           <img src="imagenes/logosendero.jpg" style=" padding-left: 5px; padding-bottom: 5px; padding-top: 5px; width:120px; height:auto;">
         </div>
         <div class="row well">
           <div align="left" style="margin-left:20px;">Filtro<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
           <!-- Titular -->
           <div class="col-sm-6" style="margin-left:50px">
             <form action="resumenreporte.php" method="post">
             <div class="col-sm-4">
               <small>Estado</small>
               <?php
               foreach ($entrada_estados as $estado) {
                 if ($estado == $entrada_estados[0]['TGPV_CDG']) {
                ?>
                <button type="submit" name="<?php echo $estado['TGPV_CDG'] ?>" value="<?php echo $estado['TGPV_CDG'] ?>" style="width:200px" class="btn"><?php echo $estado['TGPV_DSC']; ?></button>
               <?php
             }else{
                ?>
                <button type="submit" name="<?php echo $estado['TGPV_CDG'] ?>" value="<?php echo $estado['TGPV_CDG'] ?>" style="width:200px" class="btn"><?php echo $estado['TGPV_DSC']; ?></button>
              <?php
              }
            }
                 ?>
             </div>
             <!-- contar -->
             <div class="col-sm-2" style="margin-left:50px">
               <small>Cantidad</small>
               <?php
               $k = array();
               for ($i=0; $i < count($entrada_estados) ; $i++) {
                 $meh = array();
                 for ($j=0; $j < count($entrada_resumen) ; $j++) {
                  if ($entrada_estados[$i]['TGPV_DSC'] == $entrada_resumen[$j]['ULT_GESTION']) {
                    array_push($meh, $entrada_resumen[$j]['ULT_GESTION']);
                  }
                 }
                                     array_push($k,$meh);
               }


                 foreach ($k as $estado => $arr) {
                   if ($entrada_estados[$estado]['TGPV_DSC'] == $arr[0]) {
                ?>
               <input type="text" name="estados" value="<?php echo count($arr); ?>" style="width:50px;" class="form-control InputStyle" disabled>
               <?php
             }else {
               ?>
              <input type="text" name="estados" value="<?php echo "0"; ?>" style="width:50px;" class="form-control InputStyle" disabled>
              <?php
             }
            }

                ?>
             </div>
           </form>
         </div>
       </div>
         <div class="row well" style="height: 350px; overflow-y: scroll;"><!-- Tercera fila -->
           <div align="left" style="margin-left:20px;">Gestion<hr style=" margin-top: 0px; margin-bottom: -20px;"> </div>
               <table class="table table-sm ">
                 <thead>
                   <tr>
                     <th scope="col" style="width:139px;">Contrato</th>
                     <th scope="col" style="width:193px;">Rut</th>
                     <th scope="col" style="width:300px;">Nombres</th>
                     <th scope="col" style="width:154px;">Telefonos</th>
                     <th scope="col" style="width:150px;">Fecha asignacion</th>
                     <th scope="col" style="width:350px;">Estado</th>
                     <th scope="col" style="width:150px">Fecha ult. gestion</th>
                     <th scope="col" style="width:150px">Fecha prox. gestion</th>
                   </tr>
                 </thead>

                                    <?php
                     foreach($entrada_resumen as $resumen){
                      foreach ($resumen as $est) {
                        if ($est == $filtro){

                   ?>
                 <tbody>
                 <div class="container">

                 <tr class="tdTable">
                     <td class="tdTable"  onclick="window.location='./detallereporte.php?campana=<?php echo $resumen['CMPN_CDG']; ?>&parque=<?php echo $resumen['PRQS_CDG']; ?>&codigo=<?php echo $resumen['CNTR_CDG_SERIE']; ?>&numero=<?php echo $resumen['CONTRATO']; ?>'"><input type="text" value="<?php echo $resumen['CONTRATO']; ?>" class="form-control InputStyleTable" ></td>
                     <td class="tdTable"><input type="text" name="Rut" value="<?php echo $resumen['RUT']; ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="Nombres" value="<?php echo $resumen['NOMBRE']; ?>" class="form-control InputStyleTable" disabled></td>


                     <td class="tdTable" style="margin-right: -20px;"><select class="form-control InputStyle" style="width: 110px; background-color: #EEEEEE" value="<?php echo $resumen['TELEFONOS']; ?>">
                       <?php
$telefonos = explode('-',$resumen['TELEFONOS']);
                       foreach ($telefonos as $telefono) {
                      ?>
<option selected> <?php echo $telefono; ?></option>

<?php                       }

?>



                     </select></td>


                     <td class="tdTable" style=""><input type="text" name="F.asg" value="<?php echo date("d-m-Y", strtotime($resumen['FCH_ASIGNACION'])); ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="Estado" value="<?php echo $resumen['ULT_GESTION'] ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.ult.gest" value="<?php echo date("d-m-Y", strtotime($resumen['FCH_ULT_GESTION'])); ?>"  style="" class="form-control InputStyleTable" disabled></td>
                     <td class="tdTable"><input type="text" name="F.prox.gest" value="<?php if($resumen['FCH_PROX_GESTION'] != null)
                     echo  date("d-m-Y", strtotime($resumen['FCH_PROX_GESTION'])); else echo "";?>"  style="" class="form-control InputStyleTable" disabled></td>
                   </tr>
                   <?php
                 }
                 }
               }
                   ?>
                 </div>
                 </tbody>
               </table>
             </div> <!-- Fin tercera fila -->
             <div class="row" style="margin-top:5px; margin-right:-7px;">
               <div class="form-group" style="text-align:right;">
                 <button type="submit" onclick="window.location='./index.php'" class="btn btn-default btn-xl">Volver <i class="glyphicon glyphicon-share-alt"></i></button>
               </div>
             </form>
       </div>
       </div>
     </div>
     <!-- Filtro automatico -->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
   </body>
 </html>

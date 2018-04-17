<?php
  require_once('../nusoap/lib/nusoap.php');


  $campana=$_GET['campana'];
  $parque=$_GET['parque'];
  $codigo=$_GET['codigo'];  
  $numero=$_GET['numero'];

  $client = new soapclient('http://192.168.80.73/postventa/validacion.php?wsdl');
  $persona = array('campana' => $campana, 'parque' => $parque, 'codigo' => $codigo, 'numero' => $numero, 'usuario' => 'mnunezj', 'valida' => 'sendero01');
  $entrada_estados = $client->call('entrada_estados', array('entrada_estados' => $persona));
  $entrada_validacion = $client->call('entrada_antecedentes', array('entrada_antecedentes' => $persona));

  //$r = entrada_guardar($persona);
  //print_r($r);





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
<!-- Para el pop up de esta page -->
<!-- <a href="./validacion.php?campana=<?php echo $campana ?>&parque=<?php echo $parque ?>&codigo=<?php echo $codigo ?>&numero=<?php echo $numero ?>" onclick="window.open(this.href, 'validacion','left=200,top=100,width=1110,height=470,toolbar=1,resizable=0'); return false;" type="button" class="btn btn-default btn-xs" style='width:80px; margin-top:5px'>Validacion</a> -->
    <style>
    body{
      background-image: url('imagenes/fondoportal.png');
      background-repeat: no-repeat;
      background-size: cover;
      font-family: verdana, sans-serif;
      font-size: 11px;
      font-style: normal;
      font-variant: normal;
      font-weight: 300px;
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
    	}
    	.btn-default {
    	  background-color: #F8F9F9  ;
    	  border-color: #AAB7B8  ;
    	  font-size:11px;
    	}

      .btn-secondary {
    	  background-color: #F8F9F9  ;
    	  border-color: #AAB7B8  ;
    	  font-size:9px;
        padding: 2px 7px;
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
      .active{
        background-color:rgb(150,191,12);
        border-color: rgb(150,191,12);
        pointer-events:none;
      }
      .nop{
        color: white;
        border-color: rgb(201,80,107);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 2px rgb(201,80,107);
        background-color: rgb(201,80,107);
      }
        .nop:hover{
        pointer-events:none;
      }
      .noconfirmado{
        border-color: rgb(201,80,107);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 2px rgb(201,80,107);
      }


    </style>
  </head>
  <body>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
$confirm = 'form-control InputStyle';
if (isset($_POST['optionsi'])) {
  echo "WAAAASAAAAP";
    $confirm = 'form-control InputStyle confirmado';
}
// if (isset()) {
//
// }
$informacion= array(
'Datos Cliente' => array(
'Contrato' => $entrada_validacion['CONTRATO'],
'Rut' => $entrada_validacion['RUT_TITULAR'],
'Nombre' => $entrada_validacion['NOMBRE'],
'Fecha de nacimiento' => $entrada_validacion['FECHA_NACIMIENTO'],
'Dirección' => $entrada_validacion['DIRECCION'],
'Comuna' => $entrada_validacion['COMUNA'],
'Region' => $entrada_validacion['REGION'],
'Fono fijo' => $entrada_validacion['TELEFONO_PARTICULAR'],
'Fono celular' => $entrada_validacion['TELEFONO_MOVIL'],
'Correo electronico' => $entrada_validacion['CORREO_ELECTRONICO']),
'Conseguir siguientes datos' => array(
'Correo laboral' => '',
'Fono adicional celular' => '',
'Fono adicional fijo' => '',
'Fono adicional laboral' => ''),
'Campos informativos producto' => array(
'Nombre Parque' => $entrada_validacion['PARQUE_FISICO'],
'Ubicación' => $entrada_validacion['PARQUE_TEMATICO'],
'Producto' => $entrada_validacion['PRODUCTO'],
'Fracción Jardin' => $entrada_validacion['FRACCION']),
'Campos informativos financiamiento' => array(
'Precio' => $entrada_validacion['PRECIO_PRODUCTO'],
'Pie' => $entrada_validacion['PIE'],
'Saldo financiar' => $entrada_validacion['SALDO_A_FINANCIAR'],
'Numero cuotas' => $entrada_validacion['CUOTAS'],
'Valor cuota' => $entrada_validacion['CUOTAS'],
'Dia pago' => $entrada_validacion['DIA_DE_PAGO'],
'Fecha primer vencimiento' => $entrada_validacion['FECHA_PRIMER_VENCIMIENTO'],
'PAC-PAT' => $entrada_validacion['PAGO_AUTOMATICO_PAC_PAT'],
'Tipo mantención' => $entrada_validacion['TIPO_MANTENCION'],
'Monto mantención UF' => $entrada_validacion['VALOR_MANTENCION'])
 );
 $rut = explode("-", $informacion['Datos Cliente']['Rut']);
 ?>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <body>
      <div class="container-fluid" align='center'>
        <div class="row well" style=" margin-top:10px; margin-bottom: 10px; width: 790px; height: 1135px;">
          <div class="row well-2" align="left" style="margin-top: -20px">
            <img src="imagenes/logosendero.jpg" style=" padding-left: 5px; padding-bottom: 5px; padding-top: 5px; width:120px; height:auto;">
          </div>
          <div class="row well">
            <?php
              $i = 1;
              $numeroConCeros = str_pad($i, 3, "0", STR_PAD_LEFT);

      
            
foreach ($informacion as $key => $arr) {
  if ($key == 'Datos Cliente') {
    ?>
    <div align="left" style="margin-left:20px;">
      <div class="col-md-10">
        <p align="left"><?php echo $key; ?></p>
      </div>
      <div class="col-md-2">
        <p align="left" style="margin-left:0px">¿Correcto?</p>
      </div>
    </div>
    <hr style=" margin-top: 0px; margin-bottom: 0px;">
    <?php
foreach ($arr as $key2 => $value) {

  $width = '320px';
  if ($key2 == 'Contrato') {
    $width = '120px';
  }
  if ($key2 == 'Rut') {

?>
<div class="row" style="margin-left:30px">
  <label align="left" class="col-sm-3 control-label" for="textinput"><?php echo $key2 ?></label>
  <div class="col-sm-8">
      <div class="col-sm-4">
        <div class="col-xs-8" style="margin-left:-30px">
          <input type="text" class="<?php echo $confirm;?>" name="validar" id="<?php echo $i; ?>" value="<?php echo $rut[0]; ?>" style="width:90px;"  disabled>
        </div>
        <div class="col-xs-1" style="margin-left: 20px">
          <p>-</p>
         </div>
        <div class="col-xs-3" style="margin-left:-13px">
          <input type="text" class="<?php echo $confirm;?>" name="validar" id="1000" value="<?php echo $rut[1]; ?>" style="width:35px;" disabled>
         </div>
      </div>
  </div>
  <div class="col-sm-3" align = "center" style="margin-left:-122px; padding-bottom:5px">
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
 <button type="button" class="btn btn-secondary si active" onload="AllFunction('<?php echo $i.'_S'; ?>')" id="<?php echo $i.'_S'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_S'; ?>')">Si</button>
           <font class='asd'> <button type="button" class="btn btn-secondary no" id="<?php echo $i.'_N'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_N'; ?>')" >No</button></font>
  
  </div>
</div>
</div>
<?php
$i++; 
}else{
  ?>
  <div class="row" style="margin-left:30px"><!---->
    <label align="left" class="col-sm-3 control-label" style="margin-left:0px" for="textinput"><?php echo $key2; ?></label>
    <div class="col-sm-6">
        <div class="col-sm-3">
          <div class="col-xs-8" style="margin-left:-30px">
            <input type="text" class="<?php echo $confirm;?>" name="validar" id="<?php echo $i; ?>"  value="<?php echo $value; ?>" style="width:<?php echo $width; ?>;"  disabled>
          </div>
        </div>
    </div>
    <div class="col-sm-3"align = "center" style="margin-left: 0px; padding-bottom:5px;">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-secondary si active" id="<?php echo $i.'_S'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_S'; ?>')">Si</button>
            <font class='asd'><button type="button" class="btn btn-secondary no" id="<?php echo $i.'_N'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_N'; ?>')">No</button></font>
  
    </div>
  </div>
</div>
<?php
$i++;

  }
 }
}else{
  ?>
  <div align="left" style="margin-left:35px; margin-top:7px;"><?php echo $key; ?><hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
  <?php
    foreach ($arr as $key2 => $value) {
      ?>
      <div class="row" style="margin-left:30px">
        <label align="left" class="col-sm-3 control-label" for="textinput"><?php echo $key2; ?></label>
        <div class="col-sm-6">
            <div class="col-sm-3">
              <div class="col-xs-8" style="margin-left:-30px">
                <input type="text" class="<?php echo $confirm;?>" name="validar" id="<?php echo $i; ?>"  value="<?php echo $value; ?>" style="width:320px;" disabled>
              </div>
            </div>
        </div>
        <div class="col-sm-3"align = "center" style="margin-left: 0px; padding-bottom:5px;">
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <button type="button" class="btn btn-secondary si active" id="<?php echo $i.'_S'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_S'; ?>')">Si</button>
            <font class='asd'><button type="button" class="btn btn-secondary no" id="<?php echo $i.'_N'; ?>" name="<?php echo $i; ?>" value="<?php echo $value; ?>" onclick="AllFunction('<?php echo $i.'_N'; ?>')">No</button></font>
  
        </div>
      </div>
    </div>
      <?php
      $i++;
    }
  }
}
             ?>
        <div align="left" style="margin-left:35px; margin-top:7px;">Nueva Gestión<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
        <hr style=" margin-top: 2px; margin-bottom: 2px;">
        <br>
        <div align="left" class="row" style="margin-left:30px; padding-bottom:5px;">
        <div class="col-sm-10">
        <label class="control-label" for="textinput">¿Se le entrego el contrato? (Si es no, confirmar email para enviarlo)</label>
        </div>
        <div class="col-sm-2" style="margin-left:-30px">
        <select type="text" name="Clfserv" id="entregaCntr" value="" style="" class="form-control InputStyle" required>
          <option>Elija...</option>
        <option value="S">Si</option>
        <option value="N">No</option>
        </select>
        </div>
        </div>
        <div align="left" class="row" style="margin-left:30px">
        <div class="col-sm-10">
        <label align="left" class="control-label" for="textinput">¿Como califica el servicio y atención del ejecutivo? (Nota 1-7, 1: Muy malo, 7: Muy bueno)</label>
        </div>
        <div class="col-sm-2" style="margin-left:-30px">
        <select type="text" name="Clfserv" id="calificacion" value="" style="" class="form-control InputStyle" required>
          <option>Elija...</option>
        <?php
        for ($i=1; $i < 8; $i++) {?>
            <option value="<?php echo $i;?>"><?php echo $i;?></option>
        <?php
          }
        ?>
        </select>
        </div>
        </div>
        <br>
        <hr style=" margin-top: 2px; margin-bottom: 2px;">
         <!--Inicio Grabar gestion -->
            <input type="hidden" name="action" value="guardar">
            <div align="left" style="margin-left:35px; margin-top:7px;">Nueva Gestión<hr style=" margin-top: 0px; margin-bottom: 0px;"> </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <textarea class="form-control table" name="nueva_gestion" rows="6" id="nueva_gestion" style="resize:none;"></textarea>
                </div>
                </div>
                <div class="col-sm-5">
                  <div class="row" align='left'>
                    <div class="col-sm-11">
                      <small>Tipo Estado*</small>
                      <select  name="tipo_estado" id="tipo_estado" style="" class="form-control InputStyle" required>
                        <option value='asd'>Elija...</option>
                        <?php
                          foreach($entrada_estados as $estado){ ?>
                            <option value="<?php echo $estado['TGPV_CDG'];?>"><?php echo $estado['TGPV_DSC'];?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <small>Próxima Gestión*</small>
                      <input type="date" name="proxima_gestion" id="proxima_gestion" class="form-control InputStyle" value="<?php echo date("Y-m-d");?>" required>
                    </div>
                    <div class="col-sm-4" style="padding-left:0px;">
                      <small>Hora Prox.Gestión</small>
                      <input type="time" name="hora_prox_gestion" id="hora_prox_gestion" value="" class="form-control InputStyle">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group" style="text-align:right;">
                    <br><br><br><br>
                    <button type="submit" id="guardarNo" class="btn btn-default btn-xl">Grabar <i class="glyphicon glyphicon-floppy-disk"></i></button>
                    <button type="submit" id="guardarSi" class="btn btn-default btn-xl hidden">Cargando.. <i class="glyphicon glyphicon-refresh"></i></button>
                    
                  </div>
                </div>
  
      
          <!-- Fin Grabar gestion -->
         </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">

  
salida = []
      $(document).ready(function(e) {  
           
           $('.active').click();
var QueryString = function () {
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
  return query_string;
}();


salida.push(QueryString.campana);//0
salida.push(QueryString.parque);//1
salida.push(QueryString.codigo);//2
salida.push(QueryString.numero);//3 



           });






    result = [];


function AllFunction(idp){
        //valor = $('#'+id[0]+id[1]).val();

var id = idp.split('_');

value = $('#'+id[0]+'_'+id[1]).attr('value');
if(id[1] == 'N'){
 
  // result["'"+id[0]+"'"] = value;
   result["'"+id[0]+"'"] = value+'_N';
  $('#'+id[0]).addClass('noconfirmado');
  if (id[0] == 2) { 
   $('#1000').addClass('noconfirmado');
}
  $('#'+id[0]+'_S').removeClass('active');
$('#'+id[0]+'_N').addClass('active');

}else if(id[1] == 'S'){
$('#'+id[0]).removeClass('noconfirmado');
  if (id[0] == 2) {  $('#1000').removeClass('noconfirmado');
}
//result["'"+id[0]+"'"] = value;
result["'"+id[0]+"'"] = value+'_S';  
$('#'+id[0]+'_S').addClass('active');
  $('#'+id[0]+'_N').removeClass('active');
}
   console.log(result);
  } 


$('#guardarNo').click(function(e){
              e.preventDefault();

tipo_estado = $('#tipo_estado').val();
proxima_gestion = $('#proxima_gestion').val();
hora_prox_gestion = $('#hora_prox_gestion').val();
nueva_gestion = $('#nueva_gestion').val();
entregaCntr = $('#entregaCntr').val();
calificacion = $('#calificacion').val();
campana = salida[0];
parque = salida[1];
codigo = salida[2];
numero = salida[3];
console.log(tipo_estado+' '+proxima_gestion+' '+nueva_gestion+' '+entregaCntr+' '+calificacion+' '+campana+' '+numero+' '+parque+' '+codigo);

if (tipo_estado != "asd") {
$('#guardarNo').hide();
$('#guardarSi').removeClass('hidden');
console.log(result);
}


//console.log(tipo_estado, proxima_gestion, hora_prox_gestion, nueva_gestion);
/*
//foreach para recorrer el objeto creado.
Object.keys(result).forEach(function (key) {
    console.log(key, result[key])

    var cadena = key,
    separador = "'", // comilla simple
    limite = 2,
    arregloDeSubCadenas = cadena.split(separador, limite);//elimina las cominas simples

console.log(arregloDeSubCadenas[1]);

indice = arregloDeSubCadenas[1];//le damos el valor que se creo.
          
//valor = $(this).val();
//console.log(valor);

  var datos = new FormData();
  datos.append("valor", result[key]); //valor del indice
  datos.append("indice", indice); //solo el indice
   */
var datos = JSON.stringify(Object.entries(result));
    $.ajax({
            url:"http://192.168.80.73/postventa/actualizaciones.php",
            type: "POST",
            data: {array : datos, tipo_estado : tipo_estado, proxima_gestion : proxima_gestion, hora_prox_gestion : hora_prox_gestion, nueva_gestion : nueva_gestion, entregaCntr : entregaCntr, calificacion : calificacion, campana : campana, parque : parque, codigo : codigo, numero : numero},
            cache: false,
            success: function(resultado) {
              //$('#mostrar').html('<h1>'+resultado+'</h1>');
              console.log(resultado);
              
            },
        });  

/*
    $.ajax({
            url:"http://192.168.80.73/postventa/SendMails/Sendmail.php",
            type: "POST",
            data: {array : datos},
            cache: false,
            success: function(resultado) {
              //$('#mostrar').html('<h1>'+resultado+'</h1>');
              console.log(resultado);
              
            },
        }); 
    */

    }); 





 

   </script>
  </body>
</html>

<?php

require_once('SendMails/PHPMailer/src/PHPMailer.php');
require_once('SendMails/PHPMailer/src/SMTP.php');

include('adodb5');


/*
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "webservices";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
	echo "Conectado";
}


 //$datos =  json_decode(stripcslashes($_POST['array']));
  //echo $datos[0];

if($_POST['indice']){

 	//$sql = "insert into arrays(indice, valor) values('".$_POST['indice']."','".$_POST['valor']."')";

 	//$conn->query($sql);
    // $conn->close();

 echo "el resultado es: ".$_POST['valor']."</br>".$_POST['indice'];

}
*/

/*
$datos = json_decode($_POST['array']);
$array = [];
foreach ($datos as $key => $value) {
	$val = explode("'",$value[0]);
	$array[$val[1]] = $value[1];
}
foreach ($array as $key => $value) {
	echo "Key:".$key."  Valor:".$value;
}
echo count($array);
echo "llega a actualizaciones:  ".$_POST['tipo_estado'], $_POST['proxima_gestion'],$_POST['hora_prox_gestion'],$_POST['nueva_gestion'],$_POST['entregaCntr'], $_POST['calificacion'];

*/

//require_once('SendMails/PHPMailer/src/PHPMailer.php');
//require_once('SendMails/PHPMailer/src/SMTP.php');
     
/*
echo $_POST['tipo_estado'];
echo '</br>';
echo $_POST['proxima_gestion'];
echo '</br>';
echo $_POST['hora_prox_gestion'];
echo '</br>';
echo $_POST['nueva_gestion'];
echo '</br>';
echo $_POST['entregaCntr'];
echo '</br>';
echo $_POST['calificacion'];
echo '</br>';
echo $_POST['codigo'];
*/


$contrato = array('campana' => $_POST['campana'], 'parque' => $_POST['parque'], 'codigo' => $_POST['codigo'], 'numero' => $_POST['numero']);


 $proxGestion = explode('-', $_POST['proxima_gestion']);
 $hora=$auxHora[0];
 $minuto=$auxHora[1];
 $dia=$proxGestion[2];
 $mes=$proxGestion[1];
 $ano=$proxGestion[0];

 $fecha = date('d-M-Y', mktime($hora,$minuto,'0',$mes,$dia,$ano));
 $calificacion = $_POST['calificacion'];
 $CalificacionFloat = floatval($calificacion);

$gestion = array('campana' => $_POST['campana'], 'parque' => $_POST['parque'], 'codigo' => $_POST['codigo'], 'numero' => $_POST['numero'], 'tipo_estado' => $_POST['tipo_estado'], 'proxima_gestion' => $fecha, 'calificacion' => $CalificacionFloat, 'entrega_contrato' => $_POST['entregaCntr'], 'nueva_gestion' => $_POST['nueva_gestion']);


echo "datos : ".$gestion['campana']."||".$gestion['parque']."||".$gestion['codigo']."||".$gestion['numero']."||".$gestion['tipo_estado']."||".$gestion['proxima_gestion']."||".$gestion['calificacion']."||".$gestion['entrega_contrato']."||".$gestion['nueva_gestion']."||";




$datos = json_decode($_POST['array']);


$array = [];

foreach ($datos as $key => $value) {
$val = explode("'",$value[0]);
$array[$val[1]] = $value[1];

}


function guardar_gestion($gestion){
        include('WAPAFR98.php');
        $campana = $gestion['campana'];
        $parque = $gestion['parque'];
        $codigo = $gestion['codigo'];
        $numero = $gestion['numero'];
        $estado = $gestion['tipo_estado'];
        $nueva_gestion = $gestion['nueva_gestion'];
        $proxima_gestion = $gestion['proxima_gestion'];
        $calificacion = $gestion['calificacion'];
        $entrega_contrato = $gestion['entrega_contrato'];

    try{


        $conn = oci_pconnect('mnunezj','sendero01','192.168.80.65/DESASC');
        //oci_set_client_identifier($conn, 'admin');

        $statement = oci_parse($conn, 'begin :result := adpvnt.p_gestion_postventa.graba_gestion(:pccmpn, :pcprqs, :pcserie, :pccntr, :pcgestion, :pcobserva, :pdfchproxges, :pnclasifica, :pcentrega); end;');
          
        oci_bind_by_name($statement, ":pccmpn", $campana);
        oci_bind_by_name($statement, ":pcprqs", $parque);
        oci_bind_by_name($statement, ":pcserie", $codigo);
        oci_bind_by_name($statement, ":pccntr", $numero);
        oci_bind_by_name($statement, ":pcgestion", $estado);
        oci_bind_by_name($statement, ":pcobserva", $nueva_gestion);
        oci_bind_by_name($statement, ":pdfchproxges", $proxima_gestion);
        oci_bind_by_name($statement, ":pnclasifica", $calificacion);
        oci_bind_by_name($statement, ":pcentrega", $entrega_contrato);

        oci_bind_by_name($statement, ":result", $res, 100);
        oci_execute($statement, OCI_DEFAULT);
        oci_commit($conn);

    }
    catch (exception $e){ 
    }
      

    oci_free_statement($statement);
    oci_close($conn);
    return $res;

}



$rp = guardar_gestion($gestion);

echo $rp;





function entrada_guardar($contrato) {
	//include('WAPAFR98.php');
	try{
		$conn = oci_pconnect('mnunezj', 'sendero01','192.168.80.65/DESASC');
        $statement = oci_parse($conn, 'begin :result := adpvnt.p_gestion_postventa.crea_cabecera(:pccmpn, :pcprqs, :pcserie, :pccntr); end;');

		oci_bind_by_name($statement, ":pccmpn", $contrato['campana']);
		oci_bind_by_name($statement, ":pcprqs", $contrato['parque']);
		oci_bind_by_name($statement, ":pcserie", $contrato['codigo']);
		oci_bind_by_name($statement, ":pccntr", $contrato['numero']);


		oci_bind_by_name($statement, ":result", $res, 100);

		oci_execute($statement);
	}
	catch (exception $e){ 

	}
	oci_free_statement($statement);
	oci_close($conn);
	return $res;
}

$r = entrada_guardar($contrato);




function guardar($numeroConCeros, $value, $r){

	try{
		$conn = oci_pconnect('mnunezj', 'sendero01','192.168.80.65/DESASC');

    $statement = oci_parse($conn, 'begin  :result := adpvnt.p_gestion_postventa.Ingresa_respuesta(:pncabecera,:pcpregunta,:pcrespuesta); end;');
 
		oci_bind_by_name($statement, ":pncabecera", $r);
		oci_bind_by_name($statement, ":pcpregunta", $numeroConCeros);
		oci_bind_by_name($statement, ":pcrespuesta", $value);

		oci_bind_by_name($statement, ":result", $res, 100);

		oci_execute($statement);
	}
	catch (exception $e){ 

	}
	
	oci_free_statement($statement);
	oci_close($conn);
	return $res;

}




/*
foreach ($array as $key => $value) {
	$numeroConCeros = str_pad($key, 3, "0", STR_PAD_LEFT);
    $cadena_valor = substr($value, 0, -2);
    $cadena_ult = substr($value, -2);
    if($cadena_ult == "_N")
    {
      $cadena_ult = "N";
    }
    elseif($cadena_ult == "_S"){
        $cadena_ult ="S";
}
$respuesta = guardar($numeroConCeros, $cadena_ult, $r);
echo $respuesta;

}

*/


/*
foreach ($datos as $key => $value) {
  $val = explode("'",$value[0]);
  $array[$val[1]] = $value[1];
}
$data1 = '';
$data2 = '';
$item1 = 0;
$item2 = 0;

foreach ($array as $key => $value) {
    $numeroConCeros = str_pad($key, 3, "0", STR_PAD_LEFT);
    $cadena_valor = substr($value, 0, -2);
    $cadena_ult = substr($value, -2);
    if($cadena_ult == "_N")
    {
      $cadena_ult = "N";
    }
    elseif($cadena_ult == "_S"){
        $cadena_ult ="S";
}

$respuesta = guardar($numeroConCeros, $cadena_ult, $r);

if($cadena_ult == "N")
{



  if($key >= 1 && $key <= 10 || $key >= 9 && $key <= 16){
    $item1 = 1;
    $data1.= "Item ".$key.':  '.$cadena_valor;
    $data1.= "<br>";
 

   }
    elseif($key >= 17 && $key <= 28){
    $data2 .= "Item ".$key.':  '.$cadena_valor;
    $data2.= "<br>";
   
    $item2 = 2;
   }

}

}

if($item1 == 1){

$message = '<p>The following request was sent from: </p>';
$message .= '<p>Resultados - Area Ventas y Supervisor : <br />      '.$data1.'</p><br />';


$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail ->IsSMTP(); // enable SMTP
$mail -> SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail -> SMTPAuth = true; // authentication enabled
//$mail -> SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail -> Host = '192.168.80.44';
$mail -> Port = 25; // or 587
$mail -> Username = 'Postvta';
$mail -> Password = 'Sendero01';
$mail -> SetFrom('Postvta@sendero.cl','No-responder@sendero.cl');
$mail -> Subject = 'Test';
$mail -> Body = $message;
$mail -> IsHTML(true);
$mail -> AddAddress('matlillo@strategicati.cl');

     if(!$mail->Send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Message has been sent';
     }

}
elseif($item2 == 2){


$message = '<p>The following request was sent from: </p><br />';
$message .= '<p>Resultados - Area Legal : <br />'.$data2.'</p><br />';


$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail ->IsSMTP(); // enable SMTP
$mail -> SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail -> SMTPAuth = true; // authentication enabled
//$mail -> SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail -> Host = '192.168.80.44';
$mail -> Port = 25; // or 587
$mail -> Username = 'Postvta';
$mail -> Password = 'Sendero01';
$mail -> SetFrom('Postvta@sendero.cl','No-responder@sendero.cl');
$mail -> Subject = 'Test';
$mail -> Body = $message;
$mail -> IsHTML(true);
$mail -> AddAddress('mnunez@strategicati.cl');
$mail -> AddAddress('matlillo@strategicati.cl');
     if(!$mail->Send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Message has been sent';
     }

}

if($item1 == 1 && $item2 ==2){

	if($item1 == 1){ 


$message = '<p>The following request was sent from: </p><br />';
$message .= '<p>Resultados - Area Ventas y Supervisor: <br /> '.$data1.'</p><br />';




$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail ->IsSMTP(); // enable SMTP
$mail -> SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail -> SMTPAuth = true; // authentication enabled
//$mail -> SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail -> Host = '192.168.80.44';
$mail -> Port = 25; // or 587
$mail -> Username = 'Postvta';
$mail -> Password = 'Sendero01';
$mail -> SetFrom('Postvta@sendero.cl','No-responder@sendero.cl');
$mail -> Subject = 'Test';
$mail -> Body = $message;
$mail -> IsHTML(true);
$mail -> AddAddress('matlillo@strategicati.cl');
     if(!$mail->Send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Message has been sent';
     }

 }
 
 if($item2 == 2){


$message = '<p>The following request was sent from: </p><br />';
$message .= '<p>Resultados - Area Legal : <br /> '.$data2.'</p><br />';




$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail ->IsSMTP(); // enable SMTP
$mail -> SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail -> SMTPAuth = true; // authentication enabled
//$mail -> SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail -> Host = '192.168.80.44';
$mail -> Port = 25; // or 587
$mail -> Username = 'Postvta';
$mail -> Password = 'Sendero01';
$mail -> SetFrom('Postvta@sendero.cl','No-responder@sendero.cl');
$mail -> Subject = 'Test';
$mail -> Body = $message;
$mail -> IsHTML(true);
$mail -> AddAddress('mnunez@strategicati.cl');
     if(!$mail->Send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
     } else {
        echo 'Message has been sent';
     }

 }

}

*/ 








?>
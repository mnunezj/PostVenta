<?php

require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

$datos = json_decode($_POST['array']);
$array = [];
foreach ($datos as $key => $value) {
  $val = explode("'",$value[0]);
  $array[$val[1]] = $value[1];
}
foreach ($array as $key => $value) {
  echo "Key:".$key."  Valor:".$value;
}

$data = '';
foreach ($array as $key=>$value){
    $data .= $key.'-------'.$value;
    $data.= "<br>";
}
$message = '<p>The following request was sent from: </p>';
$message .= '<p>Resultados: '.$data.'</p><br />';



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
  
?>

<?php
require_once('nusoap/lib/nusoap.php');


$server = new soap_server();
$server->configureWSDL('Servicio_SSCM', 'urn:Servicio_SSCM');

//......................................................................................         

$server->wsdl->addComplexType(
	'entrada_antecedentes',
	'complexType',
	'struct',
	'all',
	'',
	array('campana' => array('name' => 'campana'   , 'type' => 'xsd:string'),
		  'parque' => array('name' => 'parque', 'type' => 'xsd:string'),
		  'codigo' => array('name' => 'codigo', 'type' => 'xsd:string'),
		  'numero' => array('name' => 'numero', 'type' => 'xsd:string'),
		  'usuario'   => array('name' => 'usuario' , 'type' => 'xsd:string'),
		  'valida'    => array('name' => 'valida' , 'type' => 'xsd:string')
	)
);      

$server->wsdl->addComplexType(
	'salida_antecedentes',
	'complexType',
	'struct',
	'all',
	'',
	array(
	    'CONTRATO' => array('name' => 'CONTRATO', 'type' => 'xsd:string'),
		'RUT_TITULAR' => array('name' => 'RUT_TITULAR', 'type' => 'xsd:string'),
		'NOMBRE' => array('name' => 'NOMBRE', 'type' => 'xsd:string'),
		'FECHA_NACIMIENTO' => array('name' => 'FECHA_NACIMIENTO', 'type' => 'xsd:string'),
		'DIRECCION' => array('name' => 'DIRECCION', 'type' => 'xsd:string'),
		'COMUNA' => array('name' => 'COMUNA', 'type' => 'xsd:string'),
		'REGION' => array('name' => 'REGION', 'type' => 'xsd:string'),
		'TELEFONO_PARTICULAR' => array('name' => 'TELEFONO_PARTICULAR', 'type' => 'xsd:string'),
		'TELEFONO_MOVIL' => array('name' => 'TELEFONO_MOVIL', 'type' => 'xsd:string'),
		'CORREO_ELECTRONICO' => array('name' => 'CORREO_ELECTRONICO', 'type' => 'xsd:string'),
		'PARQUE_FISICO' => array('name' => 'PARQUE_FISICO', 'type' => 'xsd:string'),
		'PARQUE_TEMATICO' => array('name' => 'PARQUE_TEMATICO', 'type' => 'xsd:string'),
		'PRODUCTO' => array('name' => 'PRODUCTO', 'type' => 'xsd:string'),
		'FRACCION' => array('name' => 'FRACCION', 'type' => 'xsd:string'),
		'PRECIO_PRODUCTO' => array('name' => 'PRECIO_PRODUCTO', 'type' => 'xsd:string'),
		'PIE' => array('name' => 'PIE', 'type' => 'xsd:string'),
		'RECONOCIMIENTO_CAPITAL' => array('name' => 'RECONOCIMIENTO_CAPITAL', 'type' => 'xsd:string'),
		'DESCUENTO' => array('name' => 'DESCUENTO', 'type' => 'xsd:string'),
		'SALDO_A_FINANCIAR' => array('name' => 'SALDO_A_FINANCIAR', 'type' => 'xsd:string'),
		'CUOTAS' => array('name' => 'CUOTAS', 'type' => 'xsd:string'),
		'VALOR_CUOTA' => array('name' => 'VALOR_CUOTA', 'type' => 'xsd:string'),
		'DIA_DE_PAGO' => array('name' => 'DIA_DE_PAGO', 'type' => 'xsd:string'),
		'FECHA_PRIMER_VENCIMIENTO' => array('name' => 'FECHA_PRIMER_VENCIMIENTO', 'type' => 'xsd:string'),
		'PAGO_AUTOMATICO_PAC_PAT' => array('name' => 'PAGO_AUTOMATICO_PAC_PAT', 'type' => 'xsd:string'),
		'TIPO_MANTENCION' => array('name' => 'TIPO_MANTENCION', 'type' => 'xsd:string'),
		'VALOR_MANTENCION' => array('name' => 'VALOR_MANTENCION', 'type' => 'xsd:string')

	)
);

$server->register('entrada_antecedentes',                              	// method name
	array('entrada_antecedentes' => 'tns:entrada_antecedentes'),         	// input parameters
	array('return' => 'tns:salida_antecedentes'), 						// output parameters
	'urn:entrada_antecedentes',                							// namespace
	'urn:entrada_antecedentes',          								// soapaction
	'rpc',                        									// style
	'encoded',                    									// use
	'Retorna datos de contrato dado un contrato cualquiera'    		// documentation
);

function entrada_antecedentes($datos_contrato) {
	$user = $datos_contrato['usuario'];
	$pass= $datos_contrato['valida'];

	$result=array();
	//include('WAPAFR98.php');
	try{
	
$sql1 = "select * from table(p_gspv.Datos_contrato('".$datos_contrato['campana']."','".$datos_contrato['parque']."','".$datos_contrato['codigo']."','".$datos_contrato['numero']."'))";
		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid1 = oci_parse($conn, $sql1);
		$r1 = oci_execute($stid1);

		while ($row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)){
			
			$result['CONTRATO'] = $row1['CONTRATO'];
			$result['RUT_TITULAR'] = $row1['RUT_TITULAR'];
			$result['NOMBRE'] = $row1['NOMBRE'];
			$result['FECHA_NACIMIENTO'] = $row1['FECHA_NACIMIENTO'];
			$result['DIRECCION'] = $row1['DIRECCION'];
			$result['COMUNA'] = $row1['COMUNA'];
			$result['REGION'] = $row1['REGION'];
			$result['TELEFONO_PARTICULAR'] = $row1['TELEFONO_PARTICULAR'];
			$result['TELEFONO_MOVIL'] = $row1['TELEFONO_MOVIL'];
			$result['CORREO_ELECTRONICO'] = $row1['CORREO_ELECTRONICO'];
			$result['PARQUE_FISICO'] = $row1['PARQUE_FISICO'];
			$result['PARQUE_TEMATICO'] = $row1['PARQUE_TEMATICO'];
			$result['PRODUCTO'] = $row1['PRODUCTO'];
			$result['FRACCION'] = $row1['FRACCION'];
			$result['PRECIO_PRODUCTO'] = $row1['PRECIO_PRODUCTO'];
			$result['PIE'] = $row1['PIE'];
			$result['RECONOCIMIENTO_CAPITAL'] = $row1['RECONOCIMIENTO_CAPITAL'];
			$result['DESCUENTO'] = $row1['DESCUENTO'];
			$result['SALDO_A_FINANCIAR'] = $row1['SALDO_A_FINANCIAR'];
			$result['CUOTAS'] = $row1['CUOTAS'];
			$result['VALOR_CUOTA'] = $row1['VALOR_CUOTA'];
			$result['DIA_DE_PAGO'] = $row1['DIA_DE_PAGO'];
			$result['FECHA_PRIMER_VENCIMIENTO'] = $row1['FECHA_PRIMER_VENCIMIENTO'];
			$result['PAGO_AUTOMATICO_PAC_PAT'] = $row1['PAGO_AUTOMATICO_PAC_PAT'];
			$result['TIPO_MANTENCION'] = $row1['TIPO_MANTENCION'];
			$result['VALOR_MANTENCION'] = $row1['VALOR_MANTENCION'];

			
		}

		oci_free_statement($stid1);


	}
	catch (exception $e){ 

	}
	oci_close($conn);
	return $result;
}


$server->wsdl->addComplexType('notaryConnectionDataEst','complexType','struct','all','',
        array(
                'id' => array('name'=>'id','type'=>'xsd:int'),
                'name' => array('name'=>'name','type'=>'xsd:string')
        )
);


// Complex Array ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionArrayEst','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionDataEst[]'
            )
        )
);

// This is where I register my method and use the notaryConnectionArray
$server->register("entrada_estados",
                array('token' => 'xsd:string'),
                array('notary_array' => 'tns:notaryConnectionArrayEst'),
                'urn:entrada_estados',
                'urn:entrada_estados',
                'rpc',
                'encoded',
                'Use this service to list notaries connected to the signed-in title company.');

function entrada_estados($datos_contrato){

	$user = $datos_contrato['usuario'];
	$pass= $datos_contrato['valida'];
	$salida=array();
	//include('WAPAFR98.php');
	try{
	    $sql1 = "select * from tgpv";
		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid1 = oci_parse($conn, $sql1);
		$r1 = oci_execute($stid1);

		while ($row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)){
			$result = array();
			
			$result['TGPV_CDG'] = $row1['TGPV_CDG'];
			$result['TGPV_DSC'] = $row1['TGPV_DSC'];

			array_push($salida, $result);
			
		}
	}

	
	catch (exception $e){ 

	}

	oci_free_statement($stid1);
	oci_close($conn);
	return $salida;
}
		


$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));

 ?>
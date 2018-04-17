<?php 
function entrada_antecedentes($datos_contrato) {
	
	$result=array();
	//include('WAPAFR98.php');
	try{
	
	 	$sql1 = "select * from table(p_gspv.Datos_contrato('".$datos_contrato['campana']."','".$datos_contrato['parque']."','".$datos_contrato['codigo']."','".$datos_contrato['numero']."'))";
		$conn = oci_pconnect('mnunezj','sendero01','192.168.80.65/DESASC');
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
         print_r($e);
	}
	oci_close($conn);


return $result;
}


ini_set('display_errors', 1);

$persona = array('campana' => '01', 'parque' => '70', 'codigo' => 'NF', 'numero' => '0001126138');
$r = entrada_antecedentes($persona);
print_r($r);
?>




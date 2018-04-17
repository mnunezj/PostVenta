<?php
require_once('nusoap/lib/nusoap.php');


$server = new soap_server();
$server->configureWSDL('Servicio_SSCM', 'urn:Servicio_SSCM');

//......................................................................................         

//......................................................................................         

// Complex Array Keys and Types +++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionDataInhm','complexType','struct','all','',
        array(
                'id' => array('name'=>'id','type'=>'xsd:int'),
                'name' => array('name'=>'name','type'=>'xsd:string')
        )
);


// Complex Array ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionArrayInhm','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionDataInhm[]'
            )
        )
);

// This is where I register my method and use the notaryConnectionArray
$server->register("entrada_resumen",
                array('token' => 'xsd:string'),
                array('notary_array' => 'tns:notaryConnectionArrayInhm'),
                'urn:entrada_resumen',
                'urn:entrada_resumen',
                'rpc',
                'encoded',
                'Use this service to list notaries connected to the signed-in title company.');


function entrada_resumen($datos_contrato) {
	$user = $datos_contrato['usuario'];
	$pass= $datos_contrato['valida'];


try{
	    $sql = "select aspv.cmpn_cdg, aspv.prqs_cdg, aspv.cntr_cdg_serie, aspv.cntr_nmr contrato,p_clnt.Rut_Completo_Formateado(p_cntr.Titular_Contrato(aspv.cmpn_cdg,aspv.prqs_cdg,aspv.cntr_cdg_serie,aspv.cntr_nmr),'S') rut, p_clnt.Nombre_Estructurado(p_cntr.Titular_Contrato(aspv.cmpn_cdg,aspv.prqs_cdg,aspv.cntr_cdg_serie,aspv.cntr_nmr),'NA') nombre,p_clnt.Telefonos(p_cntr.Titular_Contrato(aspv.cmpn_cdg,aspv.prqs_cdg,aspv.cntr_cdg_serie,aspv.cntr_nmr)) telefonos,aspv.aspv_fch_asignacion fch_asignacion, decode(aspv.aspv_ult_gspv,null,'ASIGNADOS SIN GESTION',(select p_sndr.Descripcion_Codigo('tgpv',gspv.tgpv_cdg,'tgpv.tgpv_cdg','tgpv.tgpv_dsc') from   gspv where  gspv.gspv_sqc = aspv.aspv_ult_gspv)) Ult_gestion,decode(aspv.aspv_ult_gspv,null,aspv.aspv_fch_asignacion,(select gspv.gspv_fch from   gspv where  gspv.gspv_sqc = aspv.aspv_ult_gspv)) Fch_ult_gestion, decode(aspv.aspv_ult_gspv,null,null,(select gspv.gspv_fch_proxima_gestion from   gspv where  gspv.gspv_sqc = aspv.aspv_ult_gspv)) Fch_prox_gestion from   aspv where  aspv.aspv_fch_desasignacion is null order by aspv.aspv_fch_asignacion";


		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid = oci_parse($conn, $sql);
		$r = oci_execute($stid);
        $salida = array();

	while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){

		      $result=array();
              $result['CMPN_CDG'] = $row['CMPN_CDG'];
			  $result['PRQS_CDG'] = $row['PRQS_CDG'];
			  $result['CNTR_CDG_SERIE'] = $row['CNTR_CDG_SERIE'];
			  $result['CONTRATO'] = $row['CONTRATO'];
			  $result['RUT'] = $row['RUT'];
			  $result['NOMBRE'] = $row['NOMBRE'];
			  $result['TELEFONOS'] = $row['TELEFONOS'];
			  $result['FCH_ASIGNACION'] = $row['FCH_ASIGNACION'];
			  $result['ULT_GESTION'] = $row['ULT_GESTION'];
			  $result['FCH_ULT_GESTION'] = $row['FCH_ULT_GESTION'];
			  $result['FCH_PROX_GESTION'] = $row['FCH_PROX_GESTION'];
			  array_push($salida, $result);

		}

	}
	catch (exception $e){ 

	}

	return $salida;

}


// Complex Array Keys and Types +++++++++++++++++++++++++++
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



// Complex Array Keys and Types +++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionDataCantEst','complexType','struct','all','',
        array(
                'id' => array('name'=>'id','type'=>'xsd:int'),
                'name' => array('name'=>'name','type'=>'xsd:string')
        )
);


// Complex Array ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionArrayCantEst','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionDataCantEst[]'
            )
        )
);

// This is where I register my method and use the notaryConnectionArray
$server->register("entrada_cantidad_estados",
                array('token' => 'xsd:string'),
                array('notary_array' => 'tns:notaryConnectionArrayCantEst'),
                'urn:entrada_cantidad_estados',
                'urn:entrada_cantidad_estados',
                'rpc',
                'encoded',
                'Use this service to list notaries connected to the signed-in title company.');


function entrada_cantidad_estados($datos_contrato){

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
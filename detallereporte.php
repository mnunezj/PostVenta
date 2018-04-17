<?php 

require_once('nusoap/lib/nusoap.php');


$server = new soap_server();
$server->configureWSDL('Servicio_SSCM', 'urn:Servicio_SSCM');

//......................................................................................         

$server->wsdl->addComplexType(
	'entrada_detalle_reporte',
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
	'salida_detalle_reporte',
	'complexType',
	'struct',
	'all',
	'',
	array(
	    'CNTR_NMR' => array('name' => 'CNTR_NMR', 'type' => 'xsd:string'),
		'CLNT_NMR_RUT' => array('name' => 'CLNT_NMR_RUT', 'type' => 'xsd:string'),
		'CLNT_DGT_VERIFICADOR' => array('name' => 'CLNT_DGT_VERIFICADOR', 'type' => 'xsd:string'),
		'CLNT_NMB' => array('name' => 'CLNT_NMB', 'type' => 'xsd:string'),
		'CLNT_APL_PATERNO' => array('name' => 'CLNT_APL_PATERNO', 'type' => 'xsd:string'),
		'CLNT_APL_MATERNO' => array('name' => 'CLNT_APL_MATERNO', 'type' => 'xsd:string'),
		'CLNT_FCH_NACIMIENTO' => array('name' => 'CLNT_FCH_NACIMIENTO', 'type' => 'xsd:string'),
		'CLNT_IND_SEXO' => array('name' => 'CLNT_IND_SEXO', 'type' => 'xsd:string'),
		'CLNT_IND_ESTADO_CIVIL' => array('name' => 'CLNT_IND_ESTADO_CIVIL', 'type' => 'xsd:string'),
		'CLNT_IND_NACIONALIDAD' => array('name' => 'CLNT_IND_NACIONALIDAD', 'type' => 'xsd:string'),
		'CLNT_NMB_CALLE_PASAJE_PAR' => array('name' => 'CLNT_NMB_CALLE_PASAJE_PAR', 'type' => 'xsd:string'),
		'CLNT_NMR_CALLE_PAR' => array('name' => 'CLNT_NMR_CALLE_PAR', 'type' => 'xsd:string'),
		'CLNT_NMR_BLOCK_TORRE_PAR' => array('name' => 'CLNT_NMR_BLOCK_TORRE_PAR', 'type' => 'xsd:string'),
		'CLNT_NMR_DEPTO_PAR' => array('name' => 'CLNT_NMR_DEPTO_PAR', 'type' => 'xsd:string'),
		'CLNT_NMB_VILLA_POBLACION_PAR' => array('name' => 'CLNT_NMB_VILLA_POBLACION_PAR', 'type' => 'xsd:string'),
		'CLNT_CDG_POSTAL_PAR' => array('name' => 'CLNT_CDG_POSTAL_PAR', 'type' => 'xsd:string'),
		'CLNT_DSC_CASILLA_CORREO_PAR' => array('name' => 'CLNT_DSC_CASILLA_CORREO_PAR', 'type' => 'xsd:string'),
		'CLNT_DRC_EMAIL_PAR' => array('name' => 'CLNT_DRC_EMAIL_PAR', 'type' => 'xsd:string'),
		'COMUNA_PAR' => array('name' => 'COMUNA_PAR', 'type' => 'xsd:string'),
		'REGION_PAR' => array('name' => 'REGION_PAR', 'type' => 'xsd:string'),
		'COMUNA_LAB' => array('name' => 'COMUNA_LAB', 'type' => 'xsd:string'),
		'REGION_LAB' => array('name' => 'REGION_LAB', 'type' => 'xsd:string'),
		'FONO_FIJO_PAR' => array('name' => 'FONO_FIJO_PAR', 'type' => 'xsd:string'),
		'FONO_MOVIL_PAR' => array('name' => 'FONO_MOVIL_PAR', 'type' => 'xsd:string'),
		'FONO_FIJO_LAB' => array('name' => 'FONO_FIJO_LAB', 'type' => 'xsd:string'),
		'FONO_MOVIL_LAB' => array('name' => 'FONO_MOVIL_LAB', 'type' => 'xsd:string'),
		'FONO_CONTACTO' => array('name' => 'FONO_CONTACTO', 'type' => 'xsd:string'),
		'DIRECCION_PARTICULAR' => array('name' => 'DIRECCION_PARTICULAR', 'type' => 'xsd:string'),
		'TELEFONOS' => array('name' => 'TELEFONOS', 'type' => 'xsd:string')
		
	)
);

$server->register('entrada_detalle_reporte',                              	// method name
	array('entrada_detalle_reporte' => 'tns:entrada_detalle_reporte'),         	// input parameters
	array('return' => 'tns:salida_detalle_reporte'), 						// output parameters
	'urn:entrada_detalle_reporte',                							// namespace
	'urn:entrada_detalle_reporte',          								// soapaction
	'rpc',                        									// style
	'encoded',                    									// use
	'Retorna datos de contrato dado un contrato cualquiera'    		// documentation
);

function entrada_detalle_reporte($datos_contrato){

	$user = $datos_contrato['usuario'];
	$pass= $datos_contrato['valida'];	
	$result=array();
	//include('WAPAFR98.php');
	try{
	
	 	$sql1 = "select * from cntr c where c.cmpn_cdg = '".$datos_contrato['campana']."' and c.prqs_cdg = '".$datos_contrato['parque']."' and c.cntr_cdg_serie = '".$datos_contrato['codigo']."' and c.cntr_nmr = '".$datos_contrato['numero']."'";
		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid1 = oci_parse($conn, $sql1);
		$r1 = oci_execute($stid1);

		while ($row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)){
			
			$result['CNTR_NMR_RUT_TITULAR'] = $row1['CNTR_NMR_RUT_TITULAR'];
			$result['CLNT_DGT_VERIFICADOR'] = $row1['CLNT_DGT_VERIFICADOR'];
			$result['CNTR_NMR'] = $row1['CNTR_NMR'];
			
		}

		oci_free_statement($stid1);


		$sql = "select  CLNT_NMR_RUT, CLNT_DGT_VERIFICADOR, CLNT_NMB, CLNT_APL_PATERNO, CLNT_APL_MATERNO, CLNT_FCH_NACIMIENTO, CLNT_IND_SEXO, CLNT_IND_ESTADO_CIVIL, CLNT_IND_NACIONALIDAD, CLNT_NMB_CALLE_PASAJE_PAR, CLNT_NMR_CALLE_PAR, CLNT_NMR_BLOCK_TORRE_PAR, CLNT_NMR_DEPTO_PAR, CLNT_NMB_VILLA_POBLACION_PAR, CLNT_IND_FALLECIDO, RGNS_CDG_PAR, CMNS_CDG_PAR, CLNT_CDG_POSTAL_PAR, CLNT_DSC_CASILLA_CORREO_PAR, CLNT_DRC_EMAIL_PAR, CLNT_NMR_TELEFONO_PAR_1, CLNT_NMR_TELEFONO_PAR_2, CLNT_NMR_TELEFONO_PAR_3, CLNT_IND_DIRECCION_LAB, CLNT_NMB_CALLE_PASAJE_LAB, CLNT_NMR_CALLE_LAB, CLNT_NMR_BLOCK_TORRE_LAB, CLNT_NMR_OFICINA_LAB, CLNT_NMB_VILLA_POBLACION_LAB, RGNS_CDG_LAB, CMNS_CDG_LAB, CLNT_CDG_POSTAL_LAB, CLNT_DSC_CASILLA_CORREO_LAB, CLNT_DRC_EMAIL_LAB, CLNT_NMR_TELEFONO_LAB_1, CLNT_NMR_TELEFONO_LAB_2, CLNT_NMR_TELEFONO_LAB_3, CLNT_DSC_EMPLEADOR, CLNT_DSC_CARGO_FUNCION, CLNT_IND_DIRECCION_COR, CLNT_NMB_CALLE_PASAJE_COR, CLNT_NMR_CALLE_COR, CLNT_NMR_BLOCK_TORRE_COR, CLNT_NMR_DEPTO_COR, CLNT_NMB_VILLA_POBLACION_COR, RGNS_CDG_COR, CMNS_CDG_COR, clnt_ind_fono_preferente, clnt_ind_ultimo_contactado from clnt where clnt.clnt_nmr_rut = '".$result['CNTR_NMR_RUT_TITULAR']."'";
		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid = oci_parse($conn, $sql);
		$r = oci_execute($stid);
		while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
			$result['CLNT_NMR_RUT'] = $row['CLNT_NMR_RUT']; //
            $result['CLNT_DGT_VERIFICADOR'] = $row['CLNT_DGT_VERIFICADOR']; //
            $result['CLNT_NMB'] = $row['CLNT_NMB']; //
            $result['CLNT_APL_PATERNO'] = $row['CLNT_APL_PATERNO']; //
            $result['CLNT_APL_MATERNO'] = $row['CLNT_APL_MATERNO']; //
            $result['CLNT_FCH_NACIMIENTO'] = $row['CLNT_FCH_NACIMIENTO']; //
            $result['CLNT_IND_SEXO'] = $row['CLNT_IND_SEXO']; //
            $result['CLNT_IND_ESTADO_CIVIL'] = $row['CLNT_IND_ESTADO_CIVIL']; //
            $result['CLNT_IND_NACIONALIDAD'] = $row['CLNT_IND_NACIONALIDAD']; //
            $result['CLNT_NMB_CALLE_PASAJE_PAR'] = $row['CLNT_NMB_CALLE_PASAJE_PAR']; //
            $result['CLNT_NMR_CALLE_PAR'] = $row['CLNT_NMR_CALLE_PAR']; //
            $result['CLNT_NMR_BLOCK_TORRE_PAR'] = $row['CLNT_NMR_BLOCK_TORRE_PAR']; //
            $result['CLNT_NMR_DEPTO_PAR'] = $row['CLNT_NMR_DEPTO_PAR']; //
            $result['CLNT_NMB_VILLA_POBLACION_PAR'] = $row['CLNT_NMB_VILLA_POBLACION_PAR']; //
            $result['CLNT_DSC_CASILLA_CORREO_PAR'] = $row['CLNT_DSC_CASILLA_CORREO_PAR']; //
            $result['CLNT_DRC_EMAIL_PAR'] = $row['CLNT_DRC_EMAIL_PAR']; //
            $result['CLNT_NMR_TELEFONO_PAR_1'] = $row['CLNT_NMR_TELEFONO_PAR_1']; //
            $result['CLNT_NMR_TELEFONO_PAR_2'] = $row['CLNT_NMR_TELEFONO_PAR_2']; //
            $result['CLNT_NMR_TELEFONO_PAR_3'] = $row['CLNT_NMR_TELEFONO_PAR_3']; //
            $result['CLNT_DRC_EMAIL_LAB'] = $row['CLNT_DRC_EMAIL_LAB'];//
            $result['CLNT_NMR_TELEFONO_LAB_1'] = $row['CLNT_NMR_TELEFONO_LAB_1']; //
            $result['CLNT_NMR_TELEFONO_LAB_2'] = $row['CLNT_NMR_TELEFONO_LAB_2'];//
            $result['CLNT_NMR_TELEFONO_LAB_3'] = $row['CLNT_NMR_TELEFONO_LAB_3'];//
         
		}
		oci_free_statement($stid);
	    $sql2 = "select p_clnt.Comuna_Particular('".$result['CNTR_NMR_RUT_TITULAR']."') comuna_par, p_clnt.Region_Particular('".$result['CNTR_NMR_RUT_TITULAR']."') region_par, p_clnt.Comuna_Laboral('".$result['CNTR_NMR_RUT_TITULAR']."') comuna_lab, p_clnt.Region_Laboral('".$result['CNTR_NMR_RUT_TITULAR']."') region_lab, p_clnt.Telefono_RedFija_Particular('".$result['CNTR_NMR_RUT_TITULAR']."') fono_fijo_par, p_clnt.Telefono_Movil_Particular('".$result['CNTR_NMR_RUT_TITULAR']."') fono_movil_par, p_clnt.Telefono_RedFija_Laboral('".$result['CNTR_NMR_RUT_TITULAR']."') fono_fijo_lab, p_clnt.Telefono_Movil_Laboral('".$result['CNTR_NMR_RUT_TITULAR']."') fono_movil_lab, p_clnt.Telefono_Contacto('".$result['CNTR_NMR_RUT_TITULAR']."') fono_contacto, p_clnt.direccion_particular('".$result['CNTR_NMR_RUT_TITULAR']."') direccion_particular, p_clnt.Telefonos_Particulares('".$result['CNTR_NMR_RUT_TITULAR']."') telefonos from dual";	
	    $stid2 = oci_parse($conn, $sql2);
		$r2 = oci_execute($stid2);
		while ($row2 = oci_fetch_array($stid2, OCI_RETURN_NULLS+OCI_ASSOC)){
			$result['COMUNA_PAR'] = $row2['COMUNA_PAR'];
            $result['REGION_PAR'] = $row2['REGION_PAR'];
            $result['COMUNA_LAB'] = $row2['COMUNA_LAB'];
            $result['REGION_LAB'] = $row2['REGION_LAB'];
            $result['FONO_FIJO_PAR'] = $row2['FONO_FIJO_PAR'];
			$result['FONO_MOVIL_PAR'] = $row2['FONO_MOVIL_PAR'];
			$result['FONO_FIJO_LAB'] = $row2['FONO_FIJO_LAB'];
			$result['FONO_MOVIL_LAB'] = $row2['FONO_MOVIL_LAB'];
			$result['FONO_CONTACTO'] = $row2['FONO_CONTACTO'];
			$result['DIRECCION_PARTICULAR'] = $row2['DIRECCION_PARTICULAR'];
			$result['TELEFONOS'] = $row2['TELEFONOS'];
		}

	}


	
	catch (exception $e){ 

	}

	oci_free_statement($stid2);
	oci_close($conn);
	return array(
		'CNTR_NMR' => $result['CNTR_NMR'],
		'CLNT_NMR_RUT' => $result['CLNT_NMR_RUT'],
		'CLNT_DGT_VERIFICADOR' => $result['CLNT_DGT_VERIFICADOR'],
		'CLNT_NMB' => $result['CLNT_NMB'],
		'CLNT_APL_PATERNO' => $result['CLNT_APL_PATERNO'],
		'CLNT_APL_MATERNO' => $result['CLNT_APL_MATERNO'],
		'CLNT_FCH_NACIMIENTO' => $result['CLNT_FCH_NACIMIENTO'],
		'CLNT_IND_SEXO' => $result['CLNT_IND_SEXO'],
		'CLNT_IND_ESTADO_CIVIL' => $result['CLNT_IND_ESTADO_CIVIL'],
		'CLNT_IND_NACIONALIDAD' => $result['CLNT_IND_NACIONALIDAD'],
		'CLNT_NMB_CALLE_PASAJE_PAR' => $result['CLNT_NMB_CALLE_PASAJE_PAR'],
		'CLNT_NMR_CALLE_PAR' => $result['CLNT_NMR_CALLE_PAR'],
		'CLNT_NMR_BLOCK_TORRE_PAR' => $result['CLNT_NMR_BLOCK_TORRE_PAR'],
		'CLNT_NMR_DEPTO_PAR' => $result['CLNT_NMR_DEPTO_PAR'],
		'CLNT_NMB_VILLA_POBLACION_PAR' => $result['CLNT_NMB_VILLA_POBLACION_PAR'],
		'CLNT_DSC_CASILLA_CORREO_PAR' => $result['CLNT_DSC_CASILLA_CORREO_PAR'],
		'CLNT_DRC_EMAIL_PAR' => $result['CLNT_DRC_EMAIL_PAR'],
		'COMUNA_PAR' => $result['COMUNA_PAR'],
		'REGION_PAR' => $result['REGION_PAR'],
		'COMUNA_LAB' => $result['COMUNA_LAB'],
		'REGION_LAB' => $result['REGION_LAB'],
		'FONO_FIJO_PAR' => $result['FONO_FIJO_PAR'],
		'FONO_MOVIL_PAR' => $result['FONO_MOVIL_PAR'],
		'FONO_FIJO_LAB' => $result['FONO_FIJO_LAB'],
		'FONO_MOVIL_LAB' => $result['FONO_MOVIL_LAB'],
		'FONO_CONTACTO' => $result['FONO_CONTACTO'],
		'DIRECCION_PARTICULAR' => $result['DIRECCION_PARTICULAR'],
		'TELEFONOS' => $result['TELEFONOS']
		
	);
}

// Complex Array Keys and Types +++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionDataReport','complexType','struct','all','',
        array(
                'id' => array('name'=>'id','type'=>'xsd:int'),
                'name' => array('name'=>'name','type'=>'xsd:string')
        )
);


// Complex Array ++++++++++++++++++++++++++++++++++++++++++
$server->wsdl->addComplexType('notaryConnectionArrayReport','complexType','array','','SOAP-ENC:Array',
        array(),
        array(
            array(
                'ref' => 'SOAP-ENC:arrayType',
                'wsdl:arrayType' => 'tns:notaryConnectionDataReport[]'
            )
        )
);

// This is where I register my method and use the notaryConnectionArray
$server->register("entrada_reporte",
                array('token' => 'xsd:string'),
                array('notary_array' => 'tns:notaryConnectionArrayReport'),
                'urn:entrada_reporte',
                'urn:entrada_reporte',
                'rpc',
                'encoded',
                'Use this service to list notaries connected to the signed-in title company.');

function entrada_reporte($contrato){

	$user = $contrato['usuario'];
	$pass= $contrato['valida'];	

$salida = array();

		try{
	
	 	$sql = "select * from  table(p_gspv.Datos_gestion('".$contrato['campana']."','".$contrato['parque']."','".$contrato['codigo']."','".$contrato['numero']."'))";
		$conn = oci_pconnect($user, $pass,'192.168.80.65/DESASC');
		$stid = oci_parse($conn, $sql);
		$r1 = oci_execute($stid);


		while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){

			$result = array();

			$result['CONTRATO'] = $row['CONTRATO'];
			$result['ASIGNADOS_SIN_GESTION'] = $row['ASIGNADOS_SIN_GESTION'];
			$result['SIN_CONTACTO'] = $row['SIN_CONTACTO'];
			$result['CONTACTADO'] = $row['CONTACTADO'];
			$result['DATOS_CONFIRMADOS'] = $row['DATOS_CONFIRMADOS'];
			$result['NO_COMPLETA'] = $row['SIN_CONTACTO'];
			$result['CERRADO'] = $row['CERRADO'];
			$result['DERIVACION_VENTAS'] = $row['DERIVACION_VENTAS'];
			$result['DERIVACION_LEGAL'] = $row['DERIVACION_LEGAL'];
			$result['DERIVACION_SUPERVISORES'] = $row['DERIVACION_SUPERVISORES'];
			array_push($salida, $result);

		
		}

$sql1 = "select (select tgpv_dsc from tgpv where tgpv_cdg = g.tgpv_cdg) as estado,g.gspv_fch_actualizacion as fecha_actualizacion,g.gspv_clf_servicio as calificacion,g.gspv_ind_entrega_cntr as ind_entrega_cntr,a.aspv_fch_asignacion as fecha_asignacion from gspv g join aspv a  on g.aspv_cdg_tipo = a.aspv_cdg_tipo 
 where a.cmpn_cdg ='".$contrato['campana']."' and a.prqs_cdg='".$contrato['parque']."' and a.cntr_cdg_serie='".$contrato['codigo']."' and a.cntr_nmr='".$contrato['numero']."' ORDER BY fecha_actualizacion DESC";
	
	
	 $stid1 = oci_parse($conn, $sql1);
	 $r2 = oci_execute($stid1);

	 while ($row2 = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)){

			$result = array();

			
			$result['ESTADO'] = $row2['ESTADO'];
			$result['FECHA_GESTION'] = $row2['FECHA_GESTION'];
			$result['PROXIMA_GESTION'] = $row2['PROXIMA_GESTION'];
			$result['FECHA_ACTUALIZACION'] = $row2['FECHA_ACTUALIZACION'];
			$result['CALIFICACION'] = $row2['CALIFICACION'];
			$result['IND_ENTREGA_CNTR'] = $row2['IND_ENTREGA_CNTR'];
			$result['FECHA_ASIGNACION'] = $row2['FECHA_ASIGNACION'];
			array_push($salida, $result);

		
		}


}
catch (exception $e){ 

	}

return $salida;
		/*return array(
		'CONTRATO' => $result['CONTRATO'],
		'ASIGNADOS_SIN_GESTION' => $result['ASIGNADOS_SIN_GESTION'],
		'SIN_CONTACTO' => $result['SIN_CONTACTO'],
		'CONTACTADO' => $result['CONTACTADO'],
		'DATOS_CONFIRMADOS' => $result['DATOS_CONFIRMADOS'],
		'NO_COMPLETA' => $result['NO_COMPLETA'],
		'CERRADO' => $result['CERRADO'],
		'DERIVACION_VENTAS' => $result['DERIVACION_VENTAS'],
		'DERIVACION_LEGAL' => $result['DERIVACION_LEGAL'],
		'DERIVACION_SUPERVISORES' => $result['DERIVACION_SUPERVISORES'],
		'FECHA_GESTION' => $result['FECHA_GESTION'],
		'PROXIMA_GESTION' => $resutl['PROXIMA_GESTION'],
		'FECHA_ACTUALIZACION' => $result['FECHA_ACTUALIZACION'],
		'CALIFICACION' => $result['CALIFICACION'],
		'IND_ENTREGA_CNTR' => $result['IND_ENTREGA_CNTR'],
		'FECHA_ASIGNACION' => $result['FECHA_ASIGNACION'],
	    'ESTADO' => $result['ESTADO']
	);*/


}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
//$server->service($HTTP_RAW_POST_DATA);
$server->service(file_get_contents("php://input"));
?>



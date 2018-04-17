<?php
	require_once("adodb5/adodb.inc.php");
	include('adodb5/tohtml.inc.php'); # load code common to ADOdb
	include("adodb5/adodb-exceptions.inc.php");
	include("ucdb.php");
	$db = 	ADONewConnection("oci8");
	$str = 	"(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$ip)(PORT=$port)) (CONNECT_DATA=(SID=$sid)))";
	try{
	$db->Connect($str, $user, $pass);
		}
		catch(exception $e)
		    {
		    	session_unset();
                session_destroy();
                session_start();
                session_regenerate_id(true);
                session_destroy();
                
                //header('Location: expirado');
		    }
	
?>
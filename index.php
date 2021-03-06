<?php
include_once("./propertyDetails.class.php");
include_once("./locationDetails.class.php");
include_once("./areaDetails.class.php");
include_once("./loginDetails.class.php");
include_once('./config.inc.php');

$apiName = $apiType = $apiCat = $clientId = null;

if ( isset( $_REQUEST['name']) )
$apiName = $_REQUEST['name'];
if ( isset( $_REQUEST['type']) )
$apiType = $_REQUEST['type'];
if ( isset( $_REQUEST['cat']) )
$apiCat  = $_REQUEST['cat'];
if ( isset(  $_REQUEST['clientId'] ) )
$clientId = $_REQUEST['clientId'];

$obj = null;
switch ( $apiName )
{

  case 'login':
		$userId = $_REQUEST['user'];
		$passwd = $_REQUEST['passwd'];
	    	$obj = new loginDetails($userId,$passwd);
    break;

	case 'property': 
		$obj = new propertyDetails($apiType, $apiCat);
		break;

	case 'location':
		$obj = new locationDetails($apiType, $apiCat);
		break;

	case 'area':
		$obj = new areaDetails($apiType, $apiCat);
		break;

	default:
		error_log("Name of api not recoznized ");

}

if ( $obj != null )
{
	$result = $obj->executeQuery();
	if( empty($result) )
	{
		print "$result";
	}
	else
	{
		
		header ("Content-Type:text/xml"); 
		print "$result";
	}
}


?>

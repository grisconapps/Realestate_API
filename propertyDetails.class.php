<?php
include_once('./RealEstateDB.class.php');
class propertyDetails
{


	public 	$query ;
	public $dbConn;
	public $insertNew;

	public function propertyDetails($type, $cat)
	{

    		$this->init($type,$cat);
		$this->dbConn = new RealEstateDB(DB_USER,DB_PASSWD,DB_DATABASE);
		$this->dbConn->connect();
	}
  private function init($type,$cat)
  {
	  $this->insertNew = false;
	  switch($type)
	  {
		  case 'list':

			  $this->query = "select * from property ";
			  $params = '';
			  if ( $cat == 'filter' )
			  {
				  $params = $this->parseListParams();
				  if ( $params != null )
				  $this->query .= " where ";
			  }
			  $this->query .= "$params;";
			  break;

		  case 'add':

			  $this->insertNew = true;
			  $this->query = "insert into property ".$this->parseAddParams();
			  break;

		  case 'edit':

			  $this->query = "update property set "; // Update property with params added
			  $params = $this->parseUpdateParams();
			  $this->query .= "$params;";
			  break;

		  default:
			error_log("propertyDetail.init type = $type");  
	  }
  }

  private function parseListParams()
  {
	  $queryParams = '';
	  foreach ( $_REQUEST as $key=>$value)
	  {
		  if ( $key == 'name' || $key == 'type' || $key == 'cat' || $key == 'clientId' )
		  {
			  continue;
		  }
		  else if ( $queryParams != '' )
		  {
			  $queryParams .= " and "; 
		  }

		  $queryParams .= "$key=\"$value\"";

	  }
    return $queryParams;
  }
  private function parseAddParams()
  {
	  $queryKeys = '';
	  $queryValues = '';

	  foreach ( $_REQUEST as $key=>$value)
	  {
		  if ( $key == 'name' || $key == 'type' || $key == 'cat' || $key == 'clientId' )
			  continue;
		  if ( $queryKeys != '' )
			  $queryKeys .= ',';
		  if ( $queryValues != '' )
			  $queryValues .= ',';

		  $queryKeys .= $key;
		  $queryValues .= "\"$value\"";

	  }

	  return " ($queryKeys) values ($queryValues);";
  }

  private function parseUpdateParams()
  {
	  $queryUpdate = '';
	  $queryWhere = '';

		error_log("Request params = ".print_r($_REQUEST,1));
	  foreach ( $_REQUEST as $key=>$value)
	  {


		  if ( $key == 'name' || $key == 'type' || $key == 'cat' || $key == 'clientId' )
			  continue;

		  if ( $key == 'propId')
		  {
			  $queryWhere .= " $key=\"$value\""; 
			  continue;
		  }

		  if ( $queryUpdate != '' )
		  {
			  $queryUpdate .= ',';
		  }

		  $queryUpdate .= "$key=\"$value\"";

	  }
	  error_log(" queryUpdate = $queryUdate ");

	  return "$quertUpdate where $queryWhere";
  }

  public function executeQuery()
  {
	  
	  $result = $this->dbConn->prepareQuery($this->query);
	  if ( mysql_errno() || (!$result && !$this->insertNew))
	  {
		  $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		  $xml .= "<error>".mysql_error()."</error>";
		  $result = $xml;
	  }
	  if ( !mysql_errno() && !$result && $this->insertNew)
	  {
		  $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		  $xml .= "<results></results>";
		  $result = $xml;
	  }			    
	  return $result;
  }
  public function close()
  {
	  $this->dbConn->close();
  }

}

?>

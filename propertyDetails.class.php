<?php
include_once('./RealEstateDB.class.php');
class propertyDetails
{


	public 	$query ;
	public $dbConn;


	public function propertyDetails($type, $cat)
	{

    		$this->init($type,$cat);
		$this->dbConn = new RealEstateDB(DB_USER,DB_PASSWD,DB_DATABASE);
		$this->dbConn->connect();
	}
  private function init($type,$cat)
  {
     switch($type)
     {
     case 'list':

       $this->query = "select * from property";
       $params = '';
       if ( $cat == 'filter' )
       {
         $params = $this->parseListParams();
       }
        $this->query .= "$params;";
       break;
     
     case 'add':
       $this->query = "insert into property ".$this->parseAddParams();
       break;
     case 'edit':

        $this->query = "update property set "; // Update property with params added
          $params = $this->parseUpdateParams();
        $this->query .= "$params;";
       break;

    default;  
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
    
      $queryParams .= "$key=$value";

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
      $queryValues .= $value;

    }

    return " ($queryKeys) values ($queryValues);";
  }

  private function parseUpdateParams()
  {
      $queryUpdate = '';
      $queryWhere = '';
    foreach ( $_REQUEST as $key=>$value)
    {

      if ( $key == 'name' || $key == 'type' || $key == 'cat' || $key == 'clientId' )
        continue;

      if ( $key == 'propId')
      {
        $queryWhere .= " $key=$value"; 
         continue;
      }

      if ( $queryUpdate != '' )
      {
        $queryUpdate .= ',';
      }
  
      $queryUpdate .= "$key=$value";

    }

    return "$quertUpdate where $queryWhere";
  }

  public function executeQuery()
  {

	  $result = $this->dbConn->prepareQuery($this->query);
	  return $result;
  }
  public function close()
  {
	  $this->dbConn->close();
  }

}

?>

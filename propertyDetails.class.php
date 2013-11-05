<?php
include_once('./RealEstateDB.class.php');
class propertyDetails
{


	public 	$query ;
	public $dbConn;


	public function propertyDetails($type, $cat)
	{

    init($type,$cat);
		$this->dbConn = new RealEstateDB(DB_USER,DB_PASSWD,DB_DATABASE);
		$this->dbConn->connect();
	}
  private function init($type,$cat)
  {
     switch($type)
     {
     case 'list':

       $this->query = "select * from property";
       if ( $cat == 'filter' )
       {
         parseParams();
       }
       break;
     
     case 'add':
       
       break;
     
     case 'edit':

        $this->query = ""; // Update property with params added
       break;

    default;  
     }
  }

  private function parseParams()
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

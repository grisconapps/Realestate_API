<?php
include_once('./RealEstateDB.class.php');
class propertyDetails
{


	public 	$query ;
	public $dbConn;



	public function propertyDetails($type, $cat)
	{
		$this->query = "select * from property;";

		$this->dbConn = new RealEstateDB(DB_USER,DB_PASSWD,DB_DATABASE);
		$this->dbConn->connect();
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

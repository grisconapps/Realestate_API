<?php
include_once('./RealEstateDB.class.php');
class areaDetails
{


	public 	$query ;
	public $dbConn;



	public function areaDetails($type, $cat)
	{
		$this->query = "select * from Area_details;";

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

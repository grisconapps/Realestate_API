<?php
include_once('./RealEstateDB.class.php');
class loginDetails
{


	public 	$query ;
	public $dbConn;

	public function loginDetails($userId, $passwd)
	{
    $this->query = "select * from user where name='$userId' and passwd=$passwd;";
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

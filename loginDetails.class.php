<?php
include_once('./RealEstateDB.class.php');
class loginDetails
{


	public 	$query ;
	public $dbConn;
	public $userId;
	public $passwd;

	public function loginDetails($userId, $passwd)
	{
		$this->userId = $userId;
		$this->passwd = $passwd;

	    	$this->query = "select * from user where name=\"$userId\" and passwd=\"$passwd\";";
		$this->dbConn = new RealEstateDB(DB_USER,DB_PASSWD,DB_DATABASE);
		$this->dbConn->connect();
	}

	public function executeQuery()
	{
		$insertNewUser = false;
		if ( $result = $this->editUserDetails() )
		{		
			error_log("edit user details passed mysql_error:".mysql_errno());
			$insertNewUser = true;
		}
		else if ( $result = $this->newUserLogin() )
		{
			error_log("loginDetails.executeQuery Query: ".$this->query."\n");
			$result = $this->dbConn->prepareQuery($this->query);
			$insertNewUser = true;
			error_log("Result: $result");
		}
		if ( mysql_errno() || (!$result && !$insertNewUser))
		{
			$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
                        $xml .= "<error>".mysql_error()."</error>";
			$result = $xml;
		}
		if ( !mysql_errno() && !$result && $insertNewUser)
		{
			$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
                        $xml .= "<results></results>";
                        $result = $xml;
		}

		error_log("executeQuery Result: $result");
		return $result;
	}
	public function close()
	{
		$this->dbConn->close();
	}
	public function newUserLogin()
	{

		if ( isset($_REQUEST['type']) && $_REQUEST['type'] == 'add')
		{
	
			if ( $this->verifyExistingUser())
			{
				return false;
			}	
			$this->query = "insert into user ";
			$keys = $values = '';
			
			foreach($_REQUEST as $key=>$value)
			{
				if ( $key == 'name' || $key=='type' || $key == 'cat' )
						continue;
				if ( $key == 'user' )
					$key = 'name';
				if ( $keys != '' && $values != '' )
				{
					$keys .= ','; 
					$values .= ',';
				}
				$keys .= "$key";
				$values .= "'$value'";
			}

			$this->query .= "( $keys ) values ( $values );"; 
		}
	
		return true;
	}
	public function editUserDetails()
	{
		if ( isset($_REQUEST['type']) && $_REQUEST['type'] == 'edit' )
		{
			if (  !$this->verifyExistingUser() )
			{
				return false;
			}

			$this->query = "update user set ";
			$updateSet = '';
			$updateKey = '';

			foreach($_REQUEST as $key=>$value)
			{
				if ( $key == 'name' || $key=='type' || $key == 'cat' )
					continue;
				if ( $key == 'user' )
				{
					$key = 'name';
					$updateKey = "$key=\"$value\"";

				}
				if ( $updateSet != ''  )
				{
					$updateSet .= ','; 
				}
				$updateSet .= "$key=\"$value\"";
			}

			$this->query .= " $updateSet where $updateKey";
		}
		
		return true; 
	}
	public function verifyExistingUser()
	{
		$userId = $this->userId;
		$this->query = "select * from user where name=\"$userId\";";
		error_log("Query : ".$this->query."\n");
		$result = $this->dbConn->executeQuery($this->query);
		error_log("Result : ".$result);	    		
		if ( mysql_num_rows($result)>0)
			return true;
		return false;
	}

}

?>

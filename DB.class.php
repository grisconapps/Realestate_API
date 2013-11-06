<?php

class DB
{
	private $db;
	private $user;
	private $passwd;
	private $handle;

	public function DB($_user, $_passwd, $_db)
	{
		$this->handle = null;
		if ( $_user != null && $_passwd != null && $_db != null )
		{
			$this->user = $_user;
		        $this->passwd = $_passwd;
			$this->db = $_db;	
		}
	}
	public function connect()
	{
		$this->handle = mysql_connect("localhost",$this->user, $this->passwd);
		if ( !$this->handle )
		{
			error_log("Mysql Connect failure ".mysql_error());
			return;	
		}
		$this->selectDB();
	}
	public function selectDB($dbName = null)
	{
		if ( !$this->handle )
		{
			error_log("Mysql Connect failure ".mysql_error());
			return;
		}
		if ( $dbName == null )
		{
			if ( $this->db != null )
			{
				mysql_select_db($this->db,$this->handle);
			}
		}
		else
		{
			mysql_select_db($dbName , $this->handle);
		}
	}

	public function executeQuery($query)
	{
		$result = mysql_query($query);
		
		if ( !$result || mysql_errno() )
		{
			error_log("Execute Query : ".mysql_error());
      return false;
		}
		return $result;
	}

	public function close()
	{
		if ( $this->handle )
		{
			mysql_close($this->handle);
		}
	}
	
}

?>

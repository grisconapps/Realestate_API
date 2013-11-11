<?php 
require_once("./DB.class.php");

class RealEstateDB extends DB
{

	public function RealEstateDB($user,$passwd,$db)
	{
		parent::DB($user,$passwd,$db);
	}

	public function prepareQuery($query)
	{
	   $result = $this->executeQuery($query);
	   $resultXML = $this->convertResultToXML($result);

	   return $resultXML;
	}

	public function convertResultToXML($result)
	{

		if ( empty($result) )
		{
			error_log("RealEstateDB.convertResultToXML: result is null");
			$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
			$xml .= "<error>".mysql_error()."</error>";
			return $xml;
		}
		if( !empty($result) && !mysql_errno()  && mysql_num_rows($result)>0 )
		{
			$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
			$xml .= "<results>";
			while($result_array = mysql_fetch_assoc($result))
			{
				$xml .= "<row>";

				//loop through each key,value pair in row
				foreach($result_array as $key => $value)
				{
					//$key holds the table column name
					$xml .= "<$key>";

					//embed the SQL data in a CDATA element to avoid XML entity issues
					$xml .= "<![CDATA[$value]]>"; 

					//and close the element
					$xml .= "</$key>";
				}

				$xml.="</row>";
			}

			$xml .= "</results>";

			return $xml;	
		}		
	}

}

?>

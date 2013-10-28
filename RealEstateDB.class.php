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
	   if ( $this->validateQuery($query) )
	   {
		$result = $this->executeQuery($query);
	   }
	   $resultXML = $this->convertResultToXML($result);

	   return $resultXML;
	}
	public function validateQuery($query)
	{
	  return true;
	}
	public function convertResultToXML($result)
	{

		$xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		$xml         .= "<results>";
		if(mysql_num_rows($result)>0)
		{
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
		}		
		$xml .= "</results>";
	
		return $xml;	
	}

}

?>

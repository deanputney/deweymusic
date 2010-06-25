<?PHP
ini_set("memory_limit", "2G");

//name of XML cache file
	function getXML ($filename, $fileURL){
		$pathname = '/Library/WebServer/Documents/250_A/xml_scripts/';
		
		$replies = array();
		
		echo "wget '".$fileURL."' -O ".$pathname."tmp.xml"."<br/>\n\n";
		//echo "IN FILE";
		exec("rm ".$pathname.$filename);

		exec("wget '".$fileURL."' -O ".$pathname."tmp.xml", $replies);
		//echo "wget'd!";
	
		//Check the file to make sure it's got XML in it
/*
		$xmlCheck = file_get_contents($pathname."tmp.xml");
		$xmlCheck = substr($xmlCheck,0,4);
		
		if (!$xmlCheck == "<?xm") {
			//die("<p>WARNING FROM XMLFUNCTIONS: ".$filename." doesn't looks like XML, quitting. Check it to see what's wrong.");
		}
		else {
*/
			if($xml = simplexml_load_file($pathname."tmp.xml")){
				exec("mv ".$pathname."tmp.xml ".$pathname.$filename."");
				echo "Successfully downloaded and transferred XML for ".$fileURL."<br/><br/>";
				unset($xml);
			}
			else {
				echo "NOPE.";
			}
/* 		} */
	}

?>


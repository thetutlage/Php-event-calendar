<?php

	if($_POST)
	{
		$myFile = "config.php";
		$final_delete = unlink($myFile);
		
		if($final_delete)
		{
			echo 'Deleted Successfully';
		}
	}
	else
	{
		echo 'Forbidden Access Contact Admin';
	}

?>
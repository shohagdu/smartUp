<?php

//curl -s "http://matuailup.com/backup/" 

backup_tables('localhost','root','','correction_db');
/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	ini_set('memory_limit', '-1');
	$link = mysqli_connect($host,$user,$pass, $name);
	mysqli_set_charset($link, 'utf8'); // for bangla
	//mysqli_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($link, 'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	$return = '';
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($link, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		// $return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = preg_replace("#\n#", "\\n", $row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	// if (!file_exists('backup')) {
		// mkdir('backup', 0777, true);
	// }
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

?>
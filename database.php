<?php

//connect to mysql database

define ('DB_NAME', 'formos1');
define ('DB_USER', 'root');
define ('DB_PASSWORD', '38933241');
define ('DB_HOST', 'localhost'); 

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

if (!$link){
	die('Could not connect: ' . mysql_error());
}

$db_selected = mysqli_select_db($link, DB_NAME);

if (!$db_selected){
	die('Can\'t use ' . DB_NAME . ' : ' . mysqli_error());
}
//$sql="SELECT * FROM players"; // Taip niekada nedarytk, nes kiekvieną kartą kai šis failas bus includintas į kokį kitą faile, tai automatiškai šis sakinus bus paleidžiamas vykdymui.

//$records=$link->query($sql);
/* Arūno
function getPlayerById($ID) {
    global $link; //jungimasis prie localhost
    
    $ID = (int)$ID; // Užtikrinu, kad visada $id būtų sveikas skaičius.
    if (empty($ID)) {
        die('$ID can not be empty');
    }

    //$link yra pasiekiamas funkcijos viduje, nes jis aprašytas globaliai aukščiau funkcijos.
    $result = $link->query("SELECT * FROM players WHERE ID=".$ID." LIMIT 1");
    $row = $result->fetch_assoc();

    return !empty($row) ? $row : null;
}
*/
function table(){
	$ind = 0;
	$i = 0;
	$editas = " ";
	$delitas = " ";
	//global $records;
	global $link;
	global $ID;
	
	//$sql="SELECT * FROM players";
	//$records=$link->query($sql);
	//while($row=mysqli_fetch_array($records)){
	
	//$sql="SELECT * FROM players";
	$result=$link->query("SELECT * FROM players WHERE ID='.$ID.' LIMIT 1");
	//$row=$result->fetch_assoc()
	
	while($row = mysqli_fetch_assoc($result)){		
		$ind++;
        $editas = "<a href='edit.php?edit=$row[ID]'>edit</a>";
        $delitas = "<a href='delete.php?del=$row[ID]'>delete</a>";
        $i++; if (($i %2) == 0) {$class = "coloredbackground";} else {$class = "normalbackground";};
        "<tr><td class=\"".$class."\">" .$ind. 
		"</td><td class=\"".$class."\">". $row['ID'].
        "</td><td class=\"".$class."\">". $row['name']. 
        "</td><td class=\"".$class."\">" .$row['surname']. 
        "</td><td class=\"".$class."\">" .$row['birth_years']. 
        "</td><td class=\"".$class."\">" .$row['shirt_number'].
        "</td><td class=\"".$class."\">" . $editas . 
        "</td><td class=\"".$class."\">" . $delitas .
        "</td></tr>";
	}
	return !empty($row) ? $row : null;
}


?>


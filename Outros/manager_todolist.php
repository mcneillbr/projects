<?php

//########################################################
ini_set('display_errors', '0');
error_reporting(E_ALL);
//########################################################
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: text/json');
header('Content-type: application/json');


$rst = array();
$rst['POST'] = $_POST;
$rst['GET'] = $_GET;
$rst['rstCmd'] = '';

$usrCMD = '';
$todo_id = ''; // update e delete
$todo_text = '';
$usr_email = '';



if(array_key_exists('cmd', $_POST) || array_key_exists('cmd', $_GET))
{
	$usrCMD = (empty($_POST['cmd'])) ? $_GET["cmd"] : $_POST['cmd'];
}

if(array_key_exists('todo_text', $_POST) || array_key_exists('todo_text', $_GET))
{
	$todo_text = (empty($_POST['todo_text'])) ? $_GET["todo_text"] : $_POST['todo_text'];
}

if(array_key_exists('email', $_POST) || array_key_exists('email', $_GET))
{
	$usr_email = (empty($_POST['email'])) ? $_GET["email"] : $_POST['email'];
}

if(array_key_exists('todo_id', $_POST) || array_key_exists('todo_id', $_GET))
{
	$todo_id = (empty($_POST['todo_id'])) ? $_GET["todo_id"] : $_POST['todo_id'];
}


$HostName = "localhost";
$Database = "todolist";
$UserName = "www-user";
$Passwd = "@c3ss0";
	
	$myconn = new mysqli($HostName, $UserName, $Passwd, $Database);
	if (mysqli_connect_errno())
	{
		printf("Code de erro ao conectar: %s \n ", mysqli_connect_error());
		$rst['rstCmd'] = 'erro';
		flush();
		exit;
	}

if($usrCMD == 'list')
{
	$rst['rstCmd'] = 'view_nodata';
	$querySQL = "SELECT ID as tdId, EMAIL, TRIM(TODO) as `text` FROM todolist.td_list_data  WHERE ( EMAIL = '$usr_email') ORDER BY DATACREATED desc";
	$result = $myconn->query($querySQL);
	$viewData = array();
	if ($result) 
	{
 
		if($result->num_rows > 0)
		{
			
			while($r = $result->fetch_assoc()) 
			{
				$viewData[] = $r;
				
			}
			$rst['viewData'] = $viewData;
			$rst['rstCmd'] = 'view_ok';
		}
	
	}

}
else if($usrCMD == 'insert')
{
	$querySQL = "INSERT INTO todolist.td_list_data SET EMAIL = '$usr_email', TODO = '$todo_text'";
	$result = $myconn->query($querySQL);
	 
		if($myconn->affected_rows > 0)
		{
			$rst['rstCmd'] = 'insert_ok';
		}
		else
		{
			$rst['rstCmd'] = 'insert_fail';
		}			
		
}
else if($usrCMD == 'delete')
{
	$querySQL = "DELETE FROM todolist.td_list_data WHERE (ID = '$todo_id')";
	$result = $myconn->query($querySQL);
	if ($result) 
	{
 
		if($myconn->affected_rows > 0)
		{
			$rst['rstCmd'] = 'delete_ok';
		}
		else
		{
			$rst['rstCmd'] = 'delete_fail';
		}			
	
	}

}

else if($usrCMD == 'update')
{
	$querySQL = "UPDATE todolist.td_list_data SET TODO = '$todo_text' WHERE (ID = '$todo_id')";
	$result = $myconn->query($querySQL);
	if ($result) 
	{
 
		if($myconn->affected_rows > 0)
		{
			$rst['rstCmd'] = 'update_ok';
		}
		else
		{
			$rst['rstCmd'] = 'update_fail';
		}			
	
	}

}

echo json_encode($rst);
flush();
exit();


?>

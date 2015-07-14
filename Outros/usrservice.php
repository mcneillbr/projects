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
$usr_name = '';
$usr_email = '';
$usr_pwd = '';


if(array_key_exists('cmd', $_POST) || array_key_exists('cmd', $_GET))
{
	$usrCMD = (empty($_POST['cmd'])) ? $_GET["cmd"] : $_POST['cmd'];
}

if(array_key_exists('name', $_POST) || array_key_exists('name', $_GET))
{
	$usr_name = (empty($_POST['name'])) ? $_GET["name"] : $_POST['name'];
}

if(array_key_exists('email', $_POST) || array_key_exists('email', $_GET))
{
	$usr_email = (empty($_POST['email'])) ? $_GET["email"] : $_POST['email'];
}

if(array_key_exists('usr_pwd', $_POST) || array_key_exists('usr_pwd', $_GET))
{
	$usr_pwd = (empty($_POST['usr_pwd'])) ? $_GET["usr_pwd"] : $_POST['usr_pwd'];
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

if($usrCMD == 'login')
{
	$rst['rstCmd'] = 'login_fail';
	$querySQL = "SELECT ATIVO FROM todolist.tl_user WHERE ( NOME = '$usr_name' AND EMAIL = '$usr_email')";
	$result = $myconn->query($querySQL);
	if ($result) 
	{
 
		if($result->num_rows > 0)
		{
			$r = $result->fetch_assoc();
			if($r) 
			{
				$rst['status_login'] = $r["ATIVO"];
				$rst['rstCmd'] = 'login_ok';
			}
		}
	
	}

}
else if($usrCMD == 'insert')
{
	$querySQL = "INSERT INTO todolist.tl_user SET NOME = '$usr_name', EMAIL = '$usr_email', PWORD = MD5('123456')";
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
	$querySQL = "DELETE FROM todolist.tl_user WHERE (EMAIL = '$usr_email')";
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
	$querySQL = "UPDATE todolist.tl_user SET NOME = '$usr_name', EMAIL = '$usr_email', PWORD = MD5('123456') WHERE (EMAIL = '$usr_email')";
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

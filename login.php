<?
	session_start();
	include "db.php";
	$stmt=$db->prepare('SELECT password FROM stuff WHERE login=?');
	$stmt->execute(array($_GET['login']));
	if ($stmt->rowCount()){
		$stuff=$stmt->fetch();
		if ($stuff['password']=$_GET['password'])
			$_SESSION['admin']=1;
		//print_r($_SESSION);
	}
	header("Location: admin.php");
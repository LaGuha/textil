<?
	session_start();
	include "db.php";
	$stmt=$db->prepare("INSERT INTO orders VALUES (id, ?, ?, ?, ?,1)");
	$stmt->execute(array($_GET['name'],$_GET['phone'],$_GET['address'],json_encode($_SESSION['id'])));
	$_SESSION['count']=0;
	$_SESSION['price']=0;
	unset($_SESSION['id']);
	header("Location: /");
?>
<?
	session_start();
	include 'db.php';
	if ((isset($_SESSION['admin']))&&$_SESSION['admin']){
		$stmt=$db->prepare("UPDATE orders SET Status=0 WHERE id=?");
		$stmt->execute(array($_GET['id']));
		header("Location: admin.php");
	}else{
		$arr=$_SESSION['id'][$_GET['key']];
		$_SESSION['count']=$_SESSION['count']-$arr[1];
		$_SESSION['price']=$_SESSION['price']-$arr[2];
		unset($_SESSION['id'][$_GET['key']]);
		header("Location: purchase.php");
	}
?>
		
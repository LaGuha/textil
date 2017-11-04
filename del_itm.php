<?
	session_start();
	include "db.php";
	if ((isset($_SESSION['admin']))&&$_SESSION['admin']){
		$stmt=$db->prepare("DELETE FROM items WHERE id=?");
		$stmt->execute(array($_GET['id']));

	}
	header("Location:/")
?>
	

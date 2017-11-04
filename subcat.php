<?
	header('Content-type: text/html; charset=utf-8');
	include "db.php";
	$stmt=$db->prepare('SELECT * FROM Subcat WHERE category=?');
	$stmt->execute(array($_GET['gr']));
	$arr=array();
	$subarr=array();
	while($cat=$stmt->fetch()){
		$subarr[0]=$cat['id'];
		$subarr[1]=$cat['Name'];
		$arr[]=$subarr;
	}
	print_r(json_encode($arr));
?>
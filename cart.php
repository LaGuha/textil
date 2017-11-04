<?
	session_start();
	
	include "db.php";
	$stmt=$db->prepare("SELECT Price FROM Sizes WHERE Item_id=? AND Size=?");
	$stmt->execute(array($_GET['id'],$_GET['size']));
	if($stmt->rowCount()){
		$arr=$stmt->fetch();
		$price=$arr['Price'];
		$price=(int)str_replace(' ','',$price);
		$_SESSION['count']=$_SESSION['count']+round($_GET['count']);
		$_SESSION['price']=$_SESSION['price']+$price*round($_GET['count']);
		$add=0;
		if (isset($_SESSION['id'])){
			foreach ($_SESSION['id'] as $key => $id) {
			if ($_GET['id']==$id[0] && $_GET['size'] == $id[3]){
				$_SESSION['id'][$key]=array($_GET['id'],($id[1]+round($_GET['count'])),($id[2]+$price*round($_GET['count'])),$_GET['size']);
				$add=1;
			}
			if ($add)
				break;
		}
		}
		
		if(!$add)
			$_SESSION['id'][]=array($_GET['id'],round($_GET['count']),$price*round($_GET['count']),$_GET['size']);
	}
	$data=array('count'=>$_SESSION['count'],'price'=>$_SESSION['price']);
	print_r(json_encode(($data)));

?>
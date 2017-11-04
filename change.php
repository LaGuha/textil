<?
 define('SITE_ROOT', realpath(dirname(__FILE__)));
 header('Location:/admin.php');
  include "db.php";
  $name=substr($_FILES['img']['tmp_name'],8);
  $type=substr($_FILES['img']['name'],strpos($_FILES['img']['name'],'.'));
  if (isset($_POST['subcat'])){
  	$stmt=$db->prepare('SELECT Name FROM Subcat WHERE id=?');
  	$stmt->execute([$_POST['subcat']]);
  	$arr=$stmt->fetch();
  	$subcat=$arr['Name'];
  	print_r($_POST);
  }
  else{
  	$subcat=0;
  }
    if ($type==".png"||$type==".jpg"||$type==".jpeg"||$type==".gif"){
         if (move_uploaded_file($_FILES['img']['tmp_name'], SITE_ROOT. '/images/'.
         $name.$type)) {

         	$stmt=$db->prepare("UPDATE items SET img =? WHERE id=?");
         	$stmt->execute(array('/images/'.$name.$type,$_POST['id']));
          
        } else {
          print_r($_FILES);
        }
    }else {
       print_r($_FILES);
        print_r($type);
          print_r('err2');
    }
    if (isset($_POST['newprice'])&&$_POST['newprice']>0){
    	$stmt=$db->prepare("UPDATE items SET Name=?, Price=?, Newprice=?, Descr=?, Discount=?  WHERE id=?");
    	$stmt->execute(array($_POST['name'],$_POST['price'],$_POST['newprice'],$_POST['desc'],1,$_POST['id']));	
    }else{
    	$stmt=$db->prepare("UPDATE items SET Name=?, Price=?, Newprice=?, Descr=?, Discount=?  WHERE id=?");
    	$stmt->execute(array($_POST['name'],$_POST['price'],0,$_POST['desc'],0,$_POST['id']));	
      print_r($_POST);	
    }

?>
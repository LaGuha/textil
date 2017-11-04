<?
	session_start();
	setcookie($name='full',$value='1',$expire=time()+300,$domain='btwlines.ru',$httponly=false);
	header('Location:/');
?>
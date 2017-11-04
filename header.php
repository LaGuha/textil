<?session_start();
require_once('Mobile_Detect.php');
if(!isset($_COOKIE['full']))
	$_COOKIE['full']=0;
$detect = new Mobile_Detect; // Инициализируем копию класса
// Любое мобильное устройство (телефоны или планшеты).
/*	if ( ($detect->isMobile())) {
 	?>
 		<script>
 				<? if ($_COOKIE['full']==0){
 					?>
 						
 						location="http://m.btwlines.ru<?=$_SERVER['REQUEST_URI']?>";
 					<?
 				}
 					?>
 				
 		</script>
 	<?
}*/

	if(!isset($_SESSION['count'])){
		$_SESSION['price']=0;
		$_SESSION['count']=0;
		//$_SESSION['id'][]=array();
	}

?>
<head>
	<meta charset="UTF-8">
	<title>Заголовок</title>
	<link rel="stylesheet" type="text/css" href="css.css">
	<link rel="stylesheet" type="text/css" href="modal.css">
	<link rel="stylesheet" type="text/css" href="cart.css">
	<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</head>
<body>
	<header>
		<div id='top_line'>
			<div id='container'>
				<p>Бесплатная доставка</p>
				<p>Оплата при получении</p>
				<p>Гарантия качества</p>
				<p>Акции и предложения</p>
				<a href="/purchase.php"><p><img src="/images/cart-image.png">Товаров: <span class="count"><?=$_SESSION['count']?></span>&nbsp;
				(<span class="price"><?=$_SESSION['price']?></span> р.)</p></a>
			</div>
		</div>
		<div id=info>
			<div id='container'>
				<img src='/images/logo.png' width=350 height=87>
				<div class=center>
					<p><b>Прием заявок:</b><br>Круглосуточно, без перерывов и выходных!</p>
					<p><b>Адрес:</b><br>ул. Кости Коньшина д.42</p>
					<form>
						<input name=search placeholder="Поиск">
						<button type=submit><img src='/images/search.png'></button>
					</form>
				</div>
				<p class="ring"><span class="big">8-800-555-35-35</span><br><a>Заказать звонок</a></p>
				
			</div>
		</div>
	</header>
	<div id='menu'>
		<div id='container'>
			<a href='/'>Главная</a>
			<a href='contacts'>Адреса и контакты</a>
			<a href='/order'>Заказ</a>
			<a href='/payment'>Оплата</a>
			<a href='/receive'>Получение</a>
			<a href='/garant'>Гарантия и возврат</a>
		</div>
	</div>
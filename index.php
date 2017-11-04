<? 
	include "header.php";
	include "functions.php";
	include "db.php";
 ?>                            	
	<div id='content'>
		<div id='container'>
			<? include "menu.php" ?>
			<div class="center">

				<div id="openModal" class="modalDialog">
					<div>
						<a href="#close" title="Закрыть" class="close">X</a>
						<?item($_GET['id'])?>
					</div>
				</div>
				<? if ((isset($_SESSION['admin']))&&$_SESSION['admin']){
					?>
						<div id="change" class="modalDialog">
							<div>
								<a href="#close" title="Закрыть" class="close">X</a>
								<?change($_GET['id'])?>
							</div>
						</div>
					<?
				}
				if (!isset($_GET['page'])){
					$_GET['page']=0;
				}
				?>
				<h1 style="font-size: 25px"> Постельное белье</h1>
				<div id="items">

				<?if(strpos($_SERVER['REQUEST_URI'],'gr')){
					$url_prev='?gr='.$_GET['gr'].'&page='.($_GET['page']-1);
					$url_next='?gr='.$_GET['gr'].'&page='.($_GET['page']+1);
					$st=$db->prepare("SELECT MAX(id) FROM items WHERE gr=?");
					$st->execute(array($_GET['gr']));
					$max=$st->fetch();
				}
				else{
					$url_prev='?page='.($_GET['page']-1);
					$url_next='?page='.($_GET['page']+1);
					$st=$db->query("SELECT MAX(id) FROM items");
					$max=$st->fetch();
				}
				?>
				<p style="display: flex; width: 97%; height: 25px; justify-content: flex-end;">
				<? if ($_GET['page']>0){
					?>
					<a href=<?=$url_prev?>><Назад&nbsp;</a>
					<?
				}if ($_GET['page']<($max['MAX(id)']/20-1))
					{
				?>
				<a href=<?=$url_next?>>&nbsp;Вперед></a><?}?></p>
					<? if (isset($_GET['gr'])){
							items('gr');
						}elseif(isset($_GET['search'])){
							items('search');
						}else{
							items('all');
						}
					?>
					<p style="display: flex; width: 97%; height: 25px; justify-content: flex-end;">
						<? if ($_GET['page']>0){
							?>
							<a href=<?=$url_prev?>><Назад&nbsp;</a>
							<?
						}if ($_GET['page']<($max['MAX(id)']/20-1))
							{
						?>
						<a href=<?=$url_next?>>&nbsp;Вперед></a><?}?></p>
				</div>
			</div>
	<? 
			include "footer.php";
	?>
</body>
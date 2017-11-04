<? 
	include "header.php";
	include "functions.php";
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
				?>
			</div>
	<? 
			include "footer.php";
	?>
</body>
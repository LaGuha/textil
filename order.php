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
				<div class="text">
					<h1>Lorem Ipsum</h1>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris congue tristique neque ut faucibus. Maecenas quis dapibus augue. Nam quis lacus nec sem sollicitudin imperdiet. Nam sit amet dolor eget arcu consequat tincidunt. Duis posuere, purus non dapibus egestas, lacus dolor pulvinar turpis, id pellentesque lectus nisl eget erat. Aenean dignissim nibh eget ante auctor feugiat. Curabitur accumsan et arcu id feugiat. In quis velit euismod, hendrerit lectus quis, fringilla tortor. Duis id nisi augue. Praesent dapibus risus vitae nulla efficitur, dapibus hendrerit mi porttitor. Vivamus sed condimentum orci, sit amet posuere ligula. Nullam ligula leo, placerat id varius sed, mollis a massa. Donec ac nunc vitae metus venenatis vulputate.

Nunc pulvinar in nisi accumsan eleifend. Integer viverra diam nec lacinia fringilla. Fusce molestie lorem ex, id condimentum justo congue ac. Pellentesque facilisis tempus feugiat. Duis sit amet condimentum mi. Cras pharetra tellus at urna lobortis luctus vel sed mauris. Maecenas luctus neque quam, id aliquet diam malesuada ut. Ut at nibh libero.

Donec at luctus nibh, et sagittis enim. Nunc tellus enim, commodo quis fringilla sed, blandit eget nunc. Praesent vestibulum, sapien sed auctor aliquam, ante lorem scelerisque magna, et scelerisque nisi velit nec massa. Sed a convallis velit, non varius velit. Sed ultrices tortor vel mi finibus, maximus pellentesque nunc maximus. Fusce aliquam sapien diam, sit amet tempus leo aliquet a. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur quis lobortis metus. Aliquam ut gravida dolor. Nullam nec felis quis dui euismod sollicitudin non quis enim. Pellentesque tempus sapien arcu, quis euismod enim vestibulum vitae. Aenean vitae dolor ut augue laoreet sollicitudin sit amet et sapien. In et libero nec elit mollis efficitur non sed erat. Donec interdum tempus lacus, ut accumsan elit porta sit amet. Sed pharetra ligula sapien, non elementum sem volutpat a. Quisque eget bibendum mi.

				</div>
			</div>
	<? 
			include "footer.php";
	?>
</body>
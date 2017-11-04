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

				<? if (!isset($_SESSION['admin'])){
					?>
						<form id=login action=login.php>
							<h1>Войдите, чтобы продолжить</h1>
							<p><input name=login></p>
							<p><input type=password name="password"></p>
							<p><button type=submit>Войти</button></p>
						</form>
					<?
				}else{

					orders();
					?>
						<a href=#new style="color: #008000;text-decoration: underline;">Добавить товар</a>
						<div id="new" class="modalDialog">
							<div>
								<a href="#close" title="Закрыть" class="close">X</a>
								<form enctype="multipart/form-data" action="add.php" method="POST">
									<p>Название: <input name=name></p>
									<p>Цена: <input name=price></p>
									<p>Категория: <select name='gr' id=gr>
															<option>Выберите группу</option>
													<?
														include "db.php";
														$stmt=$db->query("SELECT * FROM groups");
														while ($group=$stmt->fetch()){
															?>
																<option value=<?=$group['id']?>><?=$group['Name']?></option>
															<?
														}
													?></select></p>
									<p>Подкатегория: <select name='subcat' id=subcat></select></p>
									<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
									<p>Изображение: <input type=file name=img></p>
									<p>Описание: <textarea name=desc></textarea></p>
									<button type=submit>Добавить</button>
								</form>
							</div>
						</div>
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
			<script>
				$('#gr').change(function(){
					$.ajax({
					    url: 'subcat.php',             // указываем URL и
					    type: 'GET',
					   	data:{
				                  gr:$('#gr').val()
				                },
					    success: function (data) { // вешаем свой обработчик на функцию success
					    	
					    	dat=JSON.parse(data);
					    	$('#subcat').empty();
					    	dat.forEach(function(item, i, dat) {
					    		$('#subcat').append("<option value="+item[0]+">"+item[1]+"</option>");
					    	});
					    } 
					});
				})
			</script>
			<? 
			include "footer.php";
			?>

				

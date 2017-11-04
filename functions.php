<?
	
	function items($var){
		include "db.php";
		if (!isset($_GET['page'])){
			$_GET['page']=0;
		}
		if ($var=='gr'){
			$st=$db->prepare("SELECT MIN(id) FROM items WHERE gr=? ");
			$st->execute(array($_GET['gr']));
			$min=$st->fetch();
			$stmt=$db->prepare("SELECT * FROM items WHERE gr=? AND id BETWEEN ? AND ?");
			$stmt->execute(array($_GET['gr'],($_GET['page']*20+$min['MIN(id)']),($_GET['page']+1)*20+$min['MIN(id)']));

		}elseif($var=='discount'){
			$stmt=$db->query("SELECT * FROM items WHERE Discount=1");
			?>
				<h1>Акции</h1>
			<?
		}elseif($var=='discount_right'){
			$stmt=$db->query("SELECT * FROM items WHERE Discount=1 ORDER BY RAND() LIMIT 3");
		}elseif($var=='search'){
			$stmt=$db->prepare("SELECT * FROM items WHERE Name LIKE ?");
			$stmt->execute(array('%'.$_GET['search'].'%'));
		}
		else {
			$stmt=$db->prepare("SELECT * FROM items WHERE id BETWEEN ? AND ?");
			$stmt->execute(array($_GET['page']*20,($_GET['page']+1)*20));
		}
		if (!$stmt->rowCount()){
			echo "<b>Товар не найден</b>";
		}
		while ($item=$stmt->fetch()){
			if(strpos($_SERVER['REQUEST_URI'],'gr'))
				$url='?gr='.$_GET['gr'].'&';
			else
				$url='?'
			?>
			<div>
				<? if ((isset($_SESSION['admin']))&&$_SESSION['admin']){
					?>
						<p style="display:flex; height: 20px; width: 200px; justify-content: space-between; color: #008000;text-decoration: underline;">
							<a href=del_itm.php?id=<?=$item['id']?>>Удалить </a>
							<a href=<?=$url?>id=<?=$item['id']?>#change>Изменить</a>
						</p>
						
					<?
				}
				?>
				<a href=<?=$url?>id=<?=$item['id']?>#openModal>

						<p align="center"><?=cutStr($item['Name'])?></p>
						<p><img src="<?=$item['Img']?>" height="150"></p>
						<?
							$stmt2=$db->prepare("SELECT Price FROM Sizes WHERE Item_id=?");
							$stmt2->execute(array($item['id']));
							$price=$stmt2->fetch();
						?>
						<p><?=$price['Price']?></p>
					</a>
				<p><form>
						<input type="hidden" class=itm_id name="item" value=<?=$item['id']?>>
						<input type=number name="number" min=1 value="1"><span class="change"><span class=plus>➕</span><span class=minus>➖</span></span>
						<button class=itm_btn type=submit><img src='/images/cart2.png'>Купить</button>
				</form></p>
			</div>
			<?
		}
	}
	function SubcatName($var){
		include "db.php";
		$stmt=$db->prepare("SELECT Name FROM Subcat WHERE id=?");
		$stmt->execute(array($var));
		if ($stmt->rowCount())
			$Subcat=$stmt->fetch();
		else
			$Subcat['Name']='Что-то пошло не так!';
		return $Subcat['Name'];
	}
	function item($var){
		include "db.php";
		$stmt=$db->prepare("SELECT * FROM items WHERE id=?");
		$stmt->execute(array($var));
		if ($stmt->rowCount()){
			$item=$stmt->fetch();
			?>
				<p align="center"><?=$item['Name']?></p>
				<div id=item>
					<div>
						<p><img src=<?=$item['Img']?> height="150"></p>
																	
					</div>
					<div>
						<?
							$stmt2=$db->prepare("SELECT * FROM Sizes WHERE Item_id=?");
							$stmt2->execute(array($item['id']));
							
						?>
						<p style="font-size: large; margin-top: 15px;">Выберите размер:<br>
							<select class="size">
								<?
									while ( $price=$stmt2->fetch()) {

										?>
											<option value="<?=$price['Size']?>"><?=$price['Size']?>&nbsp;&nbsp;&nbsp;(<?=$price['Price']?> руб.)</option>
										<?
										# code...
									}
								?>
							</select>
						</p>		
						<form>
							<input type="hidden"  name="item" value='<?=$item['id']?>'>
							<input type=number name="number" min=1 value="1"><span class="change"><span class=plus>+</span><span class=minus>-</span></span>
							<button class=itm_btn type=submit>Купить</button>
						</form>
					</div>

				</div>
				<p><?=$item['Description']?>
			<?
		}else
		echo "<h1>Нет такого товара</h1>";
		
	}
	function cart(){
		include "db.php";
		if ($_SESSION['count']){
			?>

				<form id='cart' action=new.php>
					<p>ФИО:<input name=name required></p>
					<p>Телефон:<input required type=text name=phone class="phone" placeholder="8-(9XX)-XXX-XX-XX"></p>
					<p>Адресс:<input required name=address></p>
					<button type=submit>Купить</button>
				</form>

				<div class="table">
					<p>
						<span style="width: 200px">Товар</span>
						<span style="width: 100px">Количество</span>
						<span style="width: 100px">Цена</span>
						<span style="width: 100px">Сумма</span>
						<span style="width: 90"></span>
					</p>
					
				<?
					foreach ($_SESSION['id'] as $key => $id) {
						
						$stmt=$db->prepare('SELECT Name FROM items WHERE id=?');
						$stmt->execute(array($id[0]));
						$item=$stmt->fetch();
						$st=$db->prepare('SELECT Price FROM Sizes WHERE Item_id=? AND Size=?');
						$st->execute(array($id[0],$id[3]));
						$prce=$st->fetch();
                        $price=$prce['Price'];
                        $price=(int)str_replace(' ','',$price);
				?>
					<p>
						<span style="width: 200px"><?=$item['Name']?></span>
						<span style="width: 100px"><?=$id[1]?></span>
						<span style="width: 100px"><?=$price?></span>
						<span style="width: 100px"><?=$id[2]?></span>
						<span style="width: 90"><a href=/del.php?key=<?=$key?>>Удалить</a></span>
					</p>
				<?		
					}
				?>
				</div>
			<?
		}else
		echo "<h1>Корзина пуста</h1>";
	}
	function cutStr($str, $length=70, $postfix='...')
	{
		if ( strlen($str) <= $length)
		return $str;

		$temp = substr($str, 0, $length);
		return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
	}

	function orders(){
		include "db.php";
					$stmt=$db->query("SELECT * from orders WHERE Status=1");
					if ($stmt->rowCount()){
						?>
							<div class="table">
								<p>
									<span style="width: 200px">Товар</span>
									<span style="width: 50px">Кол-во</span>
									<span style="width: 200px">Клиент</span>
									<span style="width: 50px">Сумма</span>
									<span style="width: 90"></span>
								</p>
								
						<?
						while ($order=$stmt->fetch()){
							$itogo=0;
							$items=json_decode($order['Items']);
								?>
									<p ><span style="width: 200px">
								<?
							foreach ($items as $key => $value) {
								$stmt1=$db->prepare("SELECT Name FROM items where id=?");
								$stmt1->execute(array($value[0]));
								$item=$stmt1->fetch();
								$itogo=$itogo+$value[2];

								?>
									<span class="high"><?=$item['Name']?></span><br>
								<?
							}
								?>
									</span><span style="width: 50px">
								<?
							foreach ($items as $key => $value) {
								?>
									<span class="high"><?=$value[1]?></span><br>
								<?
							}
							?>
								</span>
								<span style="width: 200px"><?=$order['Name']?><br><?=$order['Phone']?><br><?=$order['Address']?></span>
								<span style="width: 50px"><?=$itogo?></span>
								<span style="width: 90px"><a href=/del.php?id=<?=$order['id']?>>Готово</a></span></p>
								<hr style="width: 590px">
							<?
						}
					?>
						</div>
					<?		
					}
					else{
		
					echo "<h1>Нет новых заказов</h1>";
				}
	}
	function change(){
		include "db.php";
		if ((isset($_SESSION['admin']))&&$_SESSION['admin']){
			$stmt=$db->prepare('SELECT * FROM items WHERE id=?');
			$stmt->execute(array($_GET['id']));
			$item=$stmt->fetch();
			$stmt2=$db->prepare('SELECT * FROM Sizes WHERE Item_id=?');
			$stmt2->execute(array($_GET['id']));
			?>
				<form action="change.php" method="POST" enctype="multipart/form-data">
									<input type=hidden name="id" value=<?=$item['id']?>>
									<p>Название: <input name=name value="<?=$item['Name']?>"></p>
									<? while ($size=$stmt2->fetch()){
										?>
										<p> Размер: <?=$size['Size']?><input name=<?=$size['Size']?> value='<?=$size['Price']?>'></p>
										<?
									}
									?>
									<p>Изображение: <input type=file name=img></p>
									<p>Описание: <textarea name=desc><?=$item['Description']?></textarea></p>
									<button type=submit>Сохранить</button>
								</form>
			<?
		}
		
	}
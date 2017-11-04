
<?
header('Content-type: text/html; charset=utf-8');
$usr="root";
$pswd="17021942";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$db = new PDO('mysql:host=localhost;dbname=stroy;charset=UTF8;', $usr, $pswd,$opt);
$stmt=$db->query("SELECT * FROM items");
$var=$stmt->fetch();
$cat=$var['Subcategory'];
$stmt2=$db->prepare("INSERT INTO Subcat (Name, category) VALUES (?,?)");
$stmt2->execute([$cat,$var['Category']]);
while ($var=$stmt->fetch()) {
	if($var['Subcategory']!=$cat){
		$cat=$var['Subcategory'];
		$stmt2=$db->prepare("INSERT INTO Subcat (Name, category) VALUES (?,?)");
		$stmt2->execute([$cat,$var['Category']]);

	}
}
?>
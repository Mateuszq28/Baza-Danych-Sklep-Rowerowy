<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Edytuj rower</title>
</head>
<body>
<h1> Edytuj rower </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane.
//metodą //POST – użyjemy je w zapytaniu poniżej
$id = $_POST['idos'];
$zm = $_POST['zmien'];
// Połączmy się z bazą danych.
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno być połączenie
// wykonajmy zapytanie – najpierw wyświetlimy dane
$query = "SELECT model, kolor from rower where
id_roweru=$id;";
$wynik = pg_query($query);
$model = pg_fetch_result($wynik,0,'model');
$kolor = pg_fetch_result($wynik,0,'kolor');
$lk = pg_num_fields($wynik);
echo "<form action=edro2.php method=post class=edycja>";

$query = "Select nr_seryjny, nazwa FROM model;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "Model: <select name=model>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwa');
		$idmo = pg_fetch_result($result,$num_wyniku,'nr_seryjny');
		echo"<option value=$idmo>id: $idmo $nazw</option>";
		$num_wyniku--;} 
echo "</select><br /><br />";

echo "Kolor: <input type=text name='kolor' value=$kolor><br>";
echo "<input type=hidden name='idos' value=$id>";
//echo "<input type=hidden name='nazwa' value=$nazwa>";
echo "<input type=submit name='zmien' value=OK>";
echo "</form>";
?>
</body>
</html>

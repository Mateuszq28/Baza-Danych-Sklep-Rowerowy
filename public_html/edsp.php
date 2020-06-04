<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Edytuj sprzedaż</title>
</head>
<body>
<h1> Edytuj sprzedaż </h1>
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
$query = "SELECT nabywca, produkt, cena from sprzedaz where
nr_transakcji=$id;";
$wynik = pg_query($query);
$nabywca = pg_fetch_result($wynik,0,'nabywca');
$produkt = pg_fetch_result($wynik,0,'produkt');
$cena = pg_fetch_result($wynik,0,'cena');
//$data = pg_fetch_result($wynik,0,'data');
$lk = pg_num_fields($wynik);
echo "<form action=edsp2.php method=post class=edycja>";

$query = "Select * FROM klient;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "Nabywca: <select name=nabywca value=$nabywca>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwisko');
		$im = pg_fetch_result($result,$num_wyniku,'imie');
		$idkl = pg_fetch_result($result,$num_wyniku,'id_klienta');
		echo"<option value=$idkl>id: $idkl $im $nazw</option>";
		$num_wyniku--;} 
echo "</select><br /><br />";

$query = "Select * FROM rowery_stan;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "Produkt: <select name=produkt value=$produkt>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwa');
		$kol = pg_fetch_result($result,$num_wyniku,'kolor');
		$idrow = pg_fetch_result($result,$num_wyniku,'id_roweru');
		echo"<option value=$idrow>id: $idrow $nazw $kol</option>";
		$num_wyniku--;} 
echo "</select><br /><br />";

echo "Cena: <input type=text name='cena' value=$cena><br>";
echo "Uwaga! Nie można edytować daty dokonanej sprzedaży!<br />";
echo "<input type=hidden name='idos' value=$id>";
//echo "<input type=hidden name='nazwa' value=$nazwa>";
echo "<input type=submit name='zmien' value=OK>";
echo "</form>";
?>
</body>
</html>

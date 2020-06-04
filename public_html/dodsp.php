<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Dodaj sprzedaż</title>
</head>
<body>
<h1> Dodaję sprzedaż </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – użyjemy je w zapytaniu poniżej
$nabywca = $_POST['nabywca'];
$produkt = $_POST['produkt'];
$cena = $_POST['cena'];
$data = $_POST['data'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno byc połączenie
// wykonajmy zapytanie
if ($produkt != NULL & $nabywca != NULL) {
	if ($data == NULL) {
		$query = "INSERT INTO sprzedaz(nabywca, produkt, cena) VALUES
		('$nabywca', '$produkt', '$cena');"; }
	else {
		$query = "INSERT INTO sprzedaz(nabywca, produkt, cena, data) VALUES
		('$nabywca', '$produkt', '$cena', '$data');"; }
	$wynik = pg_query($query);
	// sprawdźmy ile wierszy podmieniono
	$ls = pg_affected_rows($wynik);
	echo " Dodano $ls sprzedaż <br /> \n";
	}
else {echo " Pola nabywca i produkt nie mogą pozostać puste! <br /> \n";}
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo "<form action=sprzedazbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

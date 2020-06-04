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
$nabywca = $_POST['nabywca'];
$produkt = $_POST['produkt'];
$cena = $_POST['cena'];
//$data = $_POST['data'];
// Połączmy się z bazą danych.
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno być połączenie
// wykonajmy zapytanie – najpierw wyświetlimy dane
if ($produkt != NULL & $nabywca != NULL) {
	$query = "UPDATE sprzedaz SET nabywca = '$nabywca', produkt = '$produkt', cena = '$cena'
	WHERE nr_transakcji = '$id';";
	$wynik = pg_query($query);
	// sprawdzmy ile wierszy podmieniono
	$ls = pg_affected_rows($wynik);
	echo " Edytowano $ls sprzedaż <br /> \n";
}
else {echo " Pola nabywca i produkt nie mogą pozostać puste! <br /> \n";}
pg_close($dbh);
// zapewnijmy powrót do strony poprzedniej
echo "<form action=sprzedazbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

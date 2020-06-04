<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Dodaj model</title>
</head>
<body>
<h1> Dodaję model </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – użyjemy je w zapytaniu poniżej
$nazwa = $_POST['nazwa'];
$rok = $_POST['rok'];
$marka = $_POST['marka'];
$rama = $_POST['rama'];
$kolo = $_POST['kola'];
$naped = $_POST['naped'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno byc połączenie
// wykonajmy zapytanie
if ($rok == NULL) {
	$query = "INSERT INTO model(nazwa, marka, rama, kola, naped) VALUES
	('$nazwa', '$marka', '$rama', '$kolo', '$naped');"; }
else {
	$query = "INSERT INTO model(nazwa, rok, marka, rama, kola, naped) VALUES
	('$nazwa','$rok','$marka','$rama','$kolo','$naped');"; }
$wynik = pg_query($query);
// sprawdźmy ile wierszy podmieniono
$ls = pg_affected_rows($wynik);
echo " Dodano $ls model <br /> \n";
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo "<form action=modelbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

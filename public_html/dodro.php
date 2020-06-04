<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Dodaj rower</title>
</head>
<body>
<h1> Dodaję rower </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – użyjemy je w zapytaniu poniżej
$model = $_POST['model'];
$kolor = $_POST['kolor'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno byc połączenie
// wykonajmy zapytanie
if ($model != NULL) {
		$query = "INSERT INTO rower(model, kolor) VALUES
		('$model','$kolor');";
		$wynik = pg_query($query);
		// sprawdźmy ile wierszy podmieniono
		$ls = pg_affected_rows($wynik);
		echo " Dodano $ls rower <br /> \n";
}
else { echo"Pole model nie może pozostać puste!"; }
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo "<form action=rowery_wsbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

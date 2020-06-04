<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Dodaj klienta</title>
</head>
<body>
<h1> Dodaję klienta </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane
//metodą //POST – użyjemy je w zapytaniu poniżej
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$tel = $_POST['tel'];
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno byc połączenie
// wykonajmy zapytanie
$query = "INSERT INTO klient(imie, nazwisko, telefon) VALUES
('$imie','$nazwisko','$tel');";
$wynik = pg_query($query);
// sprawdźmy ile wierszy podmieniono
$ls = pg_affected_rows($wynik);
echo " Dodano $ls klienta <br /> \n";
pg_close($dbh);
// zapewnijmy powrot do strony poprzedniej
echo "<form action=klientbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

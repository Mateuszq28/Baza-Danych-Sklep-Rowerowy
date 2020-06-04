<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Edytuj model</title>
</head>
<body>
<h1> Edytuj model </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy parametry dla skryptu przekazane.
//metodą //POST – użyjemy je w zapytaniu poniżej
$id = $_POST['idos'];
$nazwa = $_POST['nazwa'];
$rok = $_POST['rok'];
$marka = $_POST['marka'];
$rama = $_POST['rama'];
$kola = $_POST['kola'];
$naped = $_POST['naped'];
// Połączmy się z bazą danych.
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno być połączenie
// wykonajmy zapytanie – najpierw wyświetlimy dane
if ($rok == NULL) {
$query = "UPDATE model SET nazwa = '$nazwa', rok = NULL, marka =
'$marka', rama = '$rama', kola = '$kola', naped = '$naped'
WHERE nr_seryjny = '$id';"; }
else {
$query = "UPDATE model SET nazwa = '$nazwa', rok = '$rok', marka =
'$marka', rama = '$rama', kola = '$kola', naped = '$naped'
WHERE nr_seryjny = '$id';"; }
$wynik = pg_query($query);
// sprawdzmy ile wierszy podmieniono
$ls = pg_affected_rows($wynik);
echo " Edytowano $ls model <br /> \n";
pg_close($dbh);
// zapewnijmy powrót do strony poprzedniej
echo "<form action=modelbd.php method=post>
<input type=submit name=Ok value=OK>
</form>";
?>
</body>
</html>

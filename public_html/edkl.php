<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>Edytuj klienta</title>
</head>
<body>
<h1> Edytuj klienta </h1>
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
$query = "SELECT imie, nazwisko, telefon, id_klienta from klient where
id_klienta=$id;";
$wynik = pg_query($query);
$imie = pg_fetch_result($wynik,0,'imie');
$nazwisko = pg_fetch_result($wynik,0,'nazwisko');
$tel = pg_fetch_result($wynik,0,'telefon');
$lk = pg_num_fields($wynik);
echo "<form action=edkl2.php method=post class=edycja>";
echo "Imię: <input type=text name='imie' value=$imie><br>";
echo "Nazwisko: <input type=text name='nazwisko' value=$nazwisko><br>";
echo "Telefon: <input type=text name='tel' value=$tel><br>";
echo "<input type=hidden name='idos' value=$id>";
echo "<input type=hidden name='imie' value=$imie>";
echo "<input type=submit name='zmien' value=OK>";
echo "</form>";
?>
</body>
</html>

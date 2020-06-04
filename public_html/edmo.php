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
$zm = $_POST['zmien'];
// Połączmy się z bazą danych.
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę
połączyć się z bazą danych!");
// tu powinno być połączenie
// wykonajmy zapytanie – najpierw wyświetlimy dane
$query = "SELECT nazwa, rok, marka, rama, kola, naped, nr_seryjny from model where
nr_seryjny=$id;";
$wynik = pg_query($query);
$nazwa = pg_fetch_result($wynik,0,'nazwa');
$rok = pg_fetch_result($wynik,0,'rok');
$marka = pg_fetch_result($wynik,0,'marka');
$rama = pg_fetch_result($wynik,0,'rama');
$kola = pg_fetch_result($wynik,0,'kola');
$naped = pg_fetch_result($wynik,0,'naped');
$lk = pg_num_fields($wynik);
echo "<form action=edmo2.php method=post class=edycja>";
echo "Nazwa: <input type=text name='nazwa' value=$nazwa><br>";
echo "Rok: <input type=date name='rok' value=$rok><br>";
echo "Marka: <input type=text name='marka' value=$marka><br>";
echo "Rama: <input type=text name='rama' value=$rama><br>";
echo "Koła: <input type=text name='kola' value=$kola><br>";
echo "Napęd: <input type=text name='naped' value=$naped><br>";
echo "<input type=hidden name='idos' value=$id>";
echo "<input type=hidden name='nazwa' value=$nazwa>";
echo "<input type=submit name='zmien' value=OK>";
echo "</form>";
?>
</body>
</html>

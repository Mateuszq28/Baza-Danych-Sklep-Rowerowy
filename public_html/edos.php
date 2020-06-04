<html>
<head>
<meta charset="UTF-8">
<title>Edytuj osobe</title>
</head>
<body>
<h1> Edytuj osobe </h1>
<?php
// tu umieszczamy kod skryptu
//po pierwsze – odbierzmy paramery dla skryptu przekazane.
//metodą //POST – uzyjemy je w zapytaniu ponizej
$id = $_POST['idos'];
$zm = $_POST['zmien'];
// Połączmy się z bazą danych.
$dbh = pg_connect("dbname=lab4_s171577 user=s171577
password=123 host=localhost") or die("Nie moge
polaczyc sie z baza danych !");
// tu powinno byc polaczenie
// wykonajmy zapytanie – najpierw wyswietlmy dane
$query = "SELECT imie,nazwisko,nr_dowodu,id_klienta from klient where
id_klienta=$id;";
$wynik = pg_query($query);
$nazw = pg_fetch_result($wynik,0,'nazwisko');
$im = pg_fetch_result($wynik,0,'imie');
$dow = pg_fetch_result($wynik,0,'nr_dowodu');
$lk = pg_num_fields($wynik);
echo "<form action=edos2.php method=post>";
echo "<input type=text name='nazwisko' value=$nazw><br>";
echo "<input type=text name='imie' value=$im><br>";
echo "<input type=text name='nr_dowodu' value=$dow><br>";
echo "<input type=hidden name='idos' value=$id>";
echo "<input type=hidden name='nazw' value=$nazw>";
echo "<input type=submit name='zmien' value=OK>";
echo "</form>";
?>
</body>
</html>

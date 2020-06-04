<html>
<html>
<head>
<meta charset="UTF-8">
<link rel="Stylesheet" type="text/css" href="style.css" />
<title>PostgreSQL i php</title>
</head>
<body>
<h1> SKLEP ROWEROWY </h1>
<img src="bicycle-bike-cyclist-37836.jpg" alt="bike">

<div class="guzik">
<div class="guzik1"><a href="klientbd.php" class="link_maly">Klienci<br />(podstawowa tabela)</a></div>
<div class="guzik2"><a href="sprzedazbd.php" class="link_maly">Sprzedaż<br />(widok 4 tabele)</a></div>
<div class="guzik3"><a href="rowery_stbd.php" class="link_maly">Rowery na stanie<br />(widok 3 tabele)</a></div>
<div class="guzik4"><a href="rowery_wsbd.php" class="link_maly">Wszystkie rowery<br />(widok 2 tabele)</a></div>
<div class="guzik5"><a href="modelbd.php" class="link_duzy">Modele<br />(podstawowa tabela)</a></div>
</div>

<h3> Rowery na stanie (niesprzedane) <h3>
<?php
// tu umieszczamy kod skryptu
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę połączyć się z
bazą danych!");
// tu powinno byc polaczenie
// wykonajmy zapytanie
// teraz wyświetlmy dane
$query = "Select * from rowery_stan";
$wynik = pg_query($dbh,$query);
// odbierzmy rozmiary tabeli:
$liczba_kolumn = pg_num_fields($wynik);
$liczba_wierszy = pg_num_rows($wynik);
// teraz wyświetlmy dane
echo "<TABLE border width=1>";
echo "<TABLE border width=1>";
echo "<TR>";
for($k =0;$k<$liczba_kolumn;$k++)
{
echo "<TD>";
echo pg_field_name($wynik,$k);
echo "</TD>"; //echo "\t";
}
for($w =0;$w<$liczba_wierszy;$w++)
{
echo "<TR>";
for($k =0;$k<$liczba_kolumn;$k++)
{
echo "<TD>";
echo pg_fetch_result($wynik,$w,$k);
echo "</TD>"; //echo "\t";
}
// tu dodajemy formularz do usuwania
// tu dodajemy formularz do edycji
echo "</TR>"; //echo "<br />";
}
echo "</TABLE>";
// Tu wyświetlimy wyniki działania funkcji
echo "<br /><br />Sprzedane rowery: ";
$query = "Select count(nr_transakcji) FROM sprzedaz;";
$wynik = pg_query($query);
$funkcja = pg_fetch_result($wynik,0);
echo "$funkcja";
echo "<br />Rowery na stanie: ";
$query = "Select count(*) from rowery_stan;";
$wynik = pg_query($query);
$funkcja = pg_fetch_result($wynik,0);
echo "$funkcja";
echo "<br /><br />";
pg_close($dbh);
?>
</body>
</html>

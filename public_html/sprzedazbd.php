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

<h3> Lista transakcji <h3>
<?php
// tu umieszczamy kod skryptu
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę połączyć się z
bazą danych!");
// tu powinno byc polaczenie
// wykonajmy zapytanie
// teraz wyświetlmy dane
$query = "Select * from raport_sprzedazy";
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
echo "<td>Usuń</td><td>Edytuj</td></TR>";
for($w =0;$w<$liczba_wierszy;$w++)
{
echo "<TR>";
for($k =0;$k<$liczba_kolumn;$k++)
{
echo "<TD>";
echo pg_fetch_result($wynik,$w,$k);
echo "</TD>"; //echo "\t";
}
$idos = pg_fetch_result($wynik,$w,$liczba_kolumn-1);
// tu dodajemy formularz do usuwania modelu
echo "<td><form action=delsp.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=usun value=Usuń></form></td>";
// tu dodajemy formularz do edycji modelu
echo "<td><form action=edsp.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=zmien value=zmień></form></td>";
echo "</TR>"; //echo "<br />";
}
echo "</TABLE>";
// Tu wyświetlimy wynik funkcji
$query = "Select najlepszy_klient();";
$wynik = pg_query($query);
$funkcja = pg_fetch_result($wynik,0);
echo "<br /><br />Najlepszy klient (własna funkcja zwracająca varchar z imieniem
<br />i nazwiskiem osoby, która kupiła najwięcej rowerów): $funkcja<br /><br />";
// Tu dopiszmy nowy model
echo "<br /><br />";
echo "<FORM action=dodsp.php method=POST>
Dodaj nową sprzedaż do bazy <br /><br />
Nabywca: ";

$query = "Select * FROM klient;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "<select name=nabywca>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwisko');
		$im = pg_fetch_result($result,$num_wyniku,'imie');
		$idkl = pg_fetch_result($result,$num_wyniku,'id_klienta');
		echo"<option value=$idkl>id: $idkl $im $nazw</option>";
		$num_wyniku--;} 
echo "</select>";

echo " Produkt: ";

$query = "Select * FROM rowery_stan;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "<select name=produkt>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwa');
		$kol = pg_fetch_result($result,$num_wyniku,'kolor');
		$idrow = pg_fetch_result($result,$num_wyniku,'id_roweru');
		echo"<option value=$idrow>id: $idrow $nazw $kol</option>";
		$num_wyniku--;} 
echo "</select>";

echo " Cena: <input type=text name=cena><br />
Data zakupu: <input type=date name=data>
<input type=submit name=Dodaj value=Dodaj>
</form>
<br /><br />";
pg_close($dbh);
?>
</body>
</html>

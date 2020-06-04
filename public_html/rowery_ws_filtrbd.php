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

<h3> Spis wszystkich sprzedanych oraz posiadanych rowerów <h3>
<?php
// tu umieszczamy kod skryptu
// Połączmy się z bazą danych
$dbh = pg_connect("dbname=projekt_s171577 user=s171577
password=123 host=localhost") or die("Nie mogę połączyć się z
bazą danych!");
// tu powinno byc polaczenie
// wykonajmy zapytanie
// teraz wyświetlmy dane
$wybor_kol = $_POST['wybor_kol'];
if ($wybor_kol == NULL) {
	$query = "Select * from wykaz_rowerow"; }
else { 
	$query = "Select * from wykaz_rowerow WHERE kolor = '$wybor_kol'"; }
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
// tu dodajemy formularz do usuwania roweru
echo "<td><form action=delro.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=usun value=Usuń></form></td>";
// tu dodajemy formularz do edycji roweru
echo "<td><form action=edro.php method=POST>
<input type=hidden name=idos value=$idos>
<input type=submit name=zmien value=zmień></form></td>";
echo "</TR>"; //echo "<br />";
}
echo "</TABLE>";
//Tu dodajmy formularz wyboru

echo "<br /><br /><FORM action=rowery_ws_filtrbd.php method=POST>
Wybierz wszystkie rowery w kolorze: ";

$query = "Select kolor from rower group by kolor;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "<select name=wybor_kol>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$kol = pg_fetch_result($result,$num_wyniku,'kolor');
		echo"<option value=$kol>$kol</option>";
		$num_wyniku--;} 
echo "</select><br /><br />
<input type=submit name=Filtruj value=Filtruj>
</form>";

// Tu dopiszmy nowy rower
echo "<br /><br />";
echo "<FORM action=dodro.php method=POST>
Dodaj nowy rower do bazy <br /><br />
Model: ";

$query = "Select nr_seryjny, nazwa FROM model;";
$result = pg_query($query);
$num_wyniku = pg_num_rows($result);
echo "<select name=model>";
	while($num_wyniku >= 0) {
		//$wynik = pg_query($query);
		$nazw = pg_fetch_result($result,$num_wyniku,'nazwa');
		$idmo = pg_fetch_result($result,$num_wyniku,'nr_seryjny');
		echo"<option value=$idmo>id: $idmo $nazw</option>";
		$num_wyniku--;} 
echo "</select> ";

echo "Kolor: <input type=text name=kolor>
<input type=submit name=Dodaj value=Dodaj>
</form>
<br /><br />";
pg_close($dbh);
?>
</body>
</html>

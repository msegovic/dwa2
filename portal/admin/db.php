<?php
// FUNKCIJA ZA PROVJERU DA LI JE KORISNIK LOGIRAN NA STR
function logiran($tip)
{
	if(!isset($_SESSION['login']))
	{  
		header("Location: index.php");
	}
	else
	{
		if($_SESSION['tip']<$tip) // AKO KORISNIK POKUSA PRISTUPITI STRANICI IZNAD SVOJE RAZINE PRIVILEGIJA
                                          // ADMINISTRATOR MOZE PRISTUPITI SVIM STRANICAMA - ADMIN, UREDNIK, AUTOR
                                          // UREDNIK SVOJOJ I AUTORSKOJ
                                          // AUTOR SAMO SVOJOJ
		{
			header("Location: logout.php"); // ODJAVI GA
		}
	}
}

function db()
{ 
    $conn = new mysqli("localhost", "root", "raspberry", "portal_msegovic");  
    return $conn;
}

function padajuca($tablica,$id,$tekst,$naziv_polja)
{	
	$c = db();
	if($c->errno) 
	{ 
		echo 'Do�lo je do greske prilikom spajanja<br>';
		echo 'Opis gre�ke: '.$c->error.'<br>';
	}
	else  { echo 'Spojeni na bazu podataka!<br>'; }
	// POSTAVLJANJE UPITA
	$upit = "SELECT * FROM $tablica ORDER BY $tekst";
	// POSTAVLJANJE UPITA I DOHVAT REZULTATA
	$r = $c->query($upit);
	if(!$r){ echo 'Upit nije uspio<br>Gre�ka = '.$c->error; } 
	else { echo 'Imamo upit!<br>';}
	
	// ISPIS REZULTATA
	
    echo '<select name="'.$naziv_polja.'">'; 
	while($redak=$r->fetch_assoc())
	{
echo '<option value="'.$redak[$id].'">'. $redak[$tekst].'</option>';
	}
	echo '</select>';
	
	// UNI�TAVANJE RECORDSETA
	$r->free();
	// ZATVARANJE VEZE NA BAZU
	$c->close();
}






function select($tablica,$value,$tekst,$html_ime)
{
	$c = db();
	$upit = "SELECT $value,$tekst FROM $tablica  ORDER BY $tekst";
	$r = $c->query($upit);
	echo '<select name="'.$html_ime.'">';
	while($redak=$r->fetch_assoc())
	{
echo '<option value="'.$redak[$value].'">'. $redak[$tekst].'</option>';
	}
	echo '</select>';
}

function preselect($tablica,$value,$tekst,$html_ime,$odabrana)
{
	$c = db();
	$upit = "SELECT $value,$tekst FROM $tablica  ORDER BY $tekst";
	$r = $c->query($upit);
	echo '<select name="'.$html_ime.'">';
	while($redak=$r->fetch_assoc())
	{
echo '<option ';
if($odabrana == $redak[$value]) { echo ' selected="selected" '; }
echo 'value="'.$redak[$value].'">'. $redak[$tekst].'</option>';
	}
	echo '</select>';
}
?>




<?php session_start();
require_once('db.php');
logiran(3);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php
if(!isset($_GET['a'])) { $a = ''; } else { $a = $_GET['a']; }
$c = db();
echo '<p align="right"><a href="logout.php">ODJAVA</a></p>';
switch($a) 
{
	case 'create': unos(); break;
	case 'update': izmjeni(); break;
	case 'delete': brisi(); break;
	default : pregled(); form();  prijave2(); // READ
}

function prijave2(){
    global $c;
    $sql = "SELECT k.id, k.username, COUNT(p.id) AS brp      
            FROM korisnici k 
            LEFT JOIN prijave p ON (p.id_korisnika = k.id)  
            GROUP BY p.id_korisnika";
    $r = $c->query($sql);
    echo '<table border="1" cellpadding="4">';
    while($row = $r->fetch_assoc())
    {
      echo '<tr>';
      echo '<td>'.$row['id'].'</td>';
      echo '<td>'.$row['username'].'</td>';
      echo '<td>'.$row['brp'].'</td>';
      echo '</tr>';
    }
    echo '</table>';
}
function prijave(){
    global $c;
    $id = $_GET['id'];
    $sql = "SELECT p.id, p.ip_adresa, p.ulazak, 
            p.izlazak, k.username 
            FROM prijave p, korisnici k 
            WHERE p.id_korisnika = k.id  
            AND id_korisnika = $id 
            ORDER BY p.ulazak DESC";
    $r = $c->query($sql);
    echo '<table border="1" cellpadding="4">';
    while($row = $r->fetch_assoc())
    {
      echo '<tr>';
      echo '<td>'.$row['id'].'</td>';
      echo '<td>'.$row['username'].'</td>';
      echo '<td>'.$row['ip_adresa'].'</td>';
      echo '<td>'.$row['ulazak'].'</td>';
      echo '<td>'.$row['izlazak'].'</td>';
      echo '</tr>';
    }
    echo '</table>';
}
function pregled(){
	// ISPIS KATEGORIJA SA EDIT I DELETE LINKOVIMA
	global $c;
	$sql = "SELECT id, naziv FROM kategorije";
	$r = $c->query($sql);
	while($row = $r->fetch_assoc())
	{
	  echo '<p>'.$row['naziv'];
	  echo ' - <a href="?a=update&id='.$row['id'].'">IZMJENI</a>';
	  echo ' - <a href="?a=delete&id='.$row['id'].'">IZBRISI</a>';
	  echo '</p>';
	}
}
function form(){
	// OBRAZAC SA JEDNIM TEXT POLJEM
	global $c;
	echo '<form method="post" action="?a=create">';
	echo '<input type="text" name="naziv">';
	echo '<input type="submit" name="submit" value="Spremi">';
	echo '</form>';
}
function unos(){
	global $c;
	$naziv = $_POST['naziv'];
	$sql = "INSERT INTO kategorije(naziv) VALUES ('$naziv')";
	$c->query($sql);
	echo '<a href="administratori.php">Povratak</a>';
}
function izmjeni()
{	
	global $c;
	$id = $_GET['id']; // POSLANO SA PREGLEDA "?a=update&id=11"
	if(!$_POST)
	{
		$sql = "SELECT naziv FROM kategorije WHERE id=$id";
		$r = $c->query($sql);
		$row = $r->fetch_assoc(); // Netreba while jer je samo 1 redak
		// OBRAZAC SA JEDNIM TEXT POLJEM (POPUNJENO POLJE)
		echo '<form method="post" action="?a=update&id='.$id.'">';
		echo '<input type="text" name="naziv" value="'.$row['naziv'].'">';
		echo '<input type="submit" name="submit" value="Spremi">';
		echo '</form>';
	}
	else
	{
		// UPDATE U BAZI
		$naziv = $_POST['naziv'];
		$sql = "UPDATE kategorije SET naziv='$naziv' WHERE id=$id";
		$c->query($sql);
		echo '<a href="administratori.php">Povratak</a>';
	}
}
function brisi(){
	// NEMA POTVRDE, ODMAH DELETE, NEMA OBRAZAC
	global $c;
	$id = $_GET['id'];
	$sql = "DELETE FROM kategorije WHERE id=$id LIMIT 1";
	$c->query($sql);
	echo '<a href="administratori.php">Povratak</a>';
}
?>
</body>
</html>

<?php session_start();
require_once('db.php');
logiran(2);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php
$c = db();
if(!isset($_GET['a'])) { $a = ''; } else { $a = $_GET['a']; }
echo '<p align="right"><a href="logout.php">ODJAVA</a></p>';
switch($a)
{
	case 'pregled': pregled(); break;
	case 'objavi' : objavi(); break;
        case 'komentar': komentar_urednika(); break;
	default: pocetna();
}

function komentar_urednika(){
    // VEZA NA BAZU
    global $c;
    // DOHVATI KOMENTAR
    $kom_ur = $_POST['kom_ur'];
    $vk_kom_ur = $_POST['vk_kom_ur'];
    $id = $_GET['id'];
    // PRIPREMI UPIT
    $upit = "UPDATE clanci SET kom_ur = '$kom_ur',
        vk_kom_ur = $vk_kom_ur 
        WHERE id = $id";
    echo $upit;
    // IZVRŠI IZMJENU
    $c->query($upit);
    echo $c->error;
    // LINK ZA POVRATAK
    echo 'Izmjenjeno.<a href="?a=pregled&id='.$id.'">Natrag na clanak</a>';
}

function pregled()
{
	// PRIKAZ JEDNOG ODABRANOG CLANKA
	global $c;
	$id = $_GET['id'];
	$sql = "SELECT c.id,c.naslov,c.objavljen, c.datum, c.kom_ur, 
					c.uvod, c.tekst, k.ime, k.prezime  
			FROM clanci c, korisnici k 
			WHERE c.vk_autora = k.id 
			AND c.id=$id " ;
	$r = $c->query($sql);
	$row = $r->fetch_assoc(); // NE TREBA WHILE KAD JE 1 REDAK
	// ISPIS
	echo '<h1>'.$row['naslov'].'</h1>';
	echo '<p>'. $row['uvod'].'</p>';
	echo '<p>'. $row['tekst'].'</p>';
	echo '<p>'. $row['ime'].' '.$row['prezime'].'</p>';
	
	if($row['objavljen']==1)
			{ $rijec = 'DA'; $novaVrijednost = 0; }
			else // inace 0
			{ $rijec = 'NE'; $novaVrijednost = 1; }
			
			echo '<p><a href="?a=objavi&id='.$row['id'].'&nova='
					.$novaVrijednost.'">'.$rijec.'</a></p>';

                        
// OBRAZAC ZA KOMENTARE UREDNIKA
echo '<form method="post" action="?a=komentar&id='.$id.'">';
echo '<p>Komentari urednika:</p>';
echo '<textarea cols="80" rows="6" name="kom_ur">'.$row['kom_ur'].'</textarea>';
$id_kor = $_SESSION['id_kor'];
echo '<input type="hidden" name="vk_kom_ur" 
    value="'.$id_kor.'">';
echo '<br><input type="submit" name="submit"
    value="Spremi">';
echo '</form>';
}

function objavi()
{
	// IZMJENI STATUS CLANKA
	global $c;
	$id = $_GET['id'];     // IZ LINKA "DA"/"NE"
	$nova = $_GET['nova']; // -//-
	$sql = "UPDATE clanci SET objavljen=$nova WHERE id=$id";
	$c->query($sql);
	echo '<a href="urednici.php">Izmjenjeno</a>';
}
function pocetna()
{
	// PREGLED SVIH CLANAKA
	global $c;
	$sqlKat = "SELECT id, naziv FROM kategorije";
	$r = $c->query($sqlKat);
	while($row = $r->fetch_assoc())
	{
		echo '<h2>'.$row['naziv'].'</h2>';
		// DOHVATI SVE CLANKE U KATEGORIJI
		$sqlClanci = "SELECT c.id,c.naslov,c.objavljen, c.datum, 
							k.ime, k.prezime  
						FROM clanci c, korisnici k 
						WHERE c.vk_autora = k.id 
						AND vk_kategorije=".$row['id'];
		$rC = $c->query($sqlClanci);
		
		echo '<table border="1" cellpadding="4">';
		echo '<tr>';
		echo '	<th>Naslov</th> 
				<th>Autor</th> 
				<th>Datum</th> 
				<th>Objavljen?</th>';
		echo '</tr>';
		while($rowC = $rC->fetch_assoc())
		{
			echo '<tr>';
			
			echo '<td><a href="?a=pregled&id='.$rowC['id'].'">'.$rowC['naslov'].'</a></td>';
			echo '<td>'.$rowC['ime'].' '.$rowC['prezime'].'</td>';
			echo '<td>'.$rowC['datum'].'</td>';
			
			echo '<td>';
			if($rowC['objavljen']==1)
			{ $rijec = 'DA'; $novaVrijednost = 0; }
			else // inace 0
			{ $rijec = 'NE'; $novaVrijednost = 1; }
			
			echo '<a href="?a=objavi&id='.$rowC['id'].'&nova='
					.$novaVrijednost.'">'.$rijec.'</a>';
			
			echo '</td>';
			
			
			
			echo '</tr>';
		}
		echo '</table>';
		
	}
}
?>
</body>
</html>

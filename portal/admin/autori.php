<?php session_start();
require_once('db.php');
logiran(1);
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
// DOHVATI ID OSOBE I POSTAVI GA U SESSION VARIJABLU "kid"
// IF SLUZI KAKO BI OVAJ UPIT RADILI SAMO JEDNOM
if(!isset($_SESSION['kid'])) 
{ 
	$sql = "SELECT id 
		FROM korisnici 
		WHERE username ='".$_SESSION['login']."'";
	$r = $c->query($sql);
	$row = $r->fetch_assoc(); // WHILE NE TREBA KADA JE SAMO 1 RED
	$_SESSION['kid']=$row['id'];
}
echo '<p align="right"><a href="logout.php">ODJAVA</a></p>';
switch($a) 
{
	case 'create': unos(); break;
	case 'update': izmjeni(); break;
	case 'delete': brisi(); break;
        case 'tagiraj': tagiranje(); break;
        case 'povezitag': povezitag(); break;
	default : pregled(); form(); // READ
}
function povezitag(){
    global $c;
    $id_clanka = $_POST['id_clanka'];
    if(!isset($_POST['tag'])){
        // POSLAN MI JE OBRAZAC ZA UNOS NOVOG TAGA
        $naziv = $_POST['novi_tag'];
        $upit = "INSERT INTO tagovi(naziv, klikova) 
            VALUES('$naziv',0)";
        $c->query($upit);
        $id_taga = $c->insert_id;
    }
    else{ 
        $id_taga = $_POST['tag'];
    }
    
$upit = "INSERT INTO clanci_tagovi VALUES($id_clanka, $id_taga)";
    $c->query($upit);   
    echo '<a href="?a=tagiraj&id='.$id_clanka.'">POVRATAK</a>';
}

function tagiranje(){
    // 1. ODABRANI CLANAK
    $id = $_GET['id'];
    $upit = "SELECT naslov, tekst FROM clanci WHERE id = $id";
    global $c;
    $r = $c->query($upit);
    if($r){
        $row = $r->fetch_assoc();
        echo '<h2>NASLOV = '.$row['naslov'].'</h2>';
        echo '<p align="justify">'.$row['tekst'].'</p><hr>';
        // DODATI ISPIS SVIH POVEZANIH TAGOVA
        $upit = "SELECT t.id, t.naziv 
            FROM tagovi t, clanci_tagovi ct 
            WHERE t.id = ct.vk_taga 
            AND ct.vk_clanka = $id";
        $rT = $c->query($upit);
        echo '<ol>';
        while($row = $rT->fetch_assoc()){
            echo '<li>'.$row['naziv'].'</li>';
        }
        echo '</ol>';
    }
    // 2. ODABIR POSTOJECEG TAGA
    echo '<form method="post" action="?a=povezitag">';
    echo '<fieldset>';
    echo '<p>Odaberi tag:';
    select('tagovi','id','naziv','tag');
    echo '</p>';
    echo '<input type="hidden" name="id_clanka" value="'.$id.'">';
    echo '<input type="submit" name="submit" value="POVEZI TAG">';
    echo '</fieldset>';
    echo '</form>';
    // 3. UNOS NOVOG TAGA
    echo '<form method="post" action="?a=povezitag">';
    echo '<fieldset>';
    echo 'Unesi tag: <input type="text" name="novi_tag"> ';
    echo '<input type="hidden" name="id_clanka" value="'.$id.'">';
    echo '<input type="submit" name="submit" 
        value="UNESI I POVEZI TAG">';
    echo '</fieldset>';
    echo '</form>';
}
function pregled(){
	// ISPIS KATEGORIJA SA EDIT I DELETE LINKOVIMA
	global $c;
	$sql = "SELECT c.id, c.naslov, c.kom_ur, k.id AS kid  
			FROM clanci c, korisnici k  
			WHERE c.vk_autora = k.id 
			AND k.username = '".$_SESSION['login']."'";
	$r = $c->query($sql);
	if($r->num_rows == 0) 
	{
		echo '<p>Nemate radova u bazi</p><hr>';
	}
	while($row = $r->fetch_assoc())
	{
	  echo '<p>'.$row['naslov'];
          if(strlen($row['kom_ur'])>0){
              echo '<span style="color:red;">*</span>';
          }
	  echo ' - <a href="?a=update&id='.$row['id'].'">IZMJENI</a>';
	  echo ' - <a href="?a=delete&id='.$row['id'].'">IZBRISI</a>';
          echo ' - <a href="?a=tagiraj&id='.$row['id'].'">TAGIRAJ</a>';
	  echo '</p><hr>';
	}
	
}
function form(){
	// OBRAZAC SA JEDNIM TEXT POLJEM
	global $c;
	echo '<form method="post" action="?a=create">';
	echo 'Naslov: <input type="text" name="naslov"><br>';
	// PADAJUCA ZA VK_KATEGORIJE
        echo '<p>Kategorija: ';
	select('kategorije','id','naziv','kategorije');
        echo '</p>';
	echo '<br>Uvodni tekst: <br><textarea rows="10" cols="50" name="uvod"></textarea><br>';
	echo '<br>Puni tekst: <br><textarea  rows="10" cols="50" name="tekst"></textarea><br>';
	echo '<input type="submit" name="submit" value="Spremi">';
	echo '</form>';
}
function unos(){
	global $c;
	$naslov = $_POST['naslov'];
	$kategorije = $_POST['kategorije'];
	$uvod = $_POST['uvod'];
	$tekst = $_POST['tekst'];
	$objavljen = 0;
	$pogleda = 0;
	$vk_autora = $_SESSION['kid']; 
	
	
	$sql = "INSERT INTO 
			clanci(naslov,vk_kategorije, vk_autora, objavljen, 
			uvod, tekst, pogledi) 
			VALUES ('$naslov',$kategorije,$vk_autora, $objavljen,
			'$uvod', '$tekst',$pogleda)";
	$c->query($sql);
	
	echo '<a href="autori.php">Povratak</a>';
}
function izmjeni()
{	
	global $c;
	$id = $_GET['id']; // POSLANO SA PREGLEDA "?a=update&id=11"
	if(!$_POST)
	{
		$sql = "SELECT * FROM clanci WHERE id=$id";
		$r = $c->query($sql);
		$row = $r->fetch_assoc(); // Netreba while jer je samo 1 redak
		echo '<h2 style="color:red;">'.$row['kom_ur'].'</h2>';
		// OBRAZAC SA JEDNIM TEXT POLJEM (POPUNJENO POLJE)
		echo '<form method="post" action="?a=update&id='.$id.'">';
		
		echo 'Naslov: <input type="text" name="naslov" 
									value="'.$row['naslov'].'"><br>';
		// PADAJUCA ZA VK_KATEGORIJE
                echo '<p>Kategorija: ';
		preselect('kategorije','id','naziv','kategorije', 
												$row['vk_kategorije']);
                echo '</p>';
		echo '<br>Uvodni tekst: <br><textarea  rows="10" cols="50" name="uvod">'.$row['uvod'].'</textarea><br>';
		echo '<br>Puni tekst: <br><textarea  rows="10" cols="50" name="tekst">'.$row['tekst'].'</textarea><br>';
		
		echo '<input type="submit" name="submit" value="Spremi">';
		echo '</form>';
	}
	else
	{
		// UPDATE U BAZI
		$naslov = $_POST['naslov'];
		$kategorije = $_POST['kategorije'];
		$uvod = $_POST['uvod'];
		$tekst = $_POST['tekst'];
		
		$sql = "UPDATE clanci 
				SET naslov='$naslov',
					vk_kategorije = $kategorije, 
					uvod = '$uvod',
					tekst = '$tekst'  
				WHERE id=$id";
		$c->query($sql);
		echo '<a href="autori.php">Povratak</a>';
	}
}
function brisi(){
	// NEMA POTVRDE, ODMAH DELETE, NEMA OBRAZAC
	global $c;
	$id = $_GET['id'];
	$sql = "DELETE FROM clanci WHERE id=$id LIMIT 1";
	$c->query($sql);
	echo '<a href="autori.php">Povratak</a>';
}
?>
</body>
</html>

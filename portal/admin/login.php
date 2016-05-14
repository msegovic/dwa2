<?php
$username = $_POST['username'];
$pass = md5($_POST['pass']);
require_once('db.php');
$c=db();
$upit = "SELECT * FROM korisnici WHERE username='$username' AND 
		 password = '$pass' LIMIT 1";
$r = $c->query($upit);
if($r && $r->num_rows==1)
{
	session_start();
	$row = $r->fetch_assoc();
	$_SESSION['login']=$username;
	$_SESSION['tip']= $row['vk_tip'];
        $_SESSION['id_kor']=$row['id'];
	
        // UNOS U PRIJAVE
        $ip_adresa = $_SERVER['REMOTE_ADDR'];
        $id_korisnika = $row['id'];
        $upit = "INSERT INTO prijave(id_korisnika,ip_adresa) 
            VALUES($id_korisnika,'$ip_adresa')";
        $c->query($upit);
        $id_prijave = $c->insert_id;
        $_SESSION['id_prijave']=$id_prijave; 
        
	switch($row['vk_tip'])
	{
		case 1:  header("Location: autori.php"); break;
		case 2:	 header("Location: urednici.php"); break;
		case 3:  header("Location: administratori.php"); break;
		default: header("Location: index.php");
	}
	// OVDJE NIKAD NECETE DOCI
}
else 
{
	header("Location: index.php");
}
$c->close();
?>

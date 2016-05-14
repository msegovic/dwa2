<?php
    echo '<p>';
    echo '<strong>'.$clanak['naslov'].'</strong></p>';
    echo '<p>'.$clanak['uvod'].'</p>';
    echo '<p>'.$clanak['tekst'].'</p>';
    echo '<p><a href="'.$_SERVER['SCRIPT_NAME'].'">natrag...</a>';
    echo '<p>Objavljeno: '.date('d.m.Y \u H:i',strtotime($clanak['datum'])).' Pogleda:'.$row['pogledi'].'</p>';
    echo '<hr>';
    if($komentari->num_rows > 0){
        while($row = $komentari->fetch_assoc()){
            echo '<p><strong>'.$row['username'].'</strong></p>';
            echo '<p align="justify">'.$row['tekst'].'</p>';
            echo '<a href="?a=updown&id='.$row['id'].'&o=u&idc='.$clanak['id'].'"><img src="up.png"></a> '.$row['up'];
            echo '<a href="?a=updown&id='.$row['id'].'&o=d&idc='.$clanak['id'].'"><img src="down.png"></a> '.$row['down'];
            echo '<hr>';
        }
    }
       // 2. PRIKAZ OBRASCA ZA UNOS KOMENTARA
echo '<form action="?a=komentar" method="post">';
echo 'Nick: <input type="text" name="username"><br>';
echo 'Poruka:<br><textarea name="tekst"></textarea><br>';
echo '<input type="hidden" name="id" value="'.$clanak['id'].'">';
echo '<input type="submit" value="Komentiraj" name="Submit">';
echo '</form>';
?>
<?php
 while($row = $clanci->fetch_assoc())
    {
            echo '<p>';
            echo '<strong>'.$row['naslov'].'</strong></p>';
            echo '<p>'.$row['uvod'].'</p>';
            echo '<p><a href="?a=clanak&id='.$row['id'].'">više...</a>';
            echo '<p class="info">'
            . 'Objavljeno: '.$row['datum'].
                    ' - Pogleda:'.$row['pogledi'].
                    ' - Autor: '.$row['vk_autora'].'">'.$row['ime'].' '.$row['prezime'].
                    ' - Kategorija: '.$row['naziv'].'</p>';     
    }
?>

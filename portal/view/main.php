<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
    body {
        font-family: Arial;
        font-size: 12px;
    }
    p.info {
        background-color:#ccc;
        font-size: 10px;
        padding: 10px;
    }
</style>
</head>

<body>
<table width="75%" border="1" cellspacing="0" cellpadding="10">
  <tr> 
    <td colspan="3">ZAGLAVLJE</td>
  </tr>
  <tr> 
    <td width="22%" rowspan="2" valign="top">
        <p>KATEGORIJE</p>
<?php
    echo '<p><a href="'.$_SERVER['SCRIPT_NAME'].'">POČETNA</a></p>';
    while($row = $kategorije->fetch_assoc())
    {
	echo '<p>';
	echo '<a href="?a=kat&id='.$row['id'].'">'.$row['naziv'].'</a>';
	echo '</p>';
    }
?>
	  
	  </td>
          <td colspan="2" width="78%" height="41">Sortiraj po:  <a href="?a=sortiraj&kako=vrijeme">Vremenu objave (Najnoviji)</a> - <a href="?a=sortiraj&kako=pogledi">Broju pogleda (Najpopularniji)</a></td>
  </tr>
  <tr> 
    <td height="342" valign="top">
<?php
switch($view){
   case 'pregled': $ime = 'pregled'; break;
   case 'clanak': $ime = 'clanak'; break;
}
    include($ime.'.php');
?>
   </td>
   <td valign="top">TAGOVI
   <?php
   if($tagovi){
    while($row = $tagovi->fetch_assoc()){
            echo '<p><a href="?a=tagovi&id='.$row['id'].'">'.$row['naziv'].'</a></p>';
    }
   }
   ?>
   </td>
  </tr>
  <tr> 
    <td colspan="3" align="right">
        <a href="admin/">ADMINISTRACIJA</a></span>
        
    </td>
  </tr>
</table>
</body>
</html>
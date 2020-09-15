<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Premier exercice PHP</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="iniPHP.css" />
    </head>
    <body>
        <header>
            <h1>Premier exercice PHP</h1>
            <h2>Réalisé par <span class="nom">Salah Zakaria OUAICHOUCHE</span></h2>
        </header>
        <section>
            <h2>Question 1</h2>
Nous sommes le 
<?php
date_default_timezone_set("Europe/Paris"); 
echo date('l d / m / Y'); ?>
        </section>
        <section>
            <h2>Question 2</h2>
la version de PHP utilisée
<?php
echo PHP_VERSION; ?> 
<br>
la version du système d’exploitation du serveur
<?php
echo PHP_OS; ?> 
         </section>
        <section>
            <h2>Question 3</h2>

<?php
$n=3;
$texte='Bonjour'; ?>
$n vaut 
<?php
echo $n ; ?> 
<br>
$test vaut
<?php
echo $texte ; ?> 

 </section>
        <section>
            <h2>Question 4</h2>
<?php

for ($i = 1; $i <= $n; $i++){

echo  "<p>$texte</p>"; }
?>
</section>
        <section>
            <h2>Question 5.1</h2>
<?php       

function paragrapheTronque($txt,$i)
{
    return "<p>". substr($txt,0,$i)."</p>";
}
echo paragrapheTronque($texte,$n);
?>
        </section>
                <section>
            <h2>Question 5.2</h2>
<?php       


for($i=strlen($texte);$i>=0;$i--){
    echo "<p>".paragrapheTronque($texte,$i)."</p>";
}
?>
        </section>

        <section>
            <h2>Question 6</h2>
<?php       

function ulTronque($txt,$i)
{
    return "<li>". substr($txt,0,$i)."</li>";
}
 echo "<ul>";
 for($i=strlen($texte);$i>=0;$i--){
    echo ulTronque($texte,$i);
}
 echo "</ul>";
?>
</section>
 <section>
            <h2>Question 7</h2>     
<?php
function multiplication($x,$y){
    echo "<li>".$x.' * '.$y.' = '.$x*$y."</li>";}
function tableMultiplication($a){
    echo"<ul>";
echo 'Table de multiplication de '.$a.'<br>';

    for ($j = 1; $j <10; $j++){
        multiplication($a,$j);
    }
    
        
    
echo "</ul>";

}

echo tableMultiplication(2);
?>
        </section>
 <section>
            <h2>Question 8</h2>     
<?php

echo "<ul>";
for ($i = 1; $i <= 10; $i++)
{
    echo"<li><ul>";
    echo 'Table de multiplication de '.$i.'<br>';
    for ($j = 1; $j <= 10; $j++)
    {
        echo"<li>".$i.' * '.$j.' = '.$i*$j."</li>";
    }
    echo"</li></ul>";
}
?>
        </section>
         <section>
            <h2>Question 9</h2>     
<?php
echo "<table id=multiplications><tr><td>*</td>"; // table multiplication
    for($j=1;$j<10;$j++) {
        echo "<td>$j</td>"; // les indices de chaque colonne
    }
    echo "</tr>";
    for($i=1;$i<10;$i++) {
        echo "<tr><td>$i</td>"; // les indices de chaque ligne
        for($j=1;$j<10;$j++) {
            $res=$i*$j;
            echo "<td>$res</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>
        </section>
         

        </section>

    </body>
    
</html>
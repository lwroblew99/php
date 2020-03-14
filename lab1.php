
 <?php


 if(!empty($_POST['pole1']) and !empty($_POST['pole2']))
 {
  // dane pochodzące z formularza
   $pole1_1 = htmlspecialchars($_POST['pole1']);
   $pole2_2 = htmlspecialchars($_POST['pole2']);
   $pole1_1_1=str_replace("\n",'<br />',$pole1_1);
   $pole2_2_2=str_replace("\n",'<br />',$pole2_2);
   $pole1_1 = htmlspecialchars($_POST['pole1']);
   $pole2_2 = htmlspecialchars($_POST['pole2']);
   $pole1_1_1=str_replace("\n",'<br />',$pole1_1);
   $pole2_2_2=str_replace("\n",'<br />',$pole2_2);
   $data= date('Y-m-d H:i:s');
   $ip = $_SERVER['REMOTE_ADDR'];
   $dane = $pole1_1_1.",".$pole2_2_2.",".$ip.",".$data."\n";
   // przypisanie zmniennej $file nazwy pliku
   $file = "zad1.txt";
   //pobieranie danych z pliku
   $fh=file_get_contents($file);
   //nowe dane do pliku
   $dane2=$dane.$fh;
   // uchwyt pliku, otwarcie do dopisania
    $fp = fopen($file, "w");
    // blokada pliku do zapisu
   flock($fp, 1);
   // zapisanie danych do pliku
    fwrite($fp, $dane2);
    // odblokowanie pliku
   flock($fp, 2);
    // zamknięcie pliku
    fclose($fp);

      }
    ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" >
        <meta http-equiv="Pragma" content="no-cache" >
        <title>Zadanie 1></title>
        <link rel="stylesheet" type="text/css" href="zad1.css">
    </head>
    <body>
        <header>
            <h1> Zadanie 1</h1>
        </header>
        <nav>
            <a href="../" title="Strona początkowa serwisu" target="_self" >Strona początkowa serwisu</a>
            <?php for($n=1;$n<11;$n++): ?>
            <a href="../zadanie<?=$n?>/" title="Zadanie <?=$n?>" target="_self" >Zadanie <?=$n?></a>
            <?php endfor ?>
        </nav>
        <section>
            <?php
                $file = file("zad1.txt"); // wczytanie zawartości pliku do tablicy
               $counter=0;
                $czas=0;
                foreach($file as $value) // przechodzimy przez tablicę za pomocą pętli foreach
               {
                     $exp = explode(",",$value);// rozbijamy poszczególne linie na części
                    echo"<article><header><h1>".$exp[0]."</h1></header><p>".$exp[1]."</p><footer>"."IP: ".$exp[2]." Data:".$exp[3]."</footer>
                 </article>";
                    $counter++;
                    if($czas<$exp[3])
                        {
                    $czas=$exp[3];
                        }
                   }
            ?>
</section>
<section>
            <aside>
                <p>Ostatni wpis:<?php echo $czas?></p>
                <p>Liczba wpisów: <?php echo $counter ?></p>
            </aside>

            <form action="" method="post">
                <header><h2>Dodaj post</h2></header>
                <input type="text" name="pole1" placeholder="Tytuł wiadomosci" autofocus \><br />
                <textarea name="pole2" cols="100" rows="25" placeholder="Tresć wiadomosci" ></textarea><br />
                <input type="hidden" name="counter" value="" />
                <input type="hidden" name="date" value="2020-03-13" />
                <button type="submit" >Zapisz</button>
            </form>

        </section>
         <footer>
             <div align="center"> LW <?=date("Y-m-d H:i:s")?></div>
        </footer>
    </body>
</html>

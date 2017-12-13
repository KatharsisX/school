<head>
  <link rel="stylesheet" type="text/css" href="./style.css">
  <meta charset="utf-8">
</head>
<body>

<div class="blad">
    <p>
    <?php 
        
        echo $_GET['error']
    ?>
    </p>
</div>
<div class="news">
    <p>
    <?php 
        
        echo $_GET['news']
    ?>
    </p>
</div>
    
    <?php 
        include ("connect.php");
        if($result=$mysqli->query("SELECT * FROM contacts ORDER BY id")){
            if($result->num_rows>0){
                
                echo "<table>";
                echo "<tr><th>Imie</th><th>Nazwisko</th><th>Telefon</th></tr>";
                
                while($row=$result->fetch_object()){
                    $id=$row->id;
                    $format = "<tr><td style=\"display:none;\">%d</td><td>%s</td><td>%s</td><td>%s</td>
                    <td><a href=\"delete.php?id=$id\">USUN</a></td> 
                    <td><a href=\"records.php?id=$id\">EDUTUJ</a></td></tr>";
                    
                    printf($format,$row->id,$row->imie,$row->nazwisko,$row->telefon);
                      
                }
                
                echo "</table>";
                echo "<a href=\"records.php\">Dodaj Nowy Kontakt</a>";
                
                }
            }
            
        $mysqli->close();
    ?>


</body>



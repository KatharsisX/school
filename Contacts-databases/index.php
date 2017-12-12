<html>
    <head>
        <title>Baza kontaktow</title>
          <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
   <?php     
include ("db_connection.php");

        if($result=$mysqli->query("SELECT * FROM contacts ORDER BY ID")){
            if($result->num_rows>0){
                 
                echo "<table>";
                echo "<tr><th>ID</th><th>imie</th><th>nazwisko</th><th>tel</th></tr>";
                while($row=$result->fetch_object()){
                    $id=$row->ID;
                    $format = "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td>
                    <td><a href=\"delete.php?id=$id\">USUN</a></td> 
                    <td><a href=\"addmodify.php?id=$id\">EDUTUJ</a></td></tr>";
                    printf($format,$row->ID,$row->imie,$row->nazwisko,$row->tel);
                   
                   
                    
                }
               
                }
            }
             echo "</table>";
          echo "<a href=\"addmodify.php \">Dodaj nowy kontakt </a>";
    ?>
        
    </body>
</html>
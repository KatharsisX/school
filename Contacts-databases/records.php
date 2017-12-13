<?php

include ("connect.php");
$id=$_GET['id'];
function CreateForm($p_name,$p_surname,$p_phone,$error,$id){ ?>
        <head>
            <title><?php if($id!=''){echo "edytuj";}else{ echo "dodaj";} ?></title>
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
            <?php if($error!=''){echo "<div class=\"error\">".$error."</div>";} ?>
            <form action="" method="post">
                <div class="edit_form">
                    <?php if($id!='') ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <p>id=<?php echo $id; ?></p>
                    
                    <p> <label for="">Imie:</label><input type="text" name="name" value="<?php echo $p_name; ?>"/> </p>
                    <p> <label for="">Nazwisko:</label><input type="text" name="surname" value="<?php echo $p_surname; ?>"/> </p>
                    <p> <label for="">Telefon:</label><input type="text" name="phone" value="<?php echo $p_phone; ?>"/> </p>
                    <input type="submit" name="submit" value="Wyslij"/>
                </div>
            </form>
            <?php } ?>
        </body>
 
 <?php 
    
    if(isset($_GET['id'])){
        echo "Edytuj Kontakt";
        
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                
                if($result=$mysqli->query("SELECT * FROM contacts WHERE id=$id")){
                  if($result->num_rows>0){
                
                        while($row=$result->fetch_object()){
                            $name=$row->imie;
                            $surname=$row->nazwisko;
                            $phone=$row->telefon;
                            
                            CreateForm($name,$surname,$phone,NULL,$id);
                        }
                        
                        if (isset($_POST["submit"])) {
                            
                            if (ereg('^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$', $_POST['name']) && ereg('^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$', $_POST['surname']) && ereg('^[0-9 ]+$', $_POST['phone'])) {
                            
                            $name=$_POST['name'];
                            $surname=$_POST['surname'];
                            $phone=$_POST['phone'];
                            
                            $edit=$mysqli->query("UPDATE contacts SET imie='$name',  nazwisko='$surname', telefon='$phone' WHERE id='$id'") or die('Blad zapytania'); 
                            
                            
                            if ($edit) {
                                $news="Dane zostaly zaktualizowane ";
                                header("location:index.php?news=$news");
                                
                            }else{
                                $error="wypelnij poprawnie formularz";
                                 header("location:index.php?error=$error");
                                
                            }
                                
                            }else{
                                $error="wypelnij poprawnie formularz";
                                 header("location:index.php?error=$error");
                                
                            }
                            
                            // header('location:index.php');
                        }
                        
                  }
                }
            }else{
                $error="blednie przekazane id kontaktu";
                header("location:index.php?error=$error");
            }
        
        
    }else {
        echo "Utworz nowy kontakt";
        
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $error="blednie przekazane id kontaktu";
                header("location:index.php?error=$error");
            
                    
                }else{

                        CreateForm(NULL,NULL,NULL,NULL,NULL);
                        
                        if (isset($_POST["submit"]) && !empty($_POST['name']) && !empty($_POST['surname'])) {
                            
                             if (ereg('^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$', $_POST['name']) && ereg('^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$', $_POST['surname']) && ereg('^[0-9 ]+$', $_POST['phone'])) {
                                
                                $name=$_POST['name'];
                                $surname=$_POST['surname'];
                                $phone=$_POST['phone'];
                                
                                $ins = $mysqli->query("INSERT INTO contacts SET imie='$name', nazwisko='$surname', telefon='$phone'"); 
         
                                if($ins){
                                     $news="Pomyslnie dodano kontakt ";
                                header("location:index.php?news=$news");
                                    
                                } 
                                else{$error="nie udalo sie dodac kontaktu";
                                header("location:index.php?error=$error");}
                                
                               
                             }else{
                                 $error="wypelnij poprawnie formularz";
                                 header("location:index.php?error=$error");
                             }
                            
                            
                                
                            }
                            
                            // header('location:index.php');
                        }
                        
                }

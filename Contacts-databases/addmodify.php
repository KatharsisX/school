<?php

include ("db_connection.php");
$id=$_GET['id'];
function CreateForm($p_name,$p_secondname,$p_phone,$error,$id){ ?>
        <head>
            <title><?php if($id!=''){echo "edytuj";}else{ echo "dodaj";} ?></title>
            <link rel="stylesheet" type="text/css" href="./style2.css">
        </head>
        <body>
            <?php if($error!=''){echo "<div class=\"error\">".$error."</div>";} ?>
            <form action="" method="post">
                <div class="edit_form">
                    <?php if($id!='') ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <p>id=<?php echo $id; ?></p>
                    
                    <p> <label for="">Imie:</label><input type="text" name="name" value="<?php echo $p_name; ?>"/> </p>
                    <p> <label for="">Nazwisko:</label><input type="text" name="secondname" value="<?php echo $p_secondname; ?>"/> </p>
                    <p> <label for="">Telefon:</label><input type="text" name="phone" value="<?php echo $p_phone; ?>"/> </p>
                    <input type="submit" name="submit" value="Wyslij"/>
                </div>
            </form>
            <?php } ?>
        </body>
 
 <?php 
    
    if(isset($_GET['id'])){
         echo "Edytuj kontakt";
    
         if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        
              if($result=$mysqli->query("SELECT * FROM contacts WHERE id=$id")){
                 if($result->num_rows>0){
                       while($row=$result->fetch_object()){
                          $name=$row->imie;
                            $secondname=$row->nazwisko;
                           $phone=$row->tel;
                    
                            CreateForm($name, $secondname, $phone, NULL, $id);
                        }
                
                        if(isset($_POST['submit'])){
                             if (ereg('^[a-z ]+$', $_POST['name']) && ereg('^[a-z ]+$', $_POST['secondame']) && ereg('^[0-9 ]+$', $_POST['phone'])) {
                
                                 $name=$_POST['name'];
                                 $secondname=$_POST['secondname'];
                                 $phone=$_POST['phone'];
                         
                                 $edit=$mysqli->query("UPDATE contacts SET imie='$name', nazwisko='$secondname' tel='$phone' WHERE id='$id'") or die("Bledne zapytanie");
                         
                         
                                 if($edit){
                                     $msg = "Zaktualizowano dane";
                                    header("location:index.php?msg=$msg");
                                 }
                                 else{
                                  $error = "wypelnij poprawnie formularz";
                                     header("location:addmodify.php?error=$error");
                                 }
                             }
                    }
                }
            }
        }
    }
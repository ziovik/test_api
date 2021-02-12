<?php
include_once 'db.php';
 if(isset($_POST['inp_clientname']) && isset($_POST['inp_address'])  && isset($_POST['email']) && isset($_POST['created_on']) && isset($_POST['action'])){
     if($_POST['action'] == 'insert'){


         // validate
         if (empty($_POST["inp_clientname"])) {
             $nameError = "client Name is required"  ."<br>";
             print_r($nameError) ;
         } else {
             $inp_clientname = $_POST['inp_clientname'];

         }
         if (empty($_POST["created_on"])) {
             $dateError = "Date is required"  ."<br>";
             print_r($dateError) ;
         } else {
             $created_on = $_POST['created_on'];

         }

         if (empty($_POST["email"])) {
             $emailError = "Email is required"  ."<br>";
             print_r($emailError);
         } else {
             $email = $_POST['email'];
             // check if e-mail address is well-formed
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $emailError = "Invalid email format"  ."<br>";
                 print_r($emailError);
             }
         }
         if (empty($_POST["inp_address"])) {
             $addressError = "client Address is required"  ."<br>";
             print_r($addressError) ;
         } else {
             $inp_address = $_POST['inp_address'];

         }


         // check if such data already exist in database

         $query = "SELECT * FROM clients WHERE client_name='$inp_clientname' AND email='$email'";

         $rs = pg_query($con, $query) or die("Cannot execute query: $query\n");
         $count  = pg_num_rows($rs);
         if($count > 0 ){
             print_r('Data already exists');
         }else{
             $sql = "INSERT INTO clients (client_name,address,email,created_on) VALUES 
                ('$inp_clientname', '$inp_address', '$email', '$created_on')";
             $rs = pg_query($con, $sql) or die("Cannot execute insert query: $sql\n");
             if($rs){
                 print_r('Data Successfully added');
             }
         }
     }

 }

 //delete
if(isset($_POST['item_id'])) {


    $id = $_POST['item_id'];
   // print_r($id);
    //delete
    $query = "DELETE FROM accounts WHERE id='$id'";

    $rs = pg_query($con, $query) or die("Cannot execute query: $query\n");
    if($rs){
        print_r('Data Successfully deleted');
    }
//    print_r('In here');
}
// update


if(isset($_POST['inp_clientname']) && isset($_POST['item_data_id'])&& isset($_POST['inp_address'])&& isset($_POST['email']) && isset($_POST['created_on']) && isset($_POST['action'])){
    if($_POST['action'] == 'update'){
       $id = $_POST['item_data_id'];
//     echo $inp_username , $inp_password, $email,  $created_on ;
        // validate
        if (empty($_POST["inp_username"])) {
            $nameError = "User Name is required"  ."<br>";
            print_r($nameError) ;
        } else {
            $inp_username = $_POST['inp_username'];

        }
        if (empty($_POST["created_on"])) {
            $dateError = "Date is required"  ."<br>";
            print_r($dateError) ;
        } else {
            $created_on = $_POST['created_on'];

        }

        if (empty($_POST["email"])) {
            $emailError = "Email is required"  ."<br>";
            print_r($emailError);
        } else {
            $email = $_POST['email'];
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format"  ."<br>";
                print_r($emailError);
            }
        }

        if(!empty($_POST["inp_password"]) ) {
            $inp_password = $_POST["inp_password"];
            if(empty($_POST["c_password"])){
                $c_password = $inp_password;
            }else{
                $c_password = $_POST["c_password"];
            }
            if($inp_password == $c_password){
                if (strlen($_POST["inp_password"]) <= '8') {
                    $passwordError = "Your Password Must Contain At Least 8 Characters!"  ."<br>";
                    print_r($passwordError);
                }
                elseif(!preg_match("#[0-9]+#",$inp_password)) {
                    $passwordError = "Your Password Must Contain At Least 1 Number!"  ."<br>";
                    print_r($passwordError);
                }
                elseif(!preg_match("#[A-Z]+#",$inp_password)) {
                    $passwordError = "Your Password Must Contain At Least 1 Capital Letter!"  ."<br>";
                    print_r($passwordError);
                }
                elseif(!preg_match("#[a-z]+#",$inp_password)) {
                    $passwordError = "Your Password Must Contain At Least 1 Lowercase Letter!"  ."<br>";
                    print_r($passwordError);
                }
            } else {
                $c_passwordError = "Please Check You've Entered Or Confirmed Your Password!"  ."<br>";
                print_r($c_passwordError);
            }


        }else {
            $passwordError = "Please enter password   "  ."<br>";
            print_r($passwordError);
        }



        // update

        $sql = "UPDATE accounts SET
                    username = '$inp_username',
                    password = '$inp_password',
                    email    = '$email',
                    created_on = '$created_on' 
                 WHERE id =  '$id'   
              ";
        $rs = pg_query($con, $sql) or die("Cannot execute insert query: $sql\n");
        if($rs){
            print_r('Data Successfully Updated');
        }

    }

}

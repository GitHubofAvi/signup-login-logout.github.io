
<!-- this is login.php page with Remember Me functionality -->

<?php
session_start(); //ise tabhi destroy krenge jab session ko khatam krna ho// 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?> " method="post">
      <input type="email" placeholder="Enter Your email" name="email"
       value="<?php  if(isset($_COOKIE['emailcookie'])){
           echo $_COOKIE['emailcookie'];
           }?>" required><br><br>

      <input type="password" placeholder="Enter Your Password" name="password" 
      value="<?php  if(isset($_COOKIE['passwordcookie'])){
           echo $_COOKIE['passwordcookie'];}?>"required><br><br>

      <input type="checkbox" name='rememberMe'>Remember Me<br><br>
      <input type="Submit" value="Click to Login" name="submit">
    </form><br><br>
    Not have an account? <a href="signup.php">SignUp</a>
</body>
</html>

<?php
include 'connection_Email.php';

if(isset($_POST['submit'])){
    $e_mail = $_POST['email'];
    $p_assword = $_POST['password'];

    $email_search = "select * from registration where email = '$e_mail' ";
    $query = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $email_total = mysqli_fetch_assoc($query); //table me email ko fetch krna//

        $db_pass = $email_total['password']; //us email ke corresponding password ko fetch krna//

        //home page pe user ka naaam dikhane k liye 👇👇👇//
        $_SESSION['username'] = $email_total['name'];
        /* where username -> variable name and name -> name value in database
        iss username ko kahin pe bhi use kr skte hai eg. home page (home.php) pe 
        but yaad rhe home page pe  htmlentities($_SERVER['PHP_SELF']) wala content na ho
        blki iski jagah  $_SESSION['username'] ho */

         $pass_decode = password_verify($p_assword, $db_pass);
        /*$p_asword -> user ne jo password likha hai
        $db_pass -> database pe jo password entered hai(encrypted form -> password_hash)*/

        if($pass_decode){
            if (isset($_POST['rememberMe'])) {
                setcookie('emailcookie',$e_mail, time()+86400);
                setcookie('passwordcookie',$p_assword, time()+86400);
                header("location:home.php");
            }else{
                header("location:home.php");
            }
            
       
        }else{
            ?><script>alert("incorrect password");</script>
       <?php 
        }
    }else{
        ?><script>alert("invalid email");</script>
       <?php 
    }
}
?>

<?php
session_start(); //ise tabhi destroy krenge jab session ko khatam krna ho// 

ob_start(); //used as a buffer which prevent the error//
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
      <input type="text" placeholder="Enter Your name" name="name" required><br><br>
      <input type="email" placeholder="Enter Your Email" name="email" required><br><br>
      <input type="password" placeholder="Enter Your Password" name="password" required><br><br>
      <input type="password" placeholder="Confirm Your Password" name="cpassword" required><br><br>
      <input type="Submit" value="Create Account" name="submit">
    </form><br><br>
    Already have an account? <a href="login.php">Login</a>
</body>
</html>

<?php
include 'connection_Email.php';

if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($con, $_POST['name']);  
$email = mysqli_real_escape_string($con, $_POST['email']);     
$password = mysqli_real_escape_string($con, $_POST['password']);
$cPassword = mysqli_real_escape_string($con, $_POST['cpassword']);

$Epassword = password_hash($password, PASSWORD_BCRYPT); //B_CRYPT -> Blowfish cryption//
$EcPassword = password_hash($cPassword, PASSWORD_BCRYPT);

$emailquery = "select * from registration where email = '$email' ";
$equery = mysqli_query($con, $emailquery);

$emailcount = mysqli_num_rows($equery);

if ($emailcount>0) {
    ?>
    <script>alert("email already exists");</script>
    <?php

}else if($password === $cPassword){
    
    $insertquery = "insert into registration(name, email, password, cpassword) 
    values('$name','$email','$Epassword','$EcPassword')";    
    $iquery = mysqli_query($con, $insertquery);

    if($iquery){
        ?>
        <script>
            alert("data inserted succesfully✔✔✔✔");
        </script>
        <?php
    }else{
       ?>
       <script>
           alert("data is not inserted!!!");
       </script>
       <?php
    }

}else{
    ?>
    <script>alert("Password are not matching");</script>
    <?php
    }
}

?>


<?php 
$username = "root";
$password = "";
$database = "email_validation";
$server = "localhost";

$con = mysqli_connect($server,$username,$password,$database);
if($con){
    ?>
    <script>
        //alert("connection established successfully✔✔✔✔");
    </script>
    <?php
}else{
   ?>
   <script>
       die("no connection".mysqli_connect_error());
   </script>
   <?php
}

?>
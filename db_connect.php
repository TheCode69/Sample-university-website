<?php
#declare the db parameters including the host,username,password and database name
$host = "localhost";
$username = "root";
$password = "";
$database = "university";

#connect the database depending on the type of db server your using eg msqli in this casse
$conn_connect = new mysqli($host,$username,$password,$database);

#test if the connection works
if ($conn_connect -> connect_error){
    die("Connection unsuccesfull".$conn_connect -> connect_error);
}
else {
    echo "connection succesful";
}
#check if form has been submitted
if(isset($_POST["submit"])){
    #retrieve the values of the subbmitted data
    $username = $_POST["USERNAME"];
    $password = $_POST["PASSWORD"];



$result = mysqli_query($conn_connect, "SELECT * FROM users WHERE registration_number='$registration_number' AND password='$password'");
if (mysqli_num_rows($result) >= 0) {

        if ($username == "admin") {
            header("Location: index.html");
        } else {
            header("Location: portal.php");
            exit();
        }
    }
   } else {
    echo "<script>alert('Invalid username or password'); window.location.href='index.html';</script>";
}




mysqli_close($conn_connect)
?>
<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];

$course = $_POST['courseCode'];
if (!empty($username) || !empty($gender) || !empty($email) || !empty($course) || !empty($phone)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "register";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) 
    {
      die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else 
    {
    
      $SELECT = "SELECT email From  skills Where email = ? Limit 1";
      $INSERT = "INSERT Into  skills (username,email,phoneno,gender,course,due) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     switch ($course) {
			case "License" :$due = 4000;				
				break;
			case "Karate":$due = 150;
				break;
			default:
				
		}	
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();

     $stmt->bind_result($email);
     $stmt->store_result();

     $rnum = $stmt->num_rows;
     if ($rnum==0) 
     {
    
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssisssi", $username, $email, $phone, $gender, $course, $due);
      $stmt->execute();
      if( $_POST['check'] == 1){
        echo "done";
         ?> <script>window.location.href = "/userAccounts/skills/invoice.php";</script>
       <?php
       }
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     
     $stmt->close();
     $conn->close();
    }
}
 else 
{
 echo "All field are required";
 die();
}
?>
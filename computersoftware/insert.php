<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$college = $_POST['college'];
$course = $_POST['courseCode'];
if (!empty($username) || !empty($college) || !empty($gender) || !empty($email) || !empty($course) || !empty($phone)) {
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
    
      $SELECT = "SELECT email From computersoftware Where email = ? Limit 1";
      $INSERT = "INSERT Into computersoftware (username,email,phoneno,gender,college,course,due) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     switch ($course) {
			case "Basic Computer Applications" :$due = 5000;				
				break;
			case "Desktop Publishing":$due = 5000;
				
				break;
			case "Graphic Designing":$due = 8000;
				break;
			case "Visual Basic .NET" :$due = 7500;				
				break;
			case "Visual C# .NET" :$due = 7500;				
				break;
			case "Web Designing " :$due = 9000;				
				break;
			case "Accounting Program" :$due = 6000;				
				break;
			case "Advanced Computer Applications " :$due = 6000;				
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
      $stmt->bind_param("ssisssi", $username, $email, $phone, $gender, $college, $course, $due);
      $stmt->execute();
      if( $_POST['check'] == 1){
        echo "done";
         ?> <script>window.location.href = "/userAccounts/computersoftware/invoice.php";</script>
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
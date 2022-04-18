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
    
      $SELECT = "SELECT email From register Where email = ? Limit 1";
      $INSERT = "INSERT Into register (username,email,phoneno,gender,college,course,due) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     switch ($course) {
			case "ms-word and ms-excel" :$due = 3000;				
				break;
			case "Photoshop and CorelDraw":$due = 3500;
				
				break;
			case "PageMaker & Illustrator":$due = 5000;
				break;
			case "C++ Programming" :$due = 2500;				
				break;
			case "Tally Financial Accounting" :$due = 3500;				
				break;
			case "Peachtree Accounting Software" :$due = 3000;				
				break;
			case "Windows, Internet Basics, Language Typing (Kannada/Hindi) Nudi and Baraha" :$due = 2000;				
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
        ?> <script>window.location.href = "/userAccounts/computershort/invoice.php";</script>
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
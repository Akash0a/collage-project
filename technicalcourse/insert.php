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
    
      $SELECT = "SELECT email From technicalcourse Where email = ? Limit 1";
      $INSERT = "INSERT Into technicalcourse (username,email,phoneno,gender,college,course,due) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     switch ($course) {
			case "Air-Conditioning and Refrigeration " :$due = 6000;				
				break;
			case "Advanced Air-Conditioning and Refrigeration ":$due = 6500;
				
				break;
			case "Diesel Mechanic":$due = 6000;
				break;
			case "Automobile Servicing":$due = 6000;				
				break;
			case "Electrical Wiring" :$due = 6000;				
				break;
			case "Electrician " :$due = 6000;				
				break;
			case "Heavy Equipment Operator Training in Heavy Duty Mechanical & Hydraulic Crane":$due = 18000;				
				break;
			case "Plant Design Management System " :$due = 12000;				
				break;
			case "Process Piping Engineering" :$due = 12000;				
				break;
			case "Hardware & Networking Engineer" :$due = 12000;				
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
        ?> <script>window.location.href = "/userAccounts/technicalcourse/invoice.php"</script>
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
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
    
      $SELECT = "SELECT email From ladiescourse Where email = ? Limit 1";
      $INSERT = "INSERT Into ladiescourse (username,email,phoneno,gender,college,course,due) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     switch ($course) {
			case "Fashion Designing" :$due = 4000;				
				break;
			case "Advanced Fashion Designing":$due = 5000;
				
				break;
			case "Machine Embridery":$due = 4000;
				break;
			case "Garment Making,Cutting & Stitching":$due = 5000;				
				break;
			case "Fabric Printing" :$due = 1000;				
				break;
			case "Embossing":$due = 1500;				
				break;
			case "Pot Printing":$due = 600;				
				break;
			case "Ceramic Painting" :$due = 600;				
				break;
			case "Doll making":$due = 1000;				
				break;
			case "Hand Embroidery":$due = 3000;				
			break;
			case "Short Term Course Garment Making, Cutting & Stitching":$due = 1500;				
			break;
			case "Embossing":$due = 1500;				
			break;
			case "Fabric Painting":$due = 1000;				
			break;
			case "Glass Painting":$due = 1000;				
			break;
			case "Velvet Patch Work":$due = 1000;				
			break;
			case "Charcoal painting":$due = 1000;				
			break;
			case "Jarry work & jardoshi work":$due = 2000;				
			break;
			case "Creative Crafts out of Waste Materials":$due = 2000;				
			break;
			case "Artificial Jewellary Making":$due = 4000;				
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
        ?> <script>window.location.href = "/userAccounts/ladiescourse/invoice.php"</script>
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
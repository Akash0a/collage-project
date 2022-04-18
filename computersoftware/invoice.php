<!DOCTYPE html>
	<header>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
	<?php
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
		$result = mysqli_query($conn,"SELECT * FROM computersoftware ORDER BY id DESC LIMIT 1 ");
		// $result = mysqli_query($conn,$query);
		// print(mysqli_num_rows($result));
		$rows = mysqli_fetch_assoc($result);
		
	}	
	?>
	</header>
	<body>
	
	<center>
	<table class="table-bordered"style = "width:1200px">
		<caption>
			<font color='blue' size='8'> Invoice</font>
		</caption>
		<br><br>

		<tr>
			<th>Sl.No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Phone no</th>
			<th>Gender</th>
			<th>College</th>
			<th>Course Enrolled</th>
			<th>Due amount</th>
		</tr>
		
		<tr>
			<td>1</td>
			
			<td>
				<?php echo $rows['username'];?>
			</td>
			<td>
				<?php echo $rows['email'];?>
			</td>
			<td>
				<?php echo $rows['phoneno'];?>
			</td>
			<td>
				<?php echo $rows['gender'];?>
			</td>
			<td>
				<?php echo $rows['college'];?>
			</td>
			<td>
				<?php echo $rows['course'];?>
			</td>
			<td>
				<?php echo $rows['due'];?>
			</td>
		</tr>
	</table>
	<button onclick="window.print()" id="demo"class="btn-info"style="margin-top:2%;width:110px;height:50px;">Print</button>


	</center>

	</body>

	</html>

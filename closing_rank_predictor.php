<html>
	<head>
		<title>JOSAA Analysis</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>


<body class="is-preload">

	<?php

	$host = 'localhost';
	$username = 'devanshu';
	$password = 'passwords';
	$dbname = 'mydb';
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$branches = array();

	$sql1 = "SELECT DISTINCT(program) as branch FROM program";
	$result1 = $conn->query($sql1);

	$sql2 = "SELECT DISTINCT(institute) as city FROM iit";
	$result2 = $conn->query($sql2);

	$conn->close();

	$branches = array();
	$cities = array();

	if ($result1->num_rows > 0) {

		while($row = $result1->fetch_assoc()) {

			array_push($branches, $row['branch']);
		}

	} else {
		echo "0 results";
	}

	if ($result2->num_rows > 0) {

		while($row = $result2->fetch_assoc()) {

			array_push($cities, $row['city']);
		}

	} else {
		echo "0 results";
	}

	?>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="index.html" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">JOSAA DATA ANALYSIS</span>
								</a>

							<!-- Nav -->
								<!-- <nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav> -->

							<!-- Navigation Bar -->
							<nav >
								<!-- <a href="try.html"><img class="navimg" src="images/cropped.png" width=50% height=50%></a> -->
								<div style = "float:right" >
									<ul>
										<!-- dropdown -->
										<div class="dropdown">
											<button class="dropbtn"><li class="item"><p class = "pred">Predictors</p></li>
											  <i class="fa fa-caret-down"></i>
											</button>
											<div class="dropdown-content">
											  <a href="councelling_advisor.php">College Advisor</a>
											  <a href="closing_rank_predictor.php">Rank Predictor</a>
		
											</div>
										  </div>
										  <!-- dropdown -->
										<!-- <li class="item"><a href="college-advisor.php">Predictors</a></li> -->
										<li class="item"><a href="team.html">About Team</a></li>
									</ul>
								</div>
							</nav>

						</div>
					</header>

					<div class = "DIV1">
						<center>
						<h1 style="margin:0 0 0.5em 0"> Rank Predictor </h1>
						<p style="font-size:30">
				Get an estimate of the JEE rank required for your dream college and branch.
					<br> Suggestions are provided based on past 5 years data.</p>
						</center>
					</div>
		
		<div class = "DIV3">
			<form action="" method="post" class="form"> 
				<b><p class="rank" > Select Institute  </p>
                
					<select class = "dropforcp" name="institute">
						<option value="">Select</option>
						<option value="Bom">IIT Bombay </option>
						<option value="Del">IIT Delhi</option>
						<option value="Mad">IIT Madras</option>
						<option value="Bhi">IIT Bhilai</option>
						<option value="Bhu">IIT Bhubaneswar</option>
						<option value="Gan">IIT Gandhinagar</option>
						<option value="Goa">IIT Goa</option>
						<option value="Guw">IIT Guwahati</option>
						<option value="Hyd">IIT Hydrabad</option>
						<option value="Ind">IIT Indore</option>
						<option value="Jam">IIT Mandi</option>
						<option value="Jod">IIT Jodhpur</option>
						<option value="Kan">IIT Kanpur</option>
						<option value="Kha">IIT Kharagpur</option>
						<option value="Man">IIT Mandi</option>
						<option value="Pal">IIT Palakkad</option>
						<option value="Pat">IIT Patna</option>
						<option value="Roo">IIT Roorkee</option>
						<option value="Rop">IIT Ropar</option>
						<option value="Tir">IIT Tirupati</option>
						<option value="Var">IIT Varanasi</option>
							   
								</select>
								
				<p class="rank"> Select Branch  </p>
				<select class = "dropforcp" name="branch">
				<option value="">Select</option>
				<?php
					foreach($branches as $branch){
						echo"<option value='$branch'> $branch </option>";
					}
				?>
   				</select>

				<br>
				<p class="rank"> Select Category  </p>
				<select class = "dropforcp" name="cat">
				<option value="">Select</option>
				<option value="Open">Open </option>
				<option value="OBC-NCL">OBC-NCL</option>
				<option value="EWS">EWS</option>
				<option value="SC">SC</option>
				<option value="ST">ST</option>
				<option value="PWD">PWD</option>
				</select>




				<input type="submit" value="Submit" class="gap">
				<input type="reset" value="Reset" class="gap">
			</form> 
			</div>

			<div class = "cpoutput">
			<?php
				$servername = "localhost"; 
				$port_no = 3306; 
				$username = "devanshu";
				$password = "passwords";
				$myDB= "mydb";
				try{
					$conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
					if (  isset($_POST['branch']) && isset($_POST['institute']) && isset($_POST['cat']) ) {
						$stmt1 = $conn->query("SELECT I_code FROM IIT WHERE I_code = \"{$_POST['institute']}\";");
						while($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
							$i_code = $row1['I_code'];
							// echo $_POST['branch'];
						}
							
						$stmt2 = $conn->query("SELECT p_code FROM program WHERE program = \"{$_POST['branch']}\";");
						while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							$p_code = $row2['p_code'];
						}
						
												



						$stmt = $conn->query("SELECT CR FROM rank_data WHERE p_code  = \"{$p_code}\" AND I_code = \"{$i_code}\" AND seattype = \"{$_POST['cat']}\" ORDER by Year_;");
						
						$data = array();

						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							// echo $row['CR'];
							array_push($data,$row['CR']);
						}
						$period = count($data);
						// echo $period;

						$alpha = 2 / ($period + 1);
						$ema = array();
						$ema[0] = $data[0];
						for ($i = 1; $i < count($data); $i++) {
							$ema[$i] = ($alpha * $data[$i]) + ((1 - $alpha) * $ema[$i - 1]);
						}

						$predicted = (int) round($ema[count($ema)-1]);
						echo "The predicted closing rank is  $predicted";
					}

					
					}
					
					catch(PDOException $e) {
						echo "Connection failed: " . $e->getMessage();
					}
			?>
			</div>
			
		
	</div>
	
</body>

</html>





<html>
	<head>
		<title>JOSAA Analysis</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
		<link rel="stylesheet" href="assets/css/q1_1.css" />
		<link rel="stylesheet" href="assets/css/proj.css" />
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

					<div class="question">
							<h1>Comparing any Two Options</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">
							<label for="college1">Select 1st option:</label>
							<select name="college1">
								<option value="">Select college</option>
								<?php
									foreach($cities as $city){
										echo"<option value='$city'> $city </option>";
									}
								?>
							   
							</select>
						
							<select name="branch1" >
							<option value=""> Select Branch</option>
							<?php
								foreach($branches as $branch){
									echo"<option value='$branch'> $branch </option>";
								}
							?>
							</select>

							<br>

							<label for="college2">Select 2nd option:</label>
							<select name="college2">
								<option value="">Select College</option>
								<?php
									foreach($cities as $city){
										echo"<option value='$city'> $city </option>";
									}
								?>
							   
							</select>
						  
							<select name="branch2" >
							<option value=""> Select Branch</option>
							<?php
								foreach($branches as $branch){
									echo"<option value='$branch'> $branch </option>";
								}
							?>
							</select>
						
						<br>
						  
						<label for="category">Select Category:</label>
						<select name="category">
							<option value="">Select</option>
							<option value="OPEN">OPEN </option>
							<option value="OBC-NCL">OBC-NCL</option>
							<option value="EWS">EWS</option>
							<option value="SC">SC</option>
							<option value="ST">ST</option>
						</select>
							
						<br>
							<button type="submit" name="submit">Enter</button>
							</form>

				
				<div class = "chartcont">

					<?php

					$host = 'localhost';
					$username = 'devanshu';
					$password = 'passwords';
					$dbname = 'mydb';
					$conn = new mysqli($host, $username, $password, $dbname);

					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}

					if(isset($_POST['submit'])){

						$ranks = array();
						$cities = array();

						$inst1 = $_POST['college1'];
						$inst2 = $_POST['college2'];

						$branch1 = $_POST['branch1'];
						$branch2 = $_POST['branch2'];

						$cat = $_POST['category'];

						$sql1 = "SELECT C.CR as cr, C.Year_ as year, p.program as branch, i.I_code as city FROM rank_data C, program p, iit i WHERE C.I_code = i.I_code and C.P_code = p.p_code and p.program = '{$branch1}' and i.institute = '{$inst1}' and C.seattype = '{$cat}'";
						$result1 = $conn->query($sql1);

						$sql2 = "SELECT C.CR as cr, C.Year_ as year, p.program as branch, i.I_code as city FROM rank_data C, program p, iit i WHERE C.I_code = i.I_code and C.P_code = p.p_code and p.program = '{$branch2}' and i.institute = '{$inst2}' and C.seattype = '{$cat}'";
						$result2 = $conn->query($sql2);

						$conn->close();

						$array1 = $branch1.', '.$inst1;
						$array2 = $branch2.', '.$inst2;


						${$array1} = array();
						${$array2} = array();

						if ($result1->num_rows > 0) {

							while($row = $result1->fetch_assoc()) {

								${$array1}[(int)$row['year']] = $row['cr'];

							}

						} else {
							echo "0 results";
						}

						if ($result2->num_rows > 0) {

							while($row = $result2->fetch_assoc()) {

								${$array2}[(int)$row['year']] = $row['cr'];
								
							}

						} else {
							echo "0 results";
						}

						for ($x = 2018; $x <= 2022; $x++){
							if (!array_key_exists($x, ${$array1})){
								${$array1}[$x] = null;
							}
						}

						for ($x = 2018; $x <= 2022; $x++){
							if (!array_key_exists($x, ${$array2})){
								${$array2}[$x] = null;
							}
						}

						ksort(${$array1});
						ksort(${$array2});


						array_push($ranks , array_values(${$array1}) );
						array_push($ranks , array_values(${$array2}) );
						array_push($cities, $array1);
						array_push($cities, $array2);

						$ranks = json_encode($ranks);
						$cities = json_encode($cities);

						$years = array(2018, 2019, 2020, 2021, 2022);
						$years = json_encode($years);

						$cat = json_encode($cat);

						}
					?>

					<canvas class="charts" id="myChart"> </canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="scripts.js"></script>
					<script>
							const ctx = document.getElementById('myChart');

							var ranks = <?php echo $ranks ?>;
							var cities = <?php echo $cities ?>;
							var labelList = <?php echo $years ?>;
							var cat = <?php echo $cat?>;


							var hexColors = ['#FFC300', '#FF5733'];

							let dataa = [];
							
							for (let i = 0; i < cities.length; i++){

								let dict = {
									backgroundColor: hexColors[i],
                					borderColor: hexColors[i],
									label : cities[i],
									data : ranks[i],
									borderWidth: 1
								}

								dataa.push(dict);
							}

							new Chart(ctx, {
								type: 'line',
								data: {
									labels: labelList,
									datasets: dataa
								},
								options: {
									plugins: {
										title: {
											display: true,
											text: 'Comparing the Selected 2 Options Under The ' + cat + ' Category',
											font: {
												size: 25, 
												weight: 'bold'
											},
											padding: 8,
											fullSize: true,
										}
									},
									maintainAspectRatio: false,
									scales: {
									y: {
										beginAtZero: true
									}
									}
								}
							});
						</script>

				</div>
				</div>
				
				</div>
				

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
	
</body>

</html>


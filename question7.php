
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
							<h1>Jee Advanced Cutoffs </h1>
				    </div>
				
						
					
				<div style="display: flex">
					
						<form method="post" class="dropdowns">
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

							$cat = $_POST['category'];

							$sql = "SELECT MAX(CR) as rank, Year_ as year FROM rank_data WHERE seattype = '{$cat}' GROUP BY Year_";
							$result = $conn->query($sql);
						
							$conn->close();
						
							$cutoff = array();
						
							if ($result->num_rows > 0) {
						
								while($row = $result->fetch_assoc()) {
						
									$cutoff[(int)$row['year']] = $row['rank'];
						
								}
						
							} else {
								echo "0 results";
							}
						
							for($x = 2018; $x <= 2022; $x++){
						
								if(!array_key_exists($x, $cutoff)){
									$cutoff[$x] = null;
								}
						
							}
						
							ksort($cutoff);
							$cutoff = array_values($cutoff);
						
							$cutoff = json_encode($cutoff);
						
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

						var years = <?php echo $years ?>;
						var cutoff = <?php echo $cutoff ?>;

						var cat = <?php echo $cat ?>;


						new Chart(ctx, {
							type: 'line',
							data: {
								labels: years,
								datasets: [{
									label: 'Cutoff',
									data: cutoff,
									hoverOffset: 4
								}]
							},
							options: {
								plugins: {
									title: {
										display: true,
										text: 'Last Jee Advanced Rank in ' + cat + ' Category',
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


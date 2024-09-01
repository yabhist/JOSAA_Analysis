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
							<h1>Variance of ranks of Students in IITs</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">

							<label for="year">Select Year:</label>
							<select name="year">
								<option value="">Select</option>
								<option value="2022">2022 </option>
								<option value="2021">2021</option>
								<option value="2020">2020</option>
								<option value="2019">2019</option>
								<option value="2018">2018</option>
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

							$cat = $_POST['category'];
							$year = $_POST['year'];
							$sql = "SELECT MAX(C.CR) - MIN(C.OR_) as variance, I.institute as city FROM rank_data C, program P, iit I WHERE C.seattype = '{$cat}' and C.Year_ = '{$year}' and P.p_code = C.P_code and I.I_code = C.I_code GROUP BY C.I_code ORDER BY variance DESC";
							$result = $conn->query($sql);
						
							$conn->close();
						
							$cities = array();
							$variance = array();
						
							if ($result->num_rows > 0) {
						
								while($row = $result->fetch_assoc()) {
						
									array_push( $variance , (int)$row['variance'] );
									array_push( $cities , $row['city'] );
						
								}
						
							} else {
								echo "0 results";
							}
						
						
						
							$cities = json_encode($cities);
							$variance = json_encode($variance);
						
							$cat = json_encode($cat);
							$year = json_encode($year);
						

						}
					?>

					<canvas class="charts" id="myChart"> </canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="scripts.js"></script>
					<script>

						const ctx = document.getElementById('myChart');
						var cities = <?php echo $cities ?>;
						var variance = <?php echo $variance ?>;
						var cat = <?php echo $cat ?>;
						var year = <?php echo $year ?>;


						var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];

						new Chart(ctx, {
							type: 'bar',
							data: {
								labels: cities,
								datasets: [{
									label: '',
									data: variance,
									backgroundColor : hexColors,
            						borderColor: hexColors,
									hoverOffset: 4
								}]
							},
							options: {
								plugins: {
									title: {
										display: true,
										text: 'Variance of Ranks of ' + cat + ' Category in the Year ' + year,
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
				
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
	
</body>

</html>

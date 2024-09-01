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
							<h1>Distribution of Students Branchwise in Selected College</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">
						<label for="college">Select College:</label>
							<select  name="college" >
								<option value="">Select </option>
								<?php
									foreach($cities as $city){
										echo"<option value='$city'> $city </option>";
									}
								?>
							   
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

							$college = $_POST["college"];

							$sql = "SELECT DISTINCT M.total, P.program as branch FROM seat_matrix M, program P, iit I WHERE I.institute = '{$college}' and I.I_code = M.i_code and P.p_code = M.p_code";
							$result = $conn->query($sql);

							$conn->close();

							$branches = array();
							$seats = array();

							if ($result->num_rows > 0) {

								while($row = $result->fetch_assoc()) {

									array_push( $branches , $row['branch'] );
									array_push( $seats , $row['total'] );

								}

							} else {
								echo "0 results";
							}

							$branches = json_encode($branches);
							$seats = json_encode($seats);

							$college = json_encode($college);
						
						}
					?>

					<canvas class="charts" id="myChart"> </canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="scripts.js"></script>
					<script>

						const ctx = document.getElementById('myChart');
						var branches = <?php echo $branches ?>;
						var seats = <?php echo $seats ?>;
						var college = <?php echo $college ?>;

						var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];

						new Chart(ctx, {
							type: 'pie',
							data: {
								labels: branches,
								datasets: [{
									label: 'Number of Seats',
									data: seats,
									backgroundColor: hexColors,
               						borderColor: hexColors,
									hoverOffset: 4
								}]
							},
							options: {
								plugins: {
									title: {
										display: true,
										text: 'Branch Strength Distribution in ' + college,
										font: {
											size: 25, 
											weight: 'bold'
										},
										padding: 8,
										fullSize: true,
									}
								},
								maintainAspectRatio: false,
							}
						});
					</script>



				</div>
				</div>
				<div id="wrapper">

				<!-- <div class="inference">
						<h1>Inference</h1>
				</div> -->
    
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

					$sql = "SELECT SUM(total)/2 as count, P.program as branch FROM seat_matrix M, program P WHERE p.p_code = M.p_code GROUP BY M.p_code ORDER BY count DESC LIMIT 8";
					$result = $conn->query($sql);

					$conn->close();

					$branches2 = array();
					$count2 = array();

					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {

							array_push( $branches2 , $row['branch']);
							array_push( $count2 , $row['count'] );

						}


					

					} else {
						echo "0 results";
					}



					$branches2 = json_encode($branches2);
					$count2 = json_encode($count2);

				}
				?>
				<br>
				
				</div>
				</div>

				<div class = "inference">
									<h2 class = "infer">INFERENCE</h2>
									<p class = "infd"><li class = "infd">When it comes to the distribution of seats across different branches in IITs, there seems to be a clear pattern that has emerged over time. Well-established branches such as Mechanical, Computer Science and Engineering (CSE), Electrical, and Civil Engineering continue to dominate the landscape, comprising the majority of students across all IITs.</li><br>
				<li class = "infd">It's almost like these branches are the rockstars of the IIT world, with students vying for a seat in one of these popular branches. It's not hard to see why - after all, Mechanical Engineering is the backbone of manufacturing, CSE is the gateway to the world of computing, Electrical Engineering powers the world around us, and Civil Engineering shapes the very foundations of our built environment. These branches have truly stood the test of time and have cemented their presence across a greater number of IITs.</li><br>
				<li class = "infd">However, that's not to say that other branches don't have their own charm. Aerospace Engineering is the branch of choice for those who want to reach for the stars, Biotechnology is a field that holds immense promise for the future of medicine and technology, and Material Science and Engineering is all about unlocking the secrets of the materials that make up our world.</li><br>
				<li class = "infd">In the end, it's all about finding your passion and pursuing it with all your heart, regardless of which branch it belongs to. Whether you choose to ride the wave of popularity of the established branches or carve your own path in a less trodden one, the IITs offer a world of opportunities and possibilities to explore.</li><br> 
				</p>
				<div class = "chartcont2">

				<canvas class="charts" id="myChart2"> </canvas>
				<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
				<script src="scripts.js"></script>
				<script>

					const ctx2 = document.getElementById('myChart2');

					var branches2 = <?php echo $branches2 ?>;
					var count2 = <?php echo $count2 ?>;

					var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];


					new Chart(ctx2, {
						type: 'bar',
						data: {
							labels: branches2,
							datasets: [{
								label: 'Count',
								data: count2,
								backgroundColor: hexColors,
								hoverOffset: 4
							}]
						},
						options: {
							plugins: {
								title: {
									display: true,
									text: 'Branches With Highest Enrollement',
									font: {
										size: 25, 
										weight: 'bold'
									},
									padding: 8,
									fullSize: true,
								}
							},

							legend: {
								display: false
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

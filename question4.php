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
							<h1>Where do Toppers go?</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">
						<label for="rank">Select Rank:</label>
							<select name="rank">
								<option value="">Select</option>
								<option value="100">Under 100</option>
								<option value="500">Under 500 </option>
								<option value="1000">Under 1000</option>
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

						$category = $_POST['category'];
						$or = (int)$_POST['rank'];
						$cr = (int)(1.2 * $or );

						$sql = "SELECT SUM(M.`{$category}`) as seats, I.institute as city FROM seat_matrix M, rank_data C, iit I WHERE C.seattype = '{$category}' and C.CR < {$cr} and C.OR_ < {$or} and C.P_code = M.p_code and C.I_code = M.i_code and I.I_code = C.I_code and C.Year_ = 2022.0 and M.`Seat Pool` = 'Gender-Neutral' GROUP BY city ORDER BY C.CR";
						$result = $conn->query($sql);

						$conn->close();

						$cities = array();
						$seats = array();

						if ($result->num_rows > 0) {

							while($row = $result->fetch_assoc()) {

								array_push( $cities , $row['city'] );
								array_push( $seats , $row['seats'] );

							}

						} else {
							echo "0 results";
						}

						$category = json_encode($category);
						$or = json_encode($or);

						$cities = json_encode($cities);
						$seats = json_encode($seats);

						}
					?>

					<canvas class="charts" id="myChart"> </canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="scripts.js"></script>
					<script>

						const ctx = document.getElementById('myChart');

						var cities = <?php echo $cities ?>;
						var seats = <?php echo $seats ?>;
						var or = <?php echo $or ?>;
						var category = <?php echo $category ?>;

						var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];

						new Chart(ctx, {
							type: 'pie',
							data: {
								labels: cities,
								datasets: [{
									label: 'Count',
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
										text: 'Distribution Of Toppers Under ' + or + ' In ' + category + ' Category',
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
				<div class = "inference">
					<h2 class = "infer">INFERENCE</h2>
<li class = "infd">Overall, these trends suggest that certain IITs are more popular among top performers in the JEE examination, possibly due to their reputation, academic excellence, and campus culture.
It appears that students prioritize factors such as the quality of infrastructure, the surroundings of the institute, and the prevailing climate conditions over the NIRF ranks or overall institute experience when choosing an IIT.</li><br> 
<li class = "infd">This is evident in cases where institutes like IIT Guwahati are preferred over higher-ranked institutions in the NIRF rankings such as IIT Madras and IIT BHU.
Additionally, IIT Hyderabad has managed to establish itself as a prominent institute despite belonging to the category of newer IITs, and has been able to attain a good position that rivals those of older IITs.</li><br>
</li><br>
</p>
				</div>
				</div>
				

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
	
</body>

</html>

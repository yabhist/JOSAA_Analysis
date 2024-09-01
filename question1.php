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
										<!-- <li class="item"><a href="councelling_advisor.php">Predictors</a></li> -->
										<li class="item"><a href="team.html">About Team</a></li>
									</ul>
								</div>
							</nav>

						</div>
					</header>

					<div class="question">
							<h1>Branch Specific Analysis</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">
							<label for="college">Select College:</label>
							<select id="branchdrop" name="college[]" mulltiple>
							<?php
								foreach($cities as $city){
									echo"<option value='$city'> $city </option>";
								}
							?>
							   
							</select>
						  <br>
						  
						  <label for="branch">Select Branch:</label>  
							<select name="branch" >
							<option value=""> Select </option>
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

					$branch = $_POST['branch'];
					$category = $_POST['category'];

					$filter_institutes = array("Indian Institute of Technology Bombay", "Indian Institute of Technology Delhi", "Indian Institute of Technology Guwahati");
					$filter_institutes  = $_POST['college'];
					// print_r($filter_institutes);

					$filter_institutes = "'" . implode("','", $filter_institutes) . "'";

					$sql = "SELECT I.institute as city, C.CR as cr , C.YEAR_ as year FROM rank_data C, program P, iit I WHERE P.program = '{$branch}' and C.seattype = '{$category}' and I.institute in ($filter_institutes) and P.p_code = C.P_code and I.I_code = C.I_code ORDER by city, year";
					$result = $conn->query($sql);

					$conn->close();

					$cities = array();
					$ranks = array();

					if ($result->num_rows > 0) {

						while($row = $result->fetch_assoc()) {

							if ( isset( ${$row['city']} ) ){

								${$row['city']}[(int)$row['year']] = $row['cr'];

							}else{

								${$row['city']} = array();

								array_push($cities, $row['city']);

								${$row['city']}[(int)$row['year']] = $row['cr'];
					
							}
						}

					} else {
						echo "0 results";
					}

					$i = 0;

					while ($i < count($cities)){

						for ($x = 2018; $x <= 2022; $x++){
							if (!array_key_exists($x, ${$cities[$i]})){
								${$cities[$i]}[$x] = null;
							}
						}

						ksort(${$cities[$i]});

						array_push($ranks , array_values(${$cities[$i]}) );

						$i++;

					}
				
					$ranks = json_encode($ranks);
					$cities = json_encode($cities);

					$years = array(2018, 2019, 2020, 2021, 2022);
					$years = json_encode($years);

					$branch = json_encode($branch);

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
					var branch = <?php echo $branch ?>;

					var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];

					let dataa = [];

					for (let i = 0; i < cities.length; i++){
						let dict = {
							backgroundColor : hexColors[i],
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
									text: 'Closing Rank Trend for ' + branch,
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
				<div class = "inference">
<h2 class = "infer">INFERENCE</h2>
					<p class = "infd"><li class = "infd">Computer Science has been a popular stream for engineering students for several years now, and it continues to remain in high demand. This trend is reflected even in newer IITs, where Computer Science is gaining priority along with the older IITs. However, there are some exceptions to this trend, as seen in IIT Bhubaneswar and IIT Tirupati.</li><br>
<li class = "infd">We know that Electrical Engineering is the "Mother of All Branches" and Computer Science initially emerged from EEE but Electrical Engineering seems to be losing its priority in newer IITs, which began in 2016, and is stagnant in older ones.</li><br>
<li class = "infd">Similarly, Mechanical Engineering is also losing its priority, particularly in newer IITs, while remaining stagnant in older ones.</li><br>
<li class = "infd">Civil Engineering is another stream that is losing priority across the board, even in older IITs, except for IIT Bombay and IIT Delhi, where it still holds a strong position. This trend has gained momentum after 2020.</li><br>
<li class = "infd">Conclusively, we have observed that circuital branches in older IITs show very less variance in Closing Ranks but the non circuital branches have some variance due to the establishment of new IITs with circuital branches.</li>
</p>
				</div>
				</div>
				

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
	
</body>

</html>


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
										<!-- <li class="item"><a href="councelling-advisor.php">Predictors</a></li> -->
										<li class="item"><a href="team.html">About Team</a></li>
									</ul>
								</div>
							</nav>

						</div>
					</header>

					<div class="question">
							<h1>College Specific Analysis</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">
							<label for="college">Select College:</label>
							<select name="college">
								<option value="">Select</option>
								<?php
									foreach($cities as $city){
										echo"<option value='$city'> $city </option>";
									}
								?>
							   
							</select>
						  <br>
						  
						  <label for="branch[]">Select Branch:</label>  
							<select id="branchdrop" name="branch[]" multiple>
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
							<option value="Open">Open </option>
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

						$city = $_POST['college'];

						$filter_branches = $_POST['branch'];
						$category = $_POST['category'];
						$filter_branches = "'" . implode("','", $filter_branches) . "'";

						$sql = "SELECT P.program as branch, C.CR as cr , C.YEAR_ as year FROM rank_data C, program P, iit I WHERE I.institute = '{$city}' and C.seattype = '{$category}' and P.program in ($filter_branches) and P.p_code = C.P_code and I.I_code = C.I_code ORDER by branch, year";
						$result = $conn->query($sql);

						$conn->close();

						$branches = array();
						$ranks = array();

						if ($result->num_rows > 0) {

							while($row = $result->fetch_assoc()) {

								if ( isset( ${$row['branch']} ) ){

									${$row['branch']}[(int)$row['year']] = $row['cr'];

								}else{

									${$row['branch']} = array();

									array_push($branches, $row['branch']);

									${$row['branch']}[(int)$row['year']] = $row['cr'];
						
								}
							}

						} else {
							echo "0 results";
						}

						$i = 0;

						while ($i < count($branches)){

							for ($x = 2018; $x <= 2022; $x++){
								if (!array_key_exists($x, ${$branches[$i]})){
									${$branches[$i]}[$x] = null;
								}
							}

							ksort(${$branches[$i]});

							array_push($ranks , array_values(${$branches[$i]}) );

							$i++;

						}

						$city = json_encode($city);

						$ranks = json_encode($ranks);
						$branches = json_encode($branches);

						$years = array(2018, 2019, 2020, 2021, 2022);
						$years = json_encode($years);


					}

				?>

				

					<canvas class="charts" id="myChart"> </canvas>
					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
					<script src="scripts.js"></script>
					<script>
					const ctx = document.getElementById('myChart');

					var ranks = <?php echo $ranks ?>;
					var branches = <?php echo $branches ?>;
					var labelList = <?php echo $years ?>;
					var city = <?php echo $city ?>;

					var hexColors = ['#FFC300', '#FF5733', '#C70039', '#900C3F', '#581845', '#008000', '#6B8E23', '#ADD8E6', '#87CEFA', '#1E90FF', '#8A2BE2', '#FF1493', '#FFD700', '#FF8C00', '#FF69B4', '#FFA07A', '#00BFFF', '#20B2AA', '#4B0082', '#BA55D3', '#7B68EE', '#00FFFF', '#FF00FF'];

					let dataa = [];

					for (let i = 0; i < branches.length; i++){
						let dict = {
							backgroundColor : hexColors[i],
            				borderColor: hexColors[i],
							label : branches[i],
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
									text: 'Closing Rank Trend in ' + city,
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
					<p class = "infd"><li class = "infd">Did you know that there is a notable difference in the gap between the opening and closing ranks of branches in older and newer Indian Institutes of Technology (IITs)? In fact, the gap in the older IITs is about 10 times less than that of newer IITs. This means that the competition for admission to a particular branch in older IITs is much more intense than in newer ones.</li><br>
					<li class = "infd">Based on the given data, it can be inferred that IIT Bombay, IIT Delhi, IIT Kanpur, IIT Kharagpur, IIT Roorkee, IIT Madras, and IIT Hyderabad are some of the most popular choices among top performers in various categories in the JEE examination.</li><br>
					<li class = "infd">It appears that students prioritize factors such as the quality of infrastructure, the surroundings of the institute, and the prevailing climate conditions over the NIRF ranks or overall institute experience when choosing an IIT. This is evident in cases where institutes like IIT Guwahati are preferred over higher-ranked institutions in the NIRF rankings such as IIT Madras and IIT BHU.</li><br>
					<li class = "infd">Additionally, IIT Hyderabad has managed to establish itself as a prominent institute despite belonging to the category of newer IITs, and has been able to attain a good position that rivals those of older IITs.</li><br>
					</p>
				</div>
				</div>

		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
	
</body>

</html>


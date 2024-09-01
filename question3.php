<html>
	<head>
		<title>JOSAA Analysis</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
		<link rel="stylesheet" href="assets/css/q1_1.css" />
		<link rel="stylesheet" href="assets/css/proj.css" />
		<!-- <link rel="stylesheet" href="assets/css/main.css" /> -->
		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
		<script src="assets/js/drop.js"></script>
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
										<!-- <li class="item"><a href="councelling-advisor.php">Predictors</a></li> -->
										<li class="item"><a href="team.html">About Team</a></li>
									</ul>
								</div>
							</nav>

						</div>
					</header>

					<div class="question">
							<h1>Effect of AI related Branches on other Circuital branches</h1>
				    </div>
				
						
					

					<div style="display: flex">
						<form method="post" class="dropdowns">

                        

							<label for="college">Select College:</label>
							<select name="college">
								<option value="">Select</option>
								<option value="Indian Institute of Technology Kanpur">IIT Kanpur</option>
                                <option value="Indian Institute of Technology Bhilai">IIT Bhilai</option>
                                <option value="Indian Institute of Technology Guwahati">IIT Guwahati</option>
                                <option value="Indian Institute of Technology Roorkee">IIT Roorkee</option>
                                <option value="Indian Institute of Technology Mandi">IIT Mandi</option>
                                <option value="Indian Institute of Technology Palakkad">IIT Palakkad</option>
                                <option value="Indian Institute of Technology Jodhpur">IIT Jodhpur</option>
                                <option value="Indian Institute of Technology Patna">IIT Patna</option>
                                <option value="Indian Institute of Technology Hyderabad">IIT Hydrabad</option>
							   
							</select>
						  <br>
						  
                          <label for="branch[]">Select Branch:</label>  
							<select id="branchdrop" name="branch[]" multiple>
							<option value="Computer Science and Engineering (4 Years, Bachelor of Technology)">Computer Science and Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Computer Science and Engineering (5 Years, Bachelor and Master of Technology (Dual Degree))">Computer Science and Engineering (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical and Electronics Engineering (4 Years, Bachelor of Technology)">Electrical and Electronics Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electrical Engineering (4 Years, Bachelor of Technology)">Electrical Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electrical Engineering (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical Engineering (IC Design and Technology) (4 Years, Bachelor of Technology)">Electrical Engineering (IC Design and Technology) (4 Years, Bachelor of Technology)</option>
							<option value="Electrical Engineering (Power and Automation) (4 Years, Bachelor of Technology)">Electrical Engineering (Power and Automation) (4 Years, Bachelor of Technology)</option>
							<option value="Electrical Engineering and M.Tech Power Electronics and Drives (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering and M.Tech Power Electronics and Drives (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical Engineering with M.Tech. in any of the listed specializations (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering with M.Tech. in any of the listed specializations (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical Engineering with M.Tech. in Communications and Signal Processing (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering with M.Tech. in Communications and Signal Processing (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical Engineering with M.Tech. in Microelectronics (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering with M.Tech. in Microelectronics (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electrical Engineering with M.Tech. in Power Electronics (5 Years, Bachelor and Master of Technology (Dual Degree))">Electrical Engineering with M.Tech. in Power Electronics (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electronics and Communication Engineering (4 Years, Bachelor of Technology)">Electronics and Communication Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electronics and Electrical Communication Engineering (4 Years, Bachelor of Technology)">Electronics and Electrical Communication Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electronics and Electrical Communication Engineering with M.Tech. in any of the listed specializations (5 Years, Bachelor and Master of Technology (Dual Degree))">Electronics and Electrical Communication Engineering with M.Tech. in any of the listed specializations (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Electronics and Electrical Engineering (4 Years, Bachelor of Technology)">Electronics and Electrical Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electronics and Instrumentation Engineering (4 Years, Bachelor of Technology)">Electronics and Instrumentation Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Electronics Engineering (4 Years, Bachelor of Technology)">Electronics Engineering (4 Years, Bachelor of Technology)</option>
							<option value="Mathematics & Computing (5 Years, Bachelor of Science and Master of Science (Dual Degree))">Mathematics & Computing (5 Years, Bachelor of Science and Master of Science (Dual Degree))</option>
							<option value="Mathematics and Computing (4 Years, Bachelor of Science)">Mathematics and Computing (4 Years, Bachelor of Science)</option>
							<option value="Mathematics and Computing (4 Years, Bachelor of Technology)">Mathematics and Computing (4 Years, Bachelor of Technology)</option>
							<option value="Mathematics and Computing (5 Years, Bachelor and Master of Technology (Dual Degree))">Mathematics and Computing (5 Years, Bachelor and Master of Technology (Dual Degree))</option>
							<option value="Mathematics and Computing (5 Years, Integrated Master of Science)">Mathematics and Computing (5 Years, Integrated Master of Science)</option>
							<option value="Mathematics and Computing (5 Years, Integrated Master of Technology)">Mathematics and Computing (5 Years, Integrated Master of Technology)</option>
							<option value="Mathematics and Scientific Computing (4 Years, Bachelor of Science)">Mathematics and Scientific Computing (4 Years, Bachelor of Science)</option>
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
                        array_push($filter_branches, "Statistics and Data Science (4 Years, Bachelor of Science)", "Data Science and Artificial Intelligence (4 Years, Bachelor of Technology)", "Data Science and Engineering (4 Years, Bachelor of Technology)", "Artificial Intelligence and Data Science (4 Years, Bachelor of Technology)", "Artificial Intelligence (4 Years, Bachelor of Technology)");
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
									text: 'Effect of New Branches in ' + city,
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

<div class = "inference">
					<h2 class = "infer">INFERENCE</h2>
					<p class = "infd"><li class = "infd">Data Science and Artificial Intelligence is a new and trending branch that has been introduced in the recent times in IITs.
</li><br>
					<li class = "infd">Due to the addition of DSAI, it has been observed that changes have occurred in the closing ranks of Mathematics and Electrical branches. However, there was not much effect on the closing rank of Computer Science branch.
</li><br>
					<li class = "infd">These Branches seem to be a priority for students who plan to take circuit-based branches in IITs.
</li><br>
					<li class = "infd">However, as theses branches are pretty new, it is difficult to show a particular trend in the closing rank of the branch.
</li><br>
</p>
				</div>
				</div>
	
</body>

</html>

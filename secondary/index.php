<?php
	include ('includes/functions.php');
	$allsubjects = selectALl();
       // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","secondary");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
   
	$stmt = "SELECT * FROM `presult` WHERE st_id = st_id";
	$result   = mysqli_query($con, $stmt);



	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondary Result</title>
	<link rel="stylesheet" href="./css/styles.css"/>
	<link rel="stylesheet" href="/fags/primary/css/all.css"/>
	<link rel="stylesheet" href="/fags/primary/css/font-awesome.css"/>
   <?php include ('theme/header-script.php');?>

</head>
<body>
    <div class="container">
                                        <section id="section-2">
											<div class="st-results">
                                                <div class="result-header">
                                                    <div class="school-logo"><!-----School Logo---->
                                                        <img src="images/fagslogo1.png" alt="school logo">
                                                    </div>

                                                    <div class="header-details">
                                                        <h2>freedom assembly group of schools</h2>
                                                        <p class="sch-address"><i class="fa fa-map-marker"></i>21 Adesuwa Grammar School Road, G.R.A, P.O.Box 6677,
                                                            Benin City, Edo State, Nigeria.
                                                        </p>
                                                        <p class="tel-phone"><i class="fa fa-phone"></i>08090819546, 07053483232, 08073989402 &nbsp;
                                                            <i class="fa fa-envelope"></i>fgsh@yahoo.com
                                                        </p>
                                                        <p class="term">2020-2021, first term (termly examination result)</p>
                                                    </div>
                                                    
                                                    <div class="nigeria-logo"> <!-----Nigeria Logo---->
                                                        <img src="images/nigeria-logo.jpeg" alt="nigeria logo">
                                                    </div>
                                                    
                                            	</div>
	<center>
		<div class="container">
			<form action="" method="POST">
				<input type="text" name="st_id" placeholder="Search by student ID">
				<input type="submit" name="search" value="SEARCH ID">
			</form>

			
		</div>
	</center>
                                                <div class="result-upbody">
                                                    <div class="student-table">
                                                        <table class="result-table table-hover">
														
															<?php
																if(isset($_POST['search'])) {
																	$st_id = $_POST['st_id'];
																	$query = "SELECT * FROM presult WHERE st_id = $st_id";
																	$query_run = mysqli_query($con, $query);

																	$row = mysqli_fetch_array($query_run)
																		?>
																		<thead>
																			<tr>
																			<th class="st-head">Name</th>
																			<td class="st-b"><?php echo $row['st_name'] ?></td>
																			</tr>
																			
																			<tr>
																			<th class="st-head">Gender</th>
																			<td class="st-b"><?php echo $row['st_gender'] ?></td>
																			</tr>
																			
																			<tr>
																			<th class="st-head">Class</th>
																			<td class="st-b"><?php echo $row['class_name'] ?></td>
																			</tr>
																			
																			<tr>
																			<th class="st-head">Admission Number</th>
																			<td class="st-b">FAGS/SEC/2020/<?php echo $row['st_id'] ?></td>
																			</tr>
																		</thead>
																		<?php
																	

																}
															?>
																
															
                                                        </table>
                                                    </div>
												<!----
                                                    <div class="student-image">
                                                        
                                                        <img src="images/admin.jpg" alt="">
                                                       
													</div>
													
												----->


                                                    <div class="student-table">
														
                                                    	<table class="result-table table-hover">

														<?php
															error_reporting(0);
															if(isset($_POST['search'])) {
																$st_id = $_POST['st_id'];
																$query = "SELECT * FROM presult WHERE st_id = $st_id";
																$query_run = mysqli_query($con, $query);

																$count = 0;
																$grand_total = '';
																while($row = mysqli_fetch_array($query_run)){
																	$total = $row['first_test'] + $row['second_test'] + $row['assessment'] + $row['exam'];
																	$grand_total += $total;
																	$count++;
																	
																	
																	
																	?>

																	<?php
																}
															}
																$average = $grand_total/$count;
																$remark = $average;
																$comment = $remark
														?>
																													
															<thead>
                                                                <tr>
                                                                    <th class="st-head">Position</th>
                                                                    <td><sup></sup></td>
                                                                </tr>

                                                                <tr>
                                                                    <th class="st-head">Grand Total Score</th>
                                                                    <td><?php echo ceil($grand_total) ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <th class="st-head">Average Total Schore (%)</th>
                                                                    <td><?php echo ceil($average) ?>%</td>
                                                                </tr>

                                                                <tr>
                                                                    <th class="st-head">Result Summary</th>
                                                                    <td>
																		<?php
																			if($remark < 39){
																				echo "Fail";
																			}elseif($remark >= 39 && $remark <= 44){
																				echo "Fair";
																			}elseif($remark >= 44 && $remark <= 49){
																				echo "Pass";
																			}elseif($remark >= 49 && $remark <= 59){
																				echo "Good";
																			}elseif($remark >= 59 && $remark <= 69){
																				echo "Very Good";
																			}elseif($remark >= 69 && $remark <= 100){
																				echo "Excellent";
																			}else{
																				echo "Enter grade";
																			}
																		?>
																	</td>
                                                                </tr>
                                                            </thead>

                                                            
                                                        </table>
                                                    </div>
                                                </div>
												
												<div class="result-body">
													<table class="result-table table-hover">
														
																													
																<thead>
																<tr>
																<th>#</th>
																<th>Subject</th> 
																<th>1st Test</th> 
																<th>2nd Test</th>
																<th>Assessment</th>
																<th>Exam</th>
																<th>Total Score</th>
																<th>Grade</th>
																<!---<th>Subject Position</th>--->
																<th>Result Remark</th>
															</tr>

															<tr class="mark-obtainable">
																<th colspan="2">Marks Obtainable</th>
																
																<th>10</th> 
																<th>10</th>
																<th>10</th>
																<th>70</th>
																<th>100</th>
																<th></th>
																<th></th>
																
															</tr>
														</thead>

														<?php
															if(isset($_POST['search'])){
																$st_id = $_POST['st_id'];
																$query = "SELECT * FROM presult WHERE st_id = $st_id";
																$query_run = mysqli_query($con, $query);

																$r_id = 0;

																while($row = mysqli_fetch_array($query_run)) {
																	$total = $row['first_test'] + $row['second_test'] + $row['assessment'] + $row['exam'];
																	$grade = $total;
																	
																	$r_id ++;																	
																	
																	?>
																	
																<tbody>
																<tr>
																<td><?php echo $r_id ?></td>
																	<td><?php echo $row['subject_name'] ?></td>

																	<td align="center"><?php echo $row['first_test'] ?></td>
																	<td align="center"><?php echo $row['second_test'] ?></td>
																	<td align="center"><?php echo $row['assessment'] ?></td>
																	<td align="center"><?php echo $row['exam'] ?></td>

																	<td align="center" class="grand"><?php echo ceil($total)?></td>
																<td align="center">
																	<?php  if($grade < 39){
																	echo "F";
																}elseif($grade >= 39 && $grade <= 44){
																	echo "E";
																}elseif($grade >= 44 && $grade <= 49){
																	echo "D";
																}elseif($grade >= 49 && $grade <= 59){
																	echo "C";
																}elseif($grade >= 59 && $grade <= 69){
																	echo "B";
																}elseif($grade >= 69 && $grade <= 100){
																	echo "A";
																}else{
																	echo "Enter grade";
																}?>
																</td>
																<!---<td align="center">5<sup>th</sup></td>--->
																<td align="center">
																<?php
																if($grade < 39){
																	echo "Fail";
																}elseif($grade >= 39 && $grade <= 44){
																	echo "Fair";
																}elseif($grade >= 44 && $grade <= 49){
																	echo "Pass";
																}elseif($grade >= 49 && $grade <= 59){
																	echo "Good";
																}elseif($grade >= 59 && $grade <= 69){
																	echo "Very Good";
																}elseif($grade >= 69 && $grade <= 100){
																	echo "Excellent";
																}else{
																	echo "Enter grade";
																}
																?></td>
																
																</tr>
																
																</tbody>
																	<?php
																}
															}
														?>
														

														
													
													</table>
												</div>
                                            <!----
												<div class="result-bottom">
													<div class="key-grades">
														<h3>Key To Grades</h3>
														<p>70&nbsp; - &nbsp;100 &nbsp;= &nbsp;A &nbsp;&nbsp;| &nbsp;Excellent</p>
														<p>60&nbsp; - &nbsp;69 &nbsp;&nbsp;= &nbsp;B &nbsp;&nbsp;| &nbsp;Very Good</p>
														<p>50&nbsp; - &nbsp;59 &nbsp;&nbsp;= &nbsp;C &nbsp;&nbsp;| &nbsp;Good</p>
														<p>45&nbsp; - &nbsp;49 &nbsp;&nbsp;= &nbsp;D &nbsp;&nbsp;| &nbsp;Pass</p>
														<p>40&nbsp; - &nbsp;44 &nbsp;&nbsp;= &nbsp;E &nbsp;&nbsp;| &nbsp;Fair</p>
														<p>0&nbsp; - &nbsp;&nbsp;39 &nbsp;&nbsp;= &nbsp;F &nbsp;&nbsp;| &nbsp;Fail</p>
													</div>
                                                
													<div class="grades-bar-chart">
														<h3>Grade Assessment Summary</h3>
                                                    </div>
                                                   
												</div>
                                             ---->
												<div class="result-footer">
													<div class="result-footer-content">
                                                        <div class="remark-key">
                                                            <div class="remark">
                                                                <div class="form-teacher-comment">
                                                                    <p>Form Teacher's Comment:
                                                                        <input type="text" class="remark-input">
                                                                    </p>
                                                                </div>
                                                                
                                                                <div class="teacher-signature">
                                                                    <p class="teacher-sig">Form Teacher's Name: &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="text" class="remark-input">
                                                                    </p>
                                                                    <p class="teacher-name">Form Teacher's Signature:
                                                                        <input type="text" class="remark-input">
                                                                    </p>
                                                                </div>

                                                                <div class="form-teacher-comment">
																<?php
																	function comment($comment){

																	
																			if($comment < 39){
																				echo "Very poor performance. You need to sit up next term";
																			}elseif($comment >= 39 && $comment <= 44){
																				echo "Fair performance. You need to sit up seriously next term";
																			}elseif($comment >= 44 && $comment <= 49){
																				echo "There is a need for serious improvement";
																			}elseif($comment >= 49 && $comment <= 59){
																				echo "Good performance but you need to work harder";
																			}elseif($comment >= 59 && $comment <= 69){
																				echo "A good performance. There is room for more improvement";
																			}elseif($comment >= 69 && $comment <= 100){
																				echo "An excellent performance keep it up";
																			}else{
																				echo "Enter grade";
																			}
																		}

																		?>
                                                                    <p>Principal's Comment: &nbsp;&nbsp;&nbsp;
																		<input type="text" class="remark-input principal-comment" style="font-weight: bold; padding-left: 20px; font-size: 12px;" value="<?php echo comment($comment) ?>">
                                                                    </p>
                                                                </div>

                                                                <div class="teacher-signature principal">
                                                                    <p class="teacher-sig">Principal's Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="text" class="remark-input principal-name" style="font-size: 13px;" value="Pst. Mrs. Josephine Iyamu">
                                                                    </p>
                                                                    <p class="signature">Principal's Signature:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<input type="text" style="background-color: transparent;" class="remark-input">
                                                                    </p>
																</div>
																<div class="sig-coment">
																	<img src="images/pr.png" alt="">
																</div>
                                                            </div>
                                                            <div class="key-grades">
                                                                <h3>Key To Grades</h3>
                                                                <p>70&nbsp; - &nbsp;100 &nbsp;= &nbsp;A &nbsp;&nbsp;| &nbsp;Excellent</p>
                                                                <p>60&nbsp; - &nbsp;69 &nbsp;&nbsp;= &nbsp;B &nbsp;&nbsp;| &nbsp;Very Good</p>
                                                                <p>50&nbsp; - &nbsp;59 &nbsp;&nbsp;= &nbsp;C &nbsp;&nbsp;| &nbsp;Good</p>
                                                                <p>45&nbsp; - &nbsp;49 &nbsp;&nbsp;= &nbsp;D &nbsp;&nbsp;| &nbsp;Pass</p>
                                                                <p>40&nbsp; - &nbsp;44 &nbsp;&nbsp;= &nbsp;E &nbsp;&nbsp;| &nbsp;Fair</p>
                                                                <p>0&nbsp; - &nbsp;&nbsp;39 &nbsp;&nbsp;= &nbsp;F &nbsp;&nbsp;| &nbsp;Fail</p>
                                                            </div>
                                                        </div>
                                                        
														<div class="designBy">
															<p>Powered By <a href="www.mmcstudio.com">MMC Studio</a> and Developed By<span>Theophilus Menor</span></p>
														</div>
                                                    </div>
                                        
												</div>

											</div>
											<div class="mediabox">

											</div>
											<div class="mediabox">

												
											</div>
                                        </section>

    </div>

    
	<?php include ('theme/footer-script.php');?>
	
</body>
</html>
<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","nursery");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result1 = $con->query("SELECT class_name FROM class");
    $result3 = $con->query("SELECT st_name FROM student");
    $result4 = $con->query("SELECT st_gender FROM student");
    $result5 = $con->query("SELECT section_name FROM section");
    $result6 = $con->query("SELECT st_id FROM student");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create Primary Result</title>
    <link rel="stylesheet" href="./css/style.css"/>
</head>
<body>
<?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $st_id = stripslashes($_REQUEST['st_id']);
        //escapes special characters in a string
        $st_id = mysqli_real_escape_string($con, $st_id);
        $st_name    = stripslashes($_REQUEST['st_name']);
        $st_name     = mysqli_real_escape_string($con, $st_name);
        $st_gender    = stripslashes($_REQUEST['st_gender']);
        $st_gender     = mysqli_real_escape_string($con, $st_gender);
        $class_name    = stripslashes($_REQUEST['class_name']);
        $class_name     = mysqli_real_escape_string($con, $class_name);
        $section_name    = stripslashes($_REQUEST['section_name']);
        $section_name     = mysqli_real_escape_string($con, $section_name);
        $subject_name    = stripslashes($_REQUEST['subject_name']);
        $subject_name     = mysqli_real_escape_string($con, $subject_name);
        $first_test = stripslashes($_REQUEST['first_test']);
        $first_test = mysqli_real_escape_string($con, $first_test);
        $second_test = stripslashes($_REQUEST['second_test']);
        $second_test = mysqli_real_escape_string($con, $second_test);
        $assessment = stripslashes($_REQUEST['assessment']);
        $assessment = mysqli_real_escape_string($con, $assessment);
        $exam = stripslashes($_REQUEST['exam']);
        $exam = mysqli_real_escape_string($con, $exam);


       

        $query    = "INSERT into `presult` (st_id, st_name, st_gender, class_name, section_name, subject_name, first_test, second_test, assessment, exam)
                     VALUES ('$st_id', '" . ($st_name) . "', '$st_gender', '$class_name', '$section_name', '$subject_name', '$first_test', '$second_test', '$assessment', '$exam')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You have successfully add a student score.</h3><br/>
                  <p class='link'>Click here to <a href='create_presult.php'>add another record</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='create_presult.php'>fill again</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Fill in Student Subject and Score</h1>
            <label for="st_id">Student id</label>
                <select name="st_id" class="form-control login-input2" id="st_id">
                    <?php 
                        echo "<option>Select student id..</option>";
                        while($rows = $result6->fetch_assoc()){
                            $st_id = $rows['st_id'];
                            echo "<option value='$st_id'>$st_id</option>";
                        }

                    ?>
                </select>
            <br>

            <label for="st_name">Student Name</label>
                <select name="st_name" id="st_name" class="form-control login-input2" id="st_name">
                    <?php 
                        echo "<option>Select student name..</option>";
                        while($rows = $result3->fetch_assoc()){
                            $st_name = $rows['st_name'];
                            echo "<option value='$st_name'>$st_name </option>";
                        }

                    ?>
                </select>
            <br>

            <label for="first_test">Gender</label>
            <select name="st_gender" class="form-control login-input2" id="st_gender">
                    <?php 
                        echo "<option>Select student gender..</option>";
                        while($rows = $result4->fetch_assoc()){
                            $st_gender = $rows['st_gender'];
                            echo "<option value='$st_gender'>$st_gender </option>";
                        }

                    ?>
            </select>
            <br>

            <label for="class_name">Class</label>
                <select name="class_name" id="class_name" class="login-input2" id="class_name">
                    <?php 
                        echo "<option>Select class..</option>";
                        while($rows = $result1->fetch_assoc()){
                            $class_name = $rows['class_name'];
                            echo "<option value='$class_name'>$class_name</option>";
                        }

                    ?>
                </select>
            <br>

            <label for="class_name">Section</label>
                <select name="section_name" class="login-input2" id="section_name">
                    <?php 
                        echo "<option>Select section.</option>";
                        while($rows = $result5->fetch_assoc()){
                            $section_name = $rows['section_name'];
                            echo "<option value='$section_name'>$section_name</option>";
                        }

                    ?>
                </select>
            <br>

            <label for="subject">Subject</label>
            <input type="text" name="subject_name" class="login-input" id="subject_name" class="form-control" value="">
            <br>

            

            <label for="first_test">First Test Score</label>
            <input type="text" name="first_test" class="login-input" id="first_test" class="form-control" value="">
            <br>

            <label for="second_test">Second Test Score</label>
            <input type="text" name="second_test" class="login-input" id="second_test" class="form-control" value="">
            <br>

            <label for="exam">Assessment</label>
            <input type="text" name="assessment" id="assessment" class="login-input" class="form-control" value="">
            <br>

            <label for="exam">Exam Score</label>
            <input type="text" name="exam" class="login-input" id="exam" class="form-control" value="">
            <br>

            
            <input type="submit" name="submit" value="Insert Record" class="login-button">
    </form>
<?php
    }
?>

<script>
    $(document).ready(function(){
        $('#class_name').change(function(){
            var class_id = $(this).val();
            $.ajax({
                url:"create_presult.php",
                method:"POST",
                data:{class_id:class_id},
                dataType:"text",
                success:function(data){
                    $('#st_name').html(data);
                }
            });
        });
    });
</script>
</body>
</html>
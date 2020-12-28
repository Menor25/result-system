<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","primary");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = $con->query("SELECT st_name FROM student");
    $result1 = $con->query("SELECT class_name FROM class");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create Student Result</title>
    <link rel="stylesheet" href="./css/style.css"/>
</head>
<body>
<?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['submit'])) {
        // removes backslashes
        $st_name = stripslashes($_REQUEST['st_name']);
        //escapes special characters in a string
        $st_name = mysqli_real_escape_string($con, $st_name);
        $st_gender    = stripslashes($_REQUEST['st_gender']);
        $st_gender    = mysqli_real_escape_string($con, $st_gender);
        $class_name = stripslashes($_REQUEST['class_name']);
        $class_name = mysqli_real_escape_string($con, $class_name);

        $subject_name = stripslashes($_REQUEST['subject_name']);
        $subject_name = mysqli_real_escape_string($con, $subject_name);
        $first_test = stripslashes($_REQUEST['	first_test']);
        $first_test = mysqli_real_escape_string($con, $first_test);
        $second_test = stripslashes($_REQUEST['second_test']);
        $second_test = mysqli_real_escape_string($con, $second_test);
        $exam = stripslashes($_REQUEST['exam']);
        $exam = mysqli_real_escape_string($con, $exam);
        $exam_term = stripslashes($_REQUEST['exam_term']);
        $exam_term = mysqli_real_escape_string($con, $exam_term);
        $sch_session = stripslashes($_REQUEST['sch_session']);
        $sch_session = mysqli_real_escape_string($con, $sch_session);
        $created = date("Y-m-d H:i:s");
        $st_image = stripslashes($_REQUEST['st_image']);


       

        $query    = "INSERT into `scores` (st_name, st_gender, class_name, subject_name, first_test, second_test, exam, exam_term, sch_session, created, st_image)
                     VALUES ('$st_name', '" . ($st_gender) . "', '$class_name', '$subject_name', '$first_test', '$second_test', '$exam', '$exam_term', '$sch_session', '$created', '$st_image')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You have successfully add a record.</h3><br/>
                  <p class='link'>Click here to <a href='create_result.php'>add another record</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='create_result.php'>fill again</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Fill Student Details</h1>
            <label for="st_name">Student Name</label>
                <select name="st_name" class="form-control login-input" id="st_name">
                    <?php 
                        echo "<option>Select student name..</option>";
                        while($rows = $result->fetch_assoc()){
                            $st_name = $rows['st_name'];
                            echo "<option value='st_name'>$st_name </option>";
                        }

                    ?>
                </select>
            <br>

            <label for="gender">Gender</label>
            <input type="text" name="st_gender" class="login-input" id="st_gender" class="form-control" value="">
            <br>

            <label for="class_name">Class</label>
                <select name="class_name" class="login-input" id="class_name">
                    <?php 
                        echo "<option>Select class..</option>";
                        while($rows = $result->fetch_assoc()){
                            $class_name = $rows['class_name'];
                            echo "<option value='class_name'>$class_name </option>";
                        }

                    ?>
                </select>
            <br>

            <label for="subject_name">Subject</label>
            <input type="text" name="subject_name" class="login-input" id="subject_name" class="form-control" value="">
            <br>

            <label for="first_test">First Test Score</label>
            <input type="text" name="first_test" class="login-input" id="first_test" class="form-control" value="">
            <br>

            <label for="second_test">Second Test Score</label>
            <input type="text" name="second_test" class="login-input" id="second_test" class="form-control" value="">
            <br>

            <label for="exam">Exam Score</label>
            <input type="text" name="exam" id="exam" class="login-input" class="form-control" value="">
            <br>

            <label for="exam">Exam Term</label>
            <input type="text" name="exam_term" class="login-input" id="exam_term" class="form-control" value="">
            <br>

            <label for="session">Session</label>
            <input type="text" name="sch_session" class="login-input" id="sch_session" class="form-control" value="">
            <br>

            <label for="st_image">Student Photo</label>
            <input type="file" name="st_image" class="login-input" id="st_image" class="form-control" value="">
            <br>
            <input type="submit" name="submit" value="Insert Record" class="login-button">
    </form>
<?php
    }
?>
</body>
</html>
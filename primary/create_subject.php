<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","primary");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result1 = $con->query("SELECT class_name FROM class");
    $result2 = $con->query("SELECT st_id FROM student");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create Subject and Scores</title>
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
        $subject_name    = stripslashes($_REQUEST['subject_name']);
        $subject_name     = mysqli_real_escape_string($con, $subject_name);
        $class_name    = stripslashes($_REQUEST['class_name']);
        $class_name     = mysqli_real_escape_string($con, $class_name);
        $first_test = stripslashes($_REQUEST['first_test']);
        $first_test = mysqli_real_escape_string($con, $first_test);
        $second_test = stripslashes($_REQUEST['second_test']);
        $second_test = mysqli_real_escape_string($con, $second_test);
        $assessment = stripslashes($_REQUEST['assessment']);
        $assessment = mysqli_real_escape_string($con, $assessment);
        $exam = stripslashes($_REQUEST['exam']);
        $exam = mysqli_real_escape_string($con, $exam);
        $created = date("Y-m-d H:i:s");


       

        $query    = "INSERT into `subjects` (st_id, subject_name, class_name, first_test, second_test, assessment, exam, created)
                     VALUES ('$st_id', '" . ($subject_name) . "', '$class_name', '$first_test', '$second_test', '$assessment', '$exam', '$created')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You have successfully add a student score.</h3><br/>
                  <p class='link'>Click here to <a href='create_subject.php'>add another record</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='create_subject.php'>fill again</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Fill in Student Subject and Score</h1>
            <label for="st_name">Student Name</label>
                <select name="st_id" class="form-control login-input2" id="st_id">
                    <?php 
                        echo "<option>Select student id..</option>";
                        while($rows = $result2->fetch_assoc()){
                            $st_id = $rows['st_id'];
                            echo "<option value='$st_id'>$st_id </option>";
                        }

                    ?>
                </select>
            <br>

            <label for="gender">Subject</label>
            <input type="text" name="subject_name" class="login-input" id="subject_name" class="form-control" value="">
            <br>

            <label for="class_name">Class</label>
                <select name="class_name" class="login-input2" id="class_name">
                    <?php 
                        echo "<option>Select class..</option>";
                        while($rows = $result1->fetch_assoc()){
                            $class_name = $rows['class_name'];
                            echo "<option value='$class_name'>$class_name</option>";
                        }

                    ?>
                </select>
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
</body>
</html>
<?php
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect("localhost","root","","secondary");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result1 = $con->query("SELECT class_name FROM class");
    $result2 = $con->query("SELECT section_name FROM section");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Create Student</title>
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
        $st_gender     = mysqli_real_escape_string($con, $st_gender);
        $class_name   = stripslashes($_REQUEST['class_name']);
        $class_name     = mysqli_real_escape_string($con, $class_name);
        $section_name = stripslashes($_REQUEST['section_name']);
        $section_name = mysqli_real_escape_string($con, $section_name);
        $created = date("Y-m-d H:i:s");


    
        $query    = "INSERT into `student` (st_name, st_gender, class_name, section_name, created)
                     VALUES ('$st_name', '" . ($st_gender) . "', '$class_name', '$section_name', '$created')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You have successfully add a student data.</h3><br/>
                  <p class='link'>Click here to <a href='create_student.php'>add another record</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='create_student.php'>fill again</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Fill in Student Data</h1>
            <label for="st_name">Student Name</label>
            <input type="text" name="st_name" class="login-input" id="st_name" class="form-control" value="">
            <br>

            <label for="gender">Gender</label>
            <input type="text" name="st_gender" class="login-input" id="st_gender" class="form-control" value="">
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

            <label for="first_test">Section</label>
                <select name="section_name" class="login-input2" id="section_name">
                    <?php 
                        echo "<option>Select section..</option>";
                        while($rows = $result2->fetch_assoc()){
                            $section_name = $rows['section_name'];
                            echo "<option value='$section_name'>$section_name </option>";
                        }

                    ?>
                </select>   
            <br>

            
            <input type="submit" name="submit" value="Insert Record" class="login-button">
    </form>
<?php
    }
?>
</body>
</html>
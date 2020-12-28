<?php
    include ('includes/functions.php');
    if(isset($_POST['btnupdate'])) :
        update($_POST['section_name'], $_POST['section_id']);
    endif;
    $user = (isset($_GET['section_id'])) ? selectSingle($_GET['section_id']) : false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secondary Result</title>
    <?php include ('theme/header-script.php');?>

</head>
<body>
    <?php if ($user != false) : ?>
    <h1>Update</h1>
    <form action="" method="post">
        <input type="hidden" name="section_id" id="section_id" value="<?php echo $user['section_id'];?>">
        <label for="section_name"></label>
        <input type="text" name="section_name" id="section_name" value="<?php echo $user['section_name'];?>">
        <br>

        <button class="btnupdate">Update Record</button>
    </form>
    

    <?php else: ?>
        <h1>User is not set, try again.</h1>
    <?php endif; ?>


    <?php include ('theme/footer-script.php');?>
</body>
</html>
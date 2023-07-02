<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
    <style>
        body{
    margin: 0;
    background-color: #222629;
    color: white;
    font-family: 'Roboto', sans-serif;
}

.title{
    font-size: 3em;
    text-align: center;
    margin-top: 10px;
}

.main{
    display: grid;
    grid-template-rows: 80vh;
    grid-template-columns: 1fr 1fr;
    align-items: center;
}

.login,.search{
    padding: 20px;
}


/* form */
input,select{
    width: 100%;
    padding: 12px 20px;
    margin: 10px 0;
    box-sizing: border-box;
    display: block;
}

input[type=text],input[type=password],select{
    background-color: #474b4f;
    color: white;
    border: none;
    font-size: 100%;
    letter-spacing: 0.2em;
}

input[type=submit]{
    background-color: #474b4f;
    color: white;
    border: none;
    transition-duration: 0.4s;
    cursor: pointer;
    font-size: 16px;

}

input[type=submit]:hover{
    background-color: #86c232;
    color: white
}

fieldset{
    font-size: 20px;
    border-radius: 10px;
    border-width: 5px;
    border-style: solid;
}
</style>
    <div class="title">
        <span>Student Result Management System</span>
    </div>

    <div class="main">
        <div class="login">
            <form action="" method="post" name="login">
                <fieldset>
                    <legend class="heading">Admin Login</legend>
                    <input type="text" name="userid" placeholder="Email" autocomplete="off">
                    <input type="password" name="password" placeholder="Password" autocomplete="off">
                    <input type="submit" value="Login">
                </fieldset>
            </form>    
        </div>
        <div class="search">
            <form action="./student.php" method="get">
                <fieldset>
                    <legend class="heading">For Students</legend>

                    <?php
                        include('init.php');

                        $class_result=mysqli_query($conn,"SELECT `name` FROM `class`");
                            echo '<select name="class">';
                            echo '<option selected disabled>Select Class</option>';
                        while($row = mysqli_fetch_array($class_result)){
                            $display=$row['name'];
                            echo '<option value="'.$display.'">'.$display.'</option>';
                        }
                        echo'</select>'
                    ?>

                    <input type="text" name="rn" placeholder="Roll No">
                    <input type="submit" value="Get Result">
                </fieldset>
            </form>
        </div>
    </div>

</body>
</html>

<?php
    include("init.php");
    session_start();

    if (isset($_POST["userid"],$_POST["password"]))
    {
        $username=$_POST["userid"];
        $password=$_POST["password"];
        $sql = "SELECT userid FROM admin_login WHERE userid='$username' and password = '$password'";
        $result=mysqli_query($conn,$sql);

        // $row=mysqli_fetch_array($result);
        $count=mysqli_num_rows($result);
        
        if($count==1) {
            $_SESSION['login_user']=$username;
            header("Location: dashboard.php");
        }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password")';
            echo '</script>';
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Student Registration</title>
<style>
body{
    font-family: Arial;
    margin:50px;
}
.error{
    color:red;
    font-size:0.9em;
}
.success{
    color:green;
    font-weight:bold;
}
input,select{
    margin:8px 0;
    padding:8px;
    width:320px;
}
</style>
</head>

<body>

<h2>University Student Registration</h2>

     <?php

     $viewsql = "SELECT name, email from students";
     $result = mysqli_query($conn, $viewsql);

     if ( mysqli_num_row($result)>0)
        {
            while($row = mysqli_fetch_assoc($result))
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td> . $row["email"] . "</td>";
                echo "</tr>";
        }
        
        else {
        echo "<tr><td colspan='2'style='text-align:center;'> No records found </td></tr>";
            }

    $conn = mysqli_connect("Localhost","root","","student-management");
    if (!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }

    $name=$email=$username=$password=$confirm=$age=$gender=$course="";
    $nameErr=$emailErr=$usernameErr=$passwordErr=$confirmErr=$ageErr=$genderErr=$courseErr=$termsErr="";
    $success="";


    if($_SERVER["REQUEST_METHOD"]=="POST"){

        // NAME
        if(empty($_POST["name"])){
            $nameErr="Full Name is required";
        }else{
            $name=test_input($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/",$name)){
                $nameErr="Only letters and spaces allowed";
            }
        }

        // EMAIL
        if(empty($_POST["email"])){
            $emailErr="Email is required";
        }else{
            $email=test_input($_POST["email"]);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailErr="Invalid email format";
            }
        }

        // USERNAME
        if(empty($_POST["username"])){
            $usernameErr="Username required";
        }else{
            $username=test_input($_POST["username"]);
            if(strlen($username)<5){
                $usernameErr="Username must be at least 5 characters";
            }
        }

        // PASSWORD
        if(empty($_POST["password"])){
            $passwordErr="Password required";
        }else{
            $password=$_POST["password"];
            if(strlen($password)<6){
                $passwordErr="Password must be at least 6 characters";
            }
        }

        // CONFIRM PASSWORD
        if(empty($_POST["confirm"])){
            $confirmErr="Confirm your password";
        }else{
            $confirm=$_POST["confirm"];
            if($password!=$confirm){
                $confirmErr="Passwords do not match";
            }
        }

        // AGE
        if(empty($_POST["age"])){
            $ageErr="Age required";
        }else{
            $age=test_input($_POST["age"]);
            if($age<18){
                $ageErr="Age must be 18 or above";
            }
        }

        // GENDER
        if(empty($_POST["gender"])){
            $genderErr="Select gender";
        }else{
            $gender=$_POST["gender"];
        }

        // COURSE
        if(empty($_POST["course"])){
            $courseErr="Select a course";
        }else{
            $course=$_POST["course"];
        }

        // TERMS
        if(!isset($_POST["terms"])){
            $termsErr="You must accept Terms & Conditions";
        }

        // SUCCESS
        if(empty($nameErr) && empty($emailErr) && empty($usernameErr) &&
        empty($passwordErr) && empty($confirmErr) && empty($ageErr) &&
        empty($genderErr) && empty($courseErr) && empty($termsErr)){

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO students (name, email, username, password, age, gender, course )
            VALUES ('$name', '$email', '$username', '$hashed_password', '$age', '$gender', '$course')";
            if (mysqli_query($conn, $sql)){
                $success ="Registration successful";

            }
            else {
                $success = "Error: ".mysqli_error($conn);
            }


        }
    }

    function test_input($data){
        $data=trim($data);
        return $data;
    }

    ?> 
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

Full Name:<br>
<input type="text" name="name" value="<?php echo $name; ?>">
<span class="error"><?php echo $nameErr; ?></span><br>

Email:<br>
<input type="text" name="email" value="<?php echo $email; ?>">
<span class="error"><?php echo $emailErr; ?></span><br>

Username:<br>
<input type="text" name="username" value="<?php echo $username; ?>">
<span class="error"><?php echo $usernameErr; ?></span><br>

Password:<br>
<input type="password" name="password">
<span class="error"><?php echo $passwordErr; ?></span><br>

Confirm Password:<br>
<input type="password" name="confirm">
<span class="error"><?php echo $confirmErr; ?></span><br>

Age:<br>
<input type="number" name="age" value="<?php echo $age; ?>">
<span class="error"><?php echo $ageErr; ?></span><br>

Gender:<br>
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<span class="error"><?php echo $genderErr; ?></span><br><br>

Course:<br>
<select name="course">
<option value="">Select Course</option>
<option value="CSE">CSE</option>
<option value="BBA">BBA</option>
<option value="EEE">EEE</option>
</select>
<span class="error"><?php echo $courseErr; ?></span><br><br>

<input type="checkbox" name="terms"> I accept Terms & Conditions
<span class="error"><?php echo $termsErr; ?></span><br><br>

<input type="submit" value="Register">

</form>

<?php
if($success){
    echo "<p class='success'>$success</p>";
    echo "<h3>Submitted Details:</h3>";
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Username: $username <br>";
    echo "Age: $age <br>";
    echo "Gender: $gender <br>";
    echo "Course: $course <br>";
}
?>

</body>
</html>


<?php

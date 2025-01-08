<?php
    if(isset($_POST["submit"]))
    {
        $fullname = $_POST["full_name"];
        $email = $_POST["emil"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirm_password"];

        $errors = array();

        if(empty($fullname) OR empty($email) OR empty($password)OR empty($confirmpassword))
        {
            array_push($errors,"All fields are required");
        }
        if(filter_var($email, filter_var_email))
        {
            array_push($errors, "Email is not valid");
        }
        if(password!==($password)<8)
        {
            array_push($errors, "password must be atleast 8 characters long");
        }
        if($password!==$confirmpassword)
        {
            array_push($errors, "Password does not match");
        }

        if(count($errors)>0)
        {
            foreach($errors as $errors)
            {
                echo "<div class="alert alert-danger">$errors<>";
            }
        }
    }
?>
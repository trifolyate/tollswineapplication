<?php
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = array();
    $con = mysqli_connect("us-cdbr-east-06.cleardb.net", "b34e5df2471635", "6ffed3a5", "heroku_eb7517145b609d1");
    if ($con) {
        $sql = "select * from employee where email = '" . $email . "'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) != 0) {
            $row = mysqli_fetch_assoc($res);
            if ($email == $row['email']) {
                try {
                    $apiKey = bin2hex(random_bytes(23));
                } catch (Exception $e) {
                    $apiKey = bin2hex(uniqid($email, true));
                }
                $sqlUpdate = "UPDATE `heroku_eb7517145b609d1`.`employee` SET `apiKey`='" . $apiKey . "' WHERE  `email`='" . $email . "';";
                if (mysqli_query($con, $sqlUpdate)) {
                    $result = array(
                        "status" => "success",
                        "message" => "Login successful",
                        "name" => $row['first_name'],
                        "email" => $row['email'],
                        "password" => $row['password']
                    );
                } else $result = array("status" => "failed","message" => "Login failed try again");
            } else $result = array("status" => "failed","message" => "Retry with correct email and password");
        } else $result = array("status" => "failed","message" => "Retry with correct email and password");
    } else $result = array("status" => "failed","message" => "Database connection failed");
} else $result = array("status" => "failed","message" => "All fields are required");

echo json_encode($result, JSON_PRETTY_PRINT);
?>

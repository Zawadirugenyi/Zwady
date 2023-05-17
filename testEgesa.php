<?php
require 'connect.php';

// Get the values from the HTML form

$Username = mysqli_real_escape_string($con, $_POST["Full_name"]);
$Email = mysqli_real_escape_string($con, $_POST["email"]);
$Phone_number = mysqli_real_escape_string($con, $_POST["Phone_number"]);
$Occupation = mysqli_real_escape_string($con, $_POST["Occupation"]);
$Income = mysqli_real_escape_string($con, $_POST["Income"]);
$Address = mysqli_real_escape_string($con, $_POST["Address"]);
$Person_of_reference = mysqli_real_escape_string($con, $_POST["Person_of_reference"]);

        
        // Validate the form fields
if (empty($Phone_number)) {
    echo json_encode(array("error" => "true", "message" => "Please fill in all required fields"));
    exit;
}


$res = mysqli_query($con,"select id from users where Username='$Username', Email='$Email'");

$Client_Id = '';

if($res->num_rows > 0){
    if($row = mysqli_fetch_assoc($res)){

        $Client_Id = $row['Id'];

        
        
        // Create the SQL query with the correct column names and values
        $sql = " INSERT INTO registration (client_id, Phone_number, Occupation, Income, Address, Person_of_reference)
        VALUES ( '$Client_Id', '$Phone_number', '$Occupation', '$Income', '$Address', '$Person_of_reference') ";
        
        // Execute the SQL query and check if it was successful
        if (mysqli_query($con, $sql)) {
            echo json_encode(array("message" => "User registered successfully"));
        } else {
            echo json_encode(array("error" => "true", "message" => "Error: " . $sql . "<br>" . mysqli_error($con)));
        }
                
        
        
    }
}

?>

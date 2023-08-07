<?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    
    $conn = mysqli_connect("localhost", "root", "", "user_info");

    // Prepare the SQL statement using a parameterized query
    $sql = "INSERT INTO registration(firstname, lastname, email, pass) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters and set their types
    mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $password);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
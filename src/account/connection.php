<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['pass'];

$conn = mysqli_connect("localhost", "root", "", "user_info");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the email already exists
$checkSql = "SELECT * FROM registration WHERE email = ?";
$checkStmt = mysqli_prepare($conn, $checkSql);
mysqli_stmt_bind_param($checkStmt, "s", $email);
mysqli_stmt_execute($checkStmt);
$checkResult = mysqli_stmt_get_result($checkStmt);

if ($checkResult) {
    if (mysqli_num_rows($checkResult) > 0) {
        echo "The email has already been taken.";
        mysqli_free_result($checkResult);
        mysqli_stmt_close($checkStmt);
        mysqli_close($conn);
        exit; // Exit the script, since the email is already taken
    }
} else {
    echo "Error checking email existence: " . mysqli_error($conn);
    mysqli_close($conn);
    exit; // Exit the script due to an error
}

// Prepare the SQL statement using a parameterized query
$sql = "INSERT INTO registration (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Prepare statement failed: " . mysqli_error($conn));
}

// Password Hashing
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPassword);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Form Submission</title>
        <link rel="stylesheet" href="conn.css">
    </head>
    <body>
        <div id="popup">
            <div class="pop-2">
                <h1>Hello, <?php echo $firstname ?> welcome to feres Airlines</h1>
                <h1>Your form submitted successfully!</h1>
                <a class="log" href="/Airlines/src/account/login.html">Login</a>
            </div>
        </div>
        <script>
            // Show the popup message
            var popupTimeout; // Declare a variable to store the timeout ID

            function showPopup() {
                document.getElementById("popup").style.display = "block";
                // Set the timeout and store the timeout ID
                popupTimeout = setTimeout(function () {
                    document.getElementById("popup").style.display = "none";
                }, 10000); // Hide the popup after 10 seconds
            }

            function cancelPopupTimer() {
                // Clear the timeout using the stored timeout ID
                clearTimeout(popupTimeout);
                document.getElementById("popup").style.display = "none"; // Also hide the popup immediately
            }
            // Call the function to show the popup after successful form submission
            showPopup();
        </script>
    </body>
    </html>
    <?php
} else {
    echo "Error executing query: " . mysqli_error($conn);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

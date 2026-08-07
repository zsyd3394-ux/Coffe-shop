<?php

session_start();

require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = trim($_POST["login"]);
    $password = $_POST["password"];

    if ($login == "" || $password == "") {
        die("Please enter username/email and password.");
    }

    $stmt = $conn->prepare(
        "SELECT ID, Username, Email, Password
         FROM users
         WHERE Username = ? OR Email = ?"
    );

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $login, $login);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user["Password"])) {

            $_SESSION["user_id"] = $user["ID"];
            $_SESSION["username"] = $user["Username"];
            $_SESSION["email"] = $user["Email"];

            header("Location: ../index.html");
exit();

        } else {

            echo "Incorrect password.";

        }

    } else {

        echo "Username or Email not found.";

    }

    $stmt->close();
}

$conn->close();

?>
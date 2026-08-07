<?php
require "db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT Username, Email, CreatedAt FROM Users WHERE ID = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - My Profile</title>

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!--css-->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="../index.html">☕ Coffee Shop</a>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow p-4" style="width: 350px;">
            <h3 class="text-center mb-4">ًWelcome، <?php echo htmlspecialchars($user["Username"]); ?> 👋</h3>

            <p><strong>User name:</strong> <?php echo htmlspecialchars($user["Username"]); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user["Email"]); ?></p>
            <p><strong>Registration date:</strong> <?php echo htmlspecialchars($user["CreatedAt"]); ?></p>

            <a href="logout.php" class="btn btn-danger w-100 mt-3">Log out</a>
        </div>
    </div>
</body>
</html>
<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "signup_db";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the most recently added user
$sql = "SELECT username, email, profile_picture FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../php/user_info.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-picture">
                <?php if (empty($user["profile_picture"])): ?>
                    <div class="edit-overlay">
                        <span>Edit</span>
                    </div>
                    <?php
                    // Display the first letter of the username as the profile picture
                    echo strtoupper(substr($user["username"], 0, 1));
                    ?>
                <?php else: ?>
                    <img src="<?php echo htmlspecialchars($user["profile_picture"]); ?>" alt="Profile Picture">
                <?php endif; ?>
            </div>
            <div class="username">
                <?php echo htmlspecialchars($user["username"]); ?>
            </div>
            <div class="email">
                <?php echo htmlspecialchars($user["email"]); ?>
            </div>
        </div>
        <div class="profile-details">
            <a href="edit_profile.php" class="btn">Edit Profile</a>
        </div>
    </div>
</body>
</html>

<?php
include 'dbconnect.php';

$success_message = "";  // Variable to store success message
$artist = []; // Initialize empty array to avoid undefined variable issues

if (isset($_GET['artist_id']) && !empty($_GET['artist_id'])) {
    $artist_id = $_GET['artist_id'];

    // Fetch artist details
    $stmt = $conn->prepare("SELECT * FROM artist WHERE artist_id = ?");
    $stmt->execute([$artist_id]);
    $artist = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if artist exists
    if (!$artist) {
        die("Error: Artist not found.");
    }
} else {
    die("Error: No artist_id provided.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['artist_id']) || empty($_POST['artist_id'])) {
        die("Error: Missing artist ID.");
    }

    $artist_id = $_POST['artist_id'];
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $birthplace = $_POST['birthplace'];
    $nationality = $_POST['nationality'];
    $works = $_POST['works'];
    $specialty = $_POST['specialty'];
    $image_path = $_POST['image'];

    // Prepare the SQL statement to update the artist in the database
    $stmt = $conn->prepare("UPDATE artist SET name = ?, birth_date = ?, birthplace = ?, nationality = ?, works = ?, specialty = ?, image = ? WHERE artist_id = ?");

    if ($stmt->execute([$name, $birth_date, $birthplace, $nationality, $works, $specialty, $image_path, $artist_id])) {
        $success_message = "Artist updated successfully!";
        echo "<script>alert('$success_message');</script>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            padding-top: 70px;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, #8b0000, #a52a2a);
            padding: 15px 30px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .container {
            width: 80%;
            margin: 100px auto;
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #8b0000;
            margin-bottom: 20px;
            font-size: 28px;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #8b0000;
        }

        label {
            font-size: 18px;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[type="url"],
        textarea {
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            transition: border 0.3s;
        }

        input[type="file"] {
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        input[type="submit"] {
            background: linear-gradient(135deg, #8b0000, #a52a2a);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #6a1919, #7e2424);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .quote-block {
            font-style: italic;
            padding: 20px;
            background-color: #f9f9f9;
            border-left: 4px solid #8b0000;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }

            .container {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">National Artists</div>
        <div class="nav-links">
            <a href="dashboard.php">Home</a>
            <a href="about.php">About</a>
            <a href="view_artist.php">View Artists</a>
            <a href="add_artist.php">Add Artist</a>
            <a href="index.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h2>Edit Artist</h2>

        <?php if ($success_message): ?>
            <script>
                alert('<?php echo $success_message; ?>');
            </script>
        <?php endif; ?>

        <form method="POST" action="edit_artist.php?artist_id=<?php echo $artist['artist_id']; ?>">
            <input type="hidden" name="artist_id" value="<?php echo $artist['artist_id']; ?>" />

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $artist['name']; ?>" required />

            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" value="<?php echo $artist['birth_date']; ?>" required />

            <label for="birthplace">Birthplace:</label>
            <input type="text" id="birthplace" name="birthplace" value="<?php echo $artist['birthplace']; ?>" required />

            <label for="nationality">Nationality:</label>
            <input type="text" id="nationality" name="nationality" value="<?php echo $artist['nationality']; ?>" required />

            <label for="works">Notable Works:</label>
            <textarea id="works" name="works" required><?php echo $artist['works']; ?></textarea>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" value="<?php echo $artist['specialty']; ?>" required />

            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" value="<?php echo $artist['image']; ?>" required />

            <input type="submit" value="Update Artist" />
        </form>
    </div>
</body>

</html>
<?php
include 'dbconnect.php';

$success_message = "";  // Variable to store success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $birthplace = $_POST['birthplace'];
    $nationality = $_POST['nationality'];
    $works = $_POST['works'];
    $specialty = $_POST['specialty'];

    // Instead of handling file uploads, we simply get the image URL from the input
    $image_path = $_POST['image'];

    // Prepare the SQL statement to insert the new artist into the database
    $stmt = $conn->prepare("INSERT INTO artist (name, birth_date, birthplace, nationality, works, specialty, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $birth_date, $birthplace, $nationality, $works, $specialty, $image_path]);

    if ($stmt) {
        // Set success message if the artist is added successfully
        $success_message = "New Artist added successfully!";
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
    <title>Add New Artist</title>
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
        <h2>Add New Artist</h2>

        <!-- Display the success message if artist is added -->
        <?php if ($success_message): ?>
            <script>
                alert('<?php echo $success_message; ?>');
            </script>
        <?php endif; ?>

        <form method="POST" action="add_artist.php" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />

            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" required />

            <label for="birthplace">Birthplace:</label>
            <input type="text" id="birthplace" name="birthplace" required />

            <label for="nationality">Nationality:</label>
            <input type="text" id="nationality" name="nationality" required />

            <label for="works">Notable Works:</label>
            <textarea id="works" name="works" required></textarea>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" required />

            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" placeholder="Enter image URL" required />

            <input type="submit" value="Add Artist" />
        </form>

        <div class="quote-block">
            "The National Artist Award celebrates the Filipino creative spirit and honors those who have elevated our cultural identity through their extraordinary work and dedication."
        </div>
    </div>

</body>
</html>

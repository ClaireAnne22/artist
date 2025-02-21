<?php
include 'dbconnect.php';

try {

    $stmt = $conn->prepare("SELECT * FROM artist");
    $stmt->execute();
    $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Artists</title>
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
            padding-top: 20px;
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

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container form {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 8px 12px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
            width: 200px;
            transition: width 0.3s ease;
        }

        .search-container input[type="text"]:focus {
            width: 250px;
            outline: none;
        }

        .search-container button {
            background-color: white;
            border: none;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 0 4px 4px 0;
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: #f1f1f1;
        }

        .search-icon {
            display: inline-block;
            width: 18px;
            height: 18.5px;
            border: 2px solid #8b0000;
            border-radius: 50%;
            position: relative;
        }

        .search-icon::after {
            content: '';
            position: absolute;
            width: 2px;
            height: 8px;
            background: #8b0000;
            transform: rotate(-45deg);
            bottom: -5px;
            right: -3px;
        }

        .container {
            max-width: 90vw;
            margin: auto;
            padding-top: 100px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 10px;
            justify-content: center;
            align-items: stretch;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            width: 200px;
            height: 220px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 20%;
            background-color: #eee;
        }

        .card h5 {
            color: maroon;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 90%;
            max-width: 450px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            animation: fadeIn 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .modal-content img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 20%;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 22px;
            cursor: pointer;
            color: #8b0000;
        }

        .close-btn:hover {
            color: #a52a2a;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .edit-btn,
        .delete-btn {
            padding: 10px 15px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            color: white;
            background-color: #8b0000;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            background-color: #a52a2a;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">National Artists</div>
        <div class="nav-links">
            <div class="search-container">
                <form action="search.php" method="get">
                    <input type="text" placeholder="Search" name="search">
                    <button type="submit"><i class="search-icon"></i></button>
                </form>
            </div>
            <a href="dashboard.php">Home</a>
            <a href="about.php">About</a>
            <a href="view_artist.php">View Artists</a>
            <a href="add_artist.php">Add Artist</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($artists)): ?>
            <?php foreach ($artists as $artist): ?>
                <div class="card" onclick='openModal(<?= json_encode($artist, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                    <img src="<?= htmlspecialchars($artist['image']) ?>" alt="Artist Image">
                    <h5><?= htmlspecialchars($artist['name']) ?></h5>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No artists found.</p>
        <?php endif; ?>
    </div>

    <div id="artistModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="Artist Image">
            <h3 id="modalName"></h3>
            <p id="modalDescription"></p>
            <p><strong>Birthdate:</strong> <span id="modalBirthdate"></span></p>
            <p><strong>Birthplace:</strong> <span id="modalBirthplace"></span></p>
            <p><strong>Nationality:</strong> <span id="modalNationality"></span></p>
            <p><strong>Specialty:</strong> <span id="modalSpecialty"></span></p>
            <p><strong>Notable Works:</strong> <span id="modalNotableworks"></span></p>

        <div class="modal-buttons">
            <button class="edit-btn" onclick="editArtist()">Edit</button>
            <button class="delete-btn" onclick="deleteArtist()">Delete</button>
        </div>
        </div>
    </div>
    </div>


    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeDeleteConfirmationModal()">&times;</span>
            <h3>Are you sure you want to delete this artist?</h3>
            <div class="modal-buttons">
                <button class="delete-btn" onclick="confirmDelete()">Yes</button>
                <button class="edit-btn" onclick="closeDeleteConfirmationModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let currentArtist = null;

        function openModal(artist) {
            currentArtist = artist;

            console.log("Modal Opened. Current Artist:", currentArtist);
            document.getElementById("modalImage").src = artist.image;
            document.getElementById("modalName").textContent = artist.name;
            document.getElementById("modalDescription").textContent = artist.description;
            document.getElementById("modalBirthdate").textContent = artist.birth_date;
            document.getElementById("modalBirthplace").textContent = artist.birthplace;
            document.getElementById("modalNationality").textContent = artist.nationality;
            document.getElementById("modalSpecialty").textContent = artist.specialty;
            document.getElementById("modalNotableworks").textContent = artist.works;
            document.getElementById("artistModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("artistModal").style.display = "none";
        }

        function editArtist() {
            console.log("Edit button function triggered");

            if (currentArtist) {
                console.log("Current Artist Data:", currentArtist);
                console.log("Artist ID:", currentArtist.artist_id);

                window.location.href = 'edit_artist.php?artist_id=' + currentArtist.artist_id;
            } else {
                console.error("No artist data available!");
            }
        }

        function deleteArtist() {
            if (currentArtist) {
                document.getElementById("deleteConfirmationModal").style.display = "flex";
            }
        }

        function closeDeleteConfirmationModal() {
            document.getElementById("deleteConfirmationModal").style.display = "none";
        }

        function confirmDelete() {
            if (currentArtist) {
                window.location.href = 'delete_artist.php?delete_id=' + currentArtist.id;
            }
        }
    </script>

</body>

</html>
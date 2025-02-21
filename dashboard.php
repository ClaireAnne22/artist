<?php
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Artists of the Philippines</title>
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
            bottom: -130px;
            width: 99%;
            max-width: 100%px;
            margin: 30px auto;
            background: white;
            padding: 35px;
            border-radius: 10px;
            position: relative;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        h2 {
            color: #8b0000;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
            font-size: 28px;
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
        
        h3 {
            color: #555;
            margin: 20px 0 10px;
            font-size: 22px;
        }

        p {
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        ul {
            padding-left: 25px;
            margin: 15px 0;
        }
        
        li {
            margin-bottom: 8px;
            position: relative;
        }

        .artists-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }
        
        .artist-card {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-left: 4px solid #8b0000;
        }
        
        .artist-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .artist-card strong {
            display: block;
            color: #8b0000;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .impact-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 25px;
        }
        
        .impact-item {
            flex: 1;
            min-width: 250px;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .impact-item strong {
            color: #8b0000;
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px;
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 5px;
                margin-top: 15px;
            }
            
            .nav-links a {
                width: 100%;
                text-align: center;
                padding: 10px;
            }
            
            .container {
                width: 95%;
                padding: 20px;
            }
            
            .artists-grid, .impact-container {
                grid-template-columns: 1fr;
            }
        }

        .quote-block {
            font-style: italic;
            padding: 20px;
            background-color: #f9f9f9;
            border-left: 4px solid #8b0000;
            margin: 20px 0;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, #f9e8e8, #fff);
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
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
    
    @media (max-width: 768px) {
        .navbar {
            padding-bottom: 20px;
        }
        
        .search-container {
            margin-top: 15px;
            width: 100%;
        }
        
        .search-container form {
            width: 100%;
        }
        
        .search-container input[type="text"] {
            width: 100%;
        }
        
        .search-container input[type="text"]:focus {
            width: 100%;
        }
    }

    .banner {
        width: 100%;
        height: 400px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin-bottom: 20px;
        position: relative;
        top: 0;
        left: 0;
        z-index: 999;
        display: block;
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
            <a href="#">Home</a>
            <a href="about.php">About</a>
            <a href="view_artist.php">View Artists</a>
            <a href="add_artist.php">Add Artist</a>
            <a href="index.php">Logout</a>
        </div>
    </div>
    <div class="banner"><img src="assets/topbanner.jpg" alt=""></div>

    <div class="container">
        
        <section>
            <h2>What is the National Artist Award?</h2>
            <p>The National Artist of the Philippines award is the highest recognition given to Filipino individuals who have made significant contributions to the country's arts and culture.</p>
            
            <div class="quote-block">
                "The National Artist Award celebrates the Filipino creative spirit and honors those who have elevated our cultural identity through their extraordinary work and dedication."
            </div>
            
            <h3>The award covers various disciplines:</h3>
            <ul>
                <li>Music (e.g., composers, singers, musicians)</li>
                <li>Dance (e.g., choreographers, dancers)</li>
                <li>Theater (e.g., playwrights, stage actors, directors)</li>
                <li>Visual Arts (e.g., painters, sculptors, photographers)</li>
                <li>Literature (e.g., poets, novelists, essayists)</li>
                <li>Film and Broadcast Arts (e.g., filmmakers, directors, screenwriters)</li>
                <li>Architecture and Allied Arts (e.g., architects, interior designers)</li>
            </ul>
        </section>
        
        <section>
            <h2>Why Are National Artists Important?</h2>
            <p>National Artists shape the country's cultural identity through their works, reflecting history, traditions, struggles, and triumphs.</p>
            
            <div class="highlight-box">
                <h3>Some of their contributions include:</h3>
                <ul>
                    <li><strong>Preserving Philippine Culture</strong> - Safeguarding traditions and heritage through art forms</li>
                    <li><strong>Innovating and Elevating Art Forms</strong> - Pushing boundaries and expanding artistic expressions</li>
                    <li><strong>Advocating for Social Change</strong> - Using art as a medium for awareness and progress</li>
                </ul>
            </div>
        </section>
        
        <section>
            <h2>The Impact of National Artists on Filipino Society</h2>
            <div class="impact-container">
                <div class="impact-item">
                    <strong>Education</strong>
                    Their works are included in textbooks to teach students about Philippine heritage, fostering appreciation for local arts and culture among younger generations.
                </div>
                <div class="impact-item">
                    <strong>Tourism</strong>
                    Landmarks and museums celebrate their works, attracting both local and international visitors interested in experiencing authentic Filipino artistry.
                </div>
                <div class="impact-item">
                    <strong>National Pride</strong>
                    Their contributions inspire citizens to appreciate Filipino culture and instill a sense of identity and belonging among Filipinos worldwide.
                </div>
            </div>
        </section>
        
        <section>
            <h2>How Are National Artists Chosen?</h2>
            <p>The selection process involves nomination, evaluation by experts, and final approval by the President of the Philippines.</p>
            
            <div class="highlight-box">
                <h3>Selection Process:</h3>
                <ol>
                    <li>Nomination by peers, institutions, or the public</li>
                    <li>Initial screening by the National Commission for Culture and the Arts (NCCA)</li>
                    <li>Evaluation by the Committee of Experts</li>
                    <li>Deliberation by the NCCA Board and Cultural Center of the Philippines (CCP) Board of Trustees</li>
                    <li>Final selection and proclamation by the President of the Philippines</li>
                </ol>
            </div>
        </section>
        
        <section>
            <h2>Conclusion</h2>
            <p>The National Artists of the Philippines have a lasting impact on arts and culture, preserving the country's artistic legacy for future generations.</p>
            <p>Their works continue to inspire new generations of artists, ensuring that Philippine arts and culture remain vibrant and relevant in the modern world.</p>
            <div class="quote-block">
                "Art is the signature of civilizations." - Beverly Sills
            </div>
        </section>
    </div>
</body>
</html>
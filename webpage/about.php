<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meowware - About Us</title>
    <link rel="stylesheet" href="main.css">
    <style>
        
        .about-section {
            max-width: 900px;
            margin: auto;
            text-align: center;
            line-height: 1.8;
            padding: 60px 20px;
        }

        .about-section h2 {
            color: #99f2c8;
            font-size: 2rem;
            margin-bottom: 30px;
        }

        .story-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }

        .story-card {
            background: #1e1e1e;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.6);
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s, color 0.3s;
            text-align: center;
        }

        .story-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.8);
        }

       

        .story-card h3 {
            color: #66ffcc;
            margin-bottom: 10px;
        }

        .story-card p {
            color: #ccc;
            font-size: 0.95rem;
        }

        .team-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #99f2c8;
            margin: 15px auto;
        }

    </style>
</head>
<body>

    <nav>
        <a href="mainpage.php">Home</a>
        <a href="team.php">Team</a>
        <a href="about.php">About</a>
        <a href="clients.php">Clients</a>
    </nav>

    <header>
        <h1>About Meowware</h1>
        <p>Our story, mission, vision, and a little fun!</p>
    </header>

    <main>
        <section class="about-section">
            <h2>Who We Are</h2>
            <p>Meowware is a group of creators, coders, and dreamers united by the love of technology and creativity. We don’t just build projects; we build experiences that inspire learning, collaboration, and fun.</p>

            <div class="story-cards">
                <div class="story-card">
                    <img src="team1.jpg" alt="Team Member" class="team-photo">
                    <h3>Our Mission</h3>
                    <p>To empower learners and creators by combining technology and creativity in a way that is engaging, meaningful, and fun.</p>
                </div>
                <div class="story-card">
                    <img src="team2.jpg" alt="Team Member" class="team-photo">
                    <h3>Our Vision</h3>
                    <p>To be a hub where innovation meets inspiration, helping everyone explore, create, and grow in the digital world.</p>
                </div>
                <div class="story-card">
                    <img src="team3.jpg" alt="Team Member" class="team-photo">
                    <h3>Our Values</h3>
                    <p>Teamwork, creativity, curiosity, and a sprinkle of fun in everything we do. We believe learning should never be boring!</p>
                </div>
                <div class="story-card fun-fact">
                    <img src="team4.jpg" alt="Team Fun Fact" class="team-photo">
                    <h3>Fun Fact</h3>
                    <p>Did you know? Our team loves coding with music, snacks, and a couple of drinks!</p>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>All rights reserved | Designed by Meowware</p>
    </footer>

</body>
</html>

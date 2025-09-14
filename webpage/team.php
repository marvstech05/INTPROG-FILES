<?php
$team = [
    [
        "img" => "em.jpg",
        "name" => "Erica Mae Barriga",
        "bio"  => "A kinda aspiring developer energized by coke, wi-fi and memes. Loves figuring things out, even if it means a few Google searches (or a lot).",
        "skills" => ["HTML, CSS, C++", "Problem-solving", "Team collaboration & communication"],
        "socials" => [
            "Facebook"  => "https://www.facebook.com/noxtureri",
            "Instagram" => "https://www.instagram.com/err.qlo/"
        ]
    ],
    [
        "img" => "marv.jpg",
        "name" => "Marvin Tormis",
        "bio"  => "A gamer and explorer who loves discovering cool places and catching up on my favorite shows and films.",
        "skills" => ["Media Appreciation", "Can track/identify certain places", "Gaming Knowledge"],
        "socials" => [
            "Facebook"  => "https://www.facebook.com/nvmitseast",
            "Instagram" => "https://www.instagram.com/trmsmrvin/?igsh=MTFkYzMyeXZoOHVpdw%3D%3D&utm_source=qr#"
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meowware - Team</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>

   <nav>
    <a href="mainpage.php">Home</a>
    <a href="team.php">Team</a>
    <a href="about.php">About</a>
    <a href="clients.php">Clients</a>
</nav>


    <header>
        <h1>MEOWWARE</h1>
        <p>Meet the amazing members behind this project</p>
    </header>

    <main>
        <section class="team-section">
            <h2>Our Team</h2>
            <div class="team-container">
                <?php foreach ($team as $member): ?>
                    <div class="card">
                        <img src="<?= $member['img'] ?>" alt="<?= $member['name'] ?>">
                        <div class="name"><?= $member['name'] ?></div>
                        <div class="bio"><?= $member['bio'] ?></div>
                        <div class="skills">
                            <?php foreach ($member['skills'] as $skill): ?>
                                <span><?= $skill ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="socials">
                            <?php foreach ($member['socials'] as $platform => $link): ?>
                                <a href="<?= $link ?>" target="_blank"><?= $platform ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>All rights reserved | Designed by Meowware</p>
    </footer>

</body>
</html>

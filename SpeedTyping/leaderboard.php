<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Leaderboard - Typify</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">

<style>
    body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    margin: 0;
}

.container {
    flex: 1;
    max-width: 950px;
    margin: 20px auto;
    width: 95%;
}

.card {
    width: 100%;
    padding: 20px;
}

footer {
    margin-top: auto;
    text-align: center;
    padding: 10px 0;
    color: #aaa;
    font-size: 14px;
}


.leaderboard-card table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
    font-size: 1.1rem;
}
.leaderboard-card th, .leaderboard-card td {
    padding: 12px 15px;
    border-bottom: 1px solid #444;
}
.leaderboard-card th { background: #222; color: #6c82ff; }
.leaderboard-card tr:nth-child(even) { background: #1a1a1a; }
.leaderboard-card tr:hover { background: #2a2a2a; }
</style>
</head>
<body>

<header>
    <div class="header-left">
        <img src="images/typify.png" alt="Typify Logo" class="logo">
        <h1>Typify</h1>
    </div>
    <nav class="nav-links">
        <ul>
            <li><a href="index.html">Test</a></li>
            <li><a href="leaderboard.php" class="active">Leaderboard</a></li>
            <li><a href="about.html">About</a></li>
        </ul>
    </nav>
</header>

<main class="container">
   <h2 style="color:#7d8bff; text-align:center; margin-top:-10px; margin-bottom:2px; letter-spacing:0.5px;">
    Leaderboard
</h2>
<p style="text-align:center; color:#a8a8a8; margin:0;">
    Your performance. Ranked.
</p>



    <div class="card leaderboard-card">
        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>WPM</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $conn = new mysqli("localhost", "root", "", "typify");
            if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

            $result = $conn->query("SELECT * FROM leaderboard ORDER BY wpm DESC, created_at ASC");
            $rank = 1;
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>{$rank}</td>
                        <td>".htmlspecialchars($row['name'])."</td>
                        <td>{$row['wpm']}</td>
                        <td>{$row['time']}s</td>
                      </tr>";
                $rank++;
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</main>

<footer>
    <p>Typify © 2025</p>
</footer>

</body>
</html>

<?php
session_start();

if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    if (isset($_SESSION['customers'][$delete_id])) {
        unset($_SESSION['customers'][$delete_id]);
        $message = "Client deleted!";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['email']) && !isset($_POST['delete_id'])) {
    $new_id = count($_SESSION['customers']) > 0 ? max(array_keys($_SESSION['customers'])) + 1 : 1;

    $_SESSION['customers'][$new_id] = [
        'id'    => $new_id,
        'name'  => $_POST['name'],
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email']
    ];

    $message = "Client Saved Successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meowware - Clients</title>
    <link rel="stylesheet" href="main.css">
    <style>
        .clients-section {
            max-width: 1000px;
            margin: auto;
            padding: 60px 20px;
            text-align: center;
        }

        .form-box {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.6);
            margin: 40px auto;
            max-width: 700px;
            text-align: left;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #99f2c8;
        }

        .form-box label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #99f2c8;
        }

        .form-box input[type="text"],
        .form-box input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #333;
            border-radius: 8px;
            background: #121212;
            color: #eee;
        }

        .form-box input[type="submit"] {
            margin-top: 20px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #1f4037, #99f2c8);
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.3s ease;
            width: 100%;
        }

        .form-box input[type="submit"]:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #2c6e63, #66ffcc);
        }

        .message {
            text-align: center;
            color: #66ffcc;
            font-weight: bold;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            background: #1e1e1e;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 14px;
            text-align: center;
        }

        th {
            background: #1f4037;
            color: #99f2c8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr {
            border-bottom: 1px solid #333;
        }

        tr:nth-child(even) {
            background: #2a2a2a;
        }

        tr:hover {
            background: #333;
        }

        .delete-btn {
            color: white;
            background: #b22222;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .delete-btn:hover {
            background: #8b1a1a;
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
    <h1>MEOWWARE</h1>
    <p>Managing Clients</p>
</header>

<main>
    <section class="clients-section">
        <h2>Client Management</h2>
        <p style="color:#ccc;">Add and manage your clients below.</p>

        <div class="form-box">
            <h2>Add Client</h2>
            <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

            <form action="" method="POST">
                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Phone:</label>
                <input type="text" name="phone">

                <label>Email:</label>
                <input type="email" name="email" required>

                <input type="submit" value="Submit">
            </form>
        </div>

        <h2 style="margin-top:50px; color:#99f2c8;">All Clients</h2>
        <table>
            <tr>
                <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Action</th>
            </tr>
            <?php
            if (!empty($_SESSION['customers'])) {
                foreach ($_SESSION['customers'] as $row) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['phone']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>
                                <form action='' method='POST' style='display:inline;'>
                                    <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                    <input type='submit' class='delete-btn' value='Delete' onclick=\"return confirm('Are you sure?');\">
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No customers found</td></tr>";
            }
            ?>
        </table>
    </section>
</main>

<footer>
    <p>All rights reserved | Designed by Meowware</p>
</footer>

</body>
</html>

<?php
// database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "customer_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// delete request
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM customers WHERE id=$delete_id");
    $message = "Client deleted!";
}

// add request
if (isset($_GET['name']) && isset($_GET['email']) && !isset($_GET['delete'])) {
    $name  = $_GET['name'];
    $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
    $email = $_GET['email'];

    $stmt = $conn->prepare("INSERT INTO customers (name, phone, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $phone, $email);
    $stmt->execute();
    $stmt->close();

    $message = "Client Saved Successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Information Form</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        form { display: flex; flex-direction: column; }
        label { margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="email"] { padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 8px; }
        input[type="submit"] { margin-top: 20px; padding: 12px; border: none; border-radius: 8px; background: #588157; color: white; font-size: 16px; cursor: pointer; }
        input[type="submit"]:hover { background: #839384ff; }
        .message { text-align: center; color: green; font-weight: bold; margin-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background: #588157; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        tr:hover { background: #f1f1f1; }
        .delete-btn { color: white; background: #b22222; padding: 6px 12px; border-radius: 6px; text-decoration: none; }
        .delete-btn:hover { background: #b22222; }
    </style>
</head>
<body>

<div class="container">
    <h2>Client Information Form</h2>

    <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>

    <form action="" method="GET">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Phone:</label>
        <input type="text" name="phone">

        <label>Email:</label>
        <input type="email" name="email" required>

        <input type="submit" value="Submit">
    </form>

    <h2>All Clients</h2>
    <table> 
        <tr>
            <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM customers ORDER BY id ASC");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td><a class='delete-btn' href='?delete=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this customer?');\">Delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No customers found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
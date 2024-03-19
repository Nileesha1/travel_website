<?php
// Database configuration
$host = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'travel website';
$port = 3306;

// Create a new PDO instance
$dsn = "mysql:host=$host;port=$port;dbname=$dbName";
try {
  $pdo = new PDO($dsn, $dbUser, $dbPass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

// Fetch all bookings from the database
$sql = "SELECT * FROM bookings";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bookings</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #333;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
  <h1>Admin Bookings</h1>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Date of Birth</th>
      <th>Departure</th>
      <th>Pickup</th>
    </tr>
    <?php foreach ($bookings as $booking) : ?>
      <tr>
        <td><?php echo $booking['name']; ?></td>
        <td><?php echo $booking['email']; ?></td>
        <td><?php echo $booking['phone']; ?></td>
        <td><?php echo $booking['dob']; ?></td>
        <td><?php echo $booking['departure']; ?></td>
        <td><?php echo $booking['pickup']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>

<?php
// Retrieve form data from the request
$data = json_decode(file_get_contents('php://input'), true);

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

// Insert form data into the database
$sql = "INSERT INTO bookings (name, email, phone, dob,age, departure, pickup) VALUES (:name, :email, :phone, :dob,:age, :departure, :pickup)";
$stmt = $pdo->prepare($sql);

try {
  $stmt->execute([
    ':name' => $data['name'],
    ':email' => $data['email'],
    ':phone' => $data['phone'],
    ':dob' => $data['dob'],
    ':age' => $data['age'],
    ':departure' => $data['departure'],
    ':pickup' => $data['pickup'],
  ]);
  $errorInfo = $stmt->errorInfo();
if ($errorInfo[0] !== '00000') {
  // An error occurred
  $response = ['success' => false, 'message' => 'Form submission failed: ' . $errorInfo[2]];
} else {
  // Success
  $response = ['success' => true, 'message' => 'Form submitted successfully'];
}


  $response = ['success' => true, 'message' => 'Form submitted successfully'];
} catch (PDOException $e) {
  $response = ['success' => false, 'message' => 'Form submission failed'.$e->getMessage()];
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

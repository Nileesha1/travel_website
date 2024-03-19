<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("formconnection.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $departure = $_POST['departure'];
    $pickup = $_POST['pickup'];

    // Prepare the SQL statement
    $sql = "INSERT INTO form (name, email, phone, dob, departure, pickup)
            VALUES ('$name', '$email', '$phone', '$dob', '$departure', '$pickup')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking submitted successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Booking Form</title>
    <style>
      /* CSS styles */
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url("https://wallpapercave.com/wp/zwCETTo.jpg");
        background-repeat: no-repeat;
        background-size: cover;
      }

      header {
        background-color: #333;
        color: #fff;
        padding: 10px;
        text-align: center;
      }

      h1 {
        margin: 0;
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
          sans-serif;
        font-size: xx-large;
        font-style: oblique;
      }
      nav {
        background-color: #f2f2f2;
        padding: 10px;
        overflow: hidden;
      }

      nav a {
        float: left;
        color: #333;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
      }

      nav a:hover {
        background-color: #ddd;
        color: #333;
      }

      nav a.active {
        background-color: #333;
        color: #fff;
      }

      .container {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
      }

      label {
        display: block;
        margin-bottom: 10px;
      }

      input[type="text"],
      input[type="email"],
      input[type="tel"],
      input[type="date"],
      textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type="submit"] {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #555;
      }
    </style>
</head>
<body>
    <header>
        <h1>Travel Guide</h1>
    </header>
    <nav>
        <a href="index.html">Home</a>
        <a class="active" href="packages.html">Packages</a>
        <a href="aboutus.html">About Us</a>
    </nav>

    <h2 style="text-align: center; text-decoration-color: #666">
        Travel Booking Form
    </h2>

    <div class="container">
        <form id="booking-form" method="POST" action="booking_form.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required />

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required onblur="calculateAge()" />

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" readonly />

            <label for="departure">Departure Date:</label>
            <input type="date" id="departure" name="departure" required />

            <label for="pickup">Pickup Address:</label>
            <textarea id="pickup" name="pickup" rows="4" required></textarea>

            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>

    <script>
        function showDobPopup() {
            alert("Please enter your date of birth (DD/MM/YYYY).");
        }
        
        function calculateAge() {
            const dobInput = document.getElementById("dob");
            const dob = dobInput.value;
            
            // Get the current date
            const currentDate = new Date();
            
            // Convert the entered date of birth to a Date object
            const dobDate = new Date(dob);
            
            // Calculate the age difference in milliseconds
            const ageDiff = currentDate - dobDate;
            
            // Convert the age difference to years
            const ageDate = new Date(ageDiff);
            const calculatedAge = Math.abs(ageDate.getUTCFullYear() - 1970);
            
            // Set the calculated age in the age field
            const ageInput = document.getElementById("age");
            ageInput.value = calculatedAge;
        }
        
        // JavaScript code
        document.addEventListener("DOMContentLoaded", () => {
            const bookingForm = document.getElementById("booking-form");
    
            bookingForm.addEventListener("submit", (event) => {
                event.preventDefault(); // Prevent form submission
    
                // Display confirmation popup
                const confirmed = confirm("Are you sure you want to submit the form?");
    
                if (confirmed) {
                    // Retrieve form data
                    const name = document.getElementById("name").value;
                    const email = document.getElementById("email").value;
                    const phone = document.getElementById("phone").value;
                    const dob = document.getElementById("dob").value;
                    const departure = document.getElementById("departure").value;
                    const pickup = document.getElementById("pickup").value;
    
                    // Do something with the form data
                    console.log("Name:", name);
                    console.log("Email:", email);
                    console.log("Phone Number:", phone);
                    console.log("Date of Birth:", dob);
                    console.log("Departure Date:", departure);
                    console.log("Pickup Address:", pickup);
    
                    // Clear the form fields
                    bookingForm.reset();
                }
            });
        });
    </script>
</body>
</html>

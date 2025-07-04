<!-- this is the page that shows up when the person who found the pet scans the qr -->
<!-- the person can send a message to the pet owner -->

<?php

// Include database
include 'db_connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get pet_id from URL
if (isset($_GET['pet_id'])) {
  $pet_id = $_GET['pet_id'];

  // Fetch pet details
  $sql = "SELECT * FROM pets WHERE id = $pet_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $pet = $result->fetch_assoc();
  }
  else {
    echo "Pet not found!";
    exit();
  }
}
  else {
  echo "Invalid QR code link.";
  exit();
  }

// Handle notification form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $finder_name = $_POST['finder_name'];
  $finder_contact = $_POST['finder_contact'];
  $message = $_POST['message'];

  // Save notification to DB
  $sql = "INSERT INTO notifications (pet_id, finder_name, finder_contact, message)
          VALUES ('$pet_id', '$finder_name', '$finder_contact', '$message')";
  $conn->query($sql);

  // Send email to owner
  $to = $pet['owner_email'];
  $subject = "Someone found your pet!";
  $body = "Dear Pet Owner,\n\n"
        . "Someone found your pet named " . $pet['pet_name'] . "!\n\n"
        . "Finder's Name: $finder_name\n"  
        . "Contact: $finder_contact\n"
        . "Message: $message\n\n"
        . "Please get in touch with them as soon as possible.";

  include 'send_notification.php';
  // sendEmail($to, $subject, $body);
    
  if (sendEmail($to, $subject, $body)) {
    echo "
        <!DOCTYPE html>
        <html>
        <head>
        <title>Notification Sent</title>
        <link rel='stylesheet' href='css/styleScan.css'>
            <style>
                .success-card {
                  max-width: 400px;
                  margin: 50px auto;
                  padding: 20px;
                  background: #e6ffe6;
                  border: 2px solid #00b300;
                  border-radius: 15px;
                  text-align: center;
                  box-shadow: 0 0 10px rgba(0,0,0,0.2);
                }
                .success-card h2 {
                  color: #008000;
                }
                .success-card p {
                  color: black;
                  font-size: 16px;
                }
                
                .success-card a {
                  text-decoration: none;
                  color: #ffffff;
                  background: #008000;
                  padding: 10px 20px;
                  border-radius: 8px;
                  display: inline-block;
                  margin-top: 20px;
                }
            </style>
        </head>
        <body>
              <div class='success-card'>
                <h2>🎉 Notification Sent!</h2>
                <p>The pet owner has been notified. Thank you for your help!</p>
                <a href='index.html'>Go Back to Home</a>
              </div>
            </body>
            </html>
            ";

}
  else {
    echo "<h3>Failed to send notification. Please try again later.</h3>";
  }

  $conn->close();
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Found Pet Details</title>
  <link rel="stylesheet" href="css/styleScan.css">
</head>
<body>
<div class="success-card">
  <h2>You found my <?php echo $pet['pet_name']; ?>!</h2>
  <h2>Please help us reunite</h2>
  <img src="<?php echo $pet['pet_photo']; ?>" alt="Pet Photo" style="max-width: 250px;"><br>

  <p><strong>Type:</strong> <?php echo $pet['pet_type']; ?></p>
  <p><strong>Breed:</strong> <?php echo $pet['pet_breed']; ?></p>
  <p><strong>Age:</strong> <?php echo $pet['pet_age']; ?></p>
  <?php if (!empty($pet['pet_allergies'])) { ?>
    <p><strong>Allergies:</strong> <?php echo $pet['pet_allergies']; ?></p>
  <?php } ?>

  <hr>

  <h3>Notify the Owner</h3>
  <form method="POST">
    <div class="form-group">
      <label>Your Name:</label> <br> <br>
      <input type="text" name="finder_name" required> <br> <br>
    </div>
    <div class="form-group">
      <label>Your Contact (Phone/Email):</label> <br> <br>
      <input type="text" name="finder_contact" required> <br> <br>
    </div>
    <div class="form-group">
      <label>Message:</label> <br> <br>
      <textarea name="message" rows="4" required></textarea> <br> <br>
    </div>
    <button type="submit" class="btn">Send Notification</button>
  </form>
</div>
</body>
</html>
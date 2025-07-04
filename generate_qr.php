<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database and QR code library
include 'db_connection.php';
include 'phpqrcode/qrlib.php';

// If form submitted, extract the data.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pet_name = $_POST['pet_name'];
  $pet_type = $_POST['pet_type'];
  $pet_breed = $_POST['pet_breed'];
  $pet_age = $_POST['pet_age'];

//this way no warning size if allergies weren't there
  $pet_allergies = isset($_POST['pet_allergies']) ? $_POST['pet_allergies'] : '';
  $owner_email = $_POST['owner_email'];

  // handle uploaded photo
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["pet_photo"]["name"]);
  move_uploaded_file($_FILES["pet_photo"]["tmp_name"], $target_file);

  // Insert into DB
  $sql = "INSERT INTO pets (pet_name, pet_type, pet_breed, pet_age, pet_allergies, pet_photo, owner_email)
          VALUES ('$pet_name', '$pet_type', '$pet_breed', '$pet_age', '$pet_allergies', '$target_file', '$owner_email')";

  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;

    // Generate QR Code
    $qr_content = "http://localhost/pettrackqr/scan.php?pet_id=" . $last_id;
    $qr_file = "uploads/qr_pet_" . $last_id . ".png";
    QRcode::png($qr_content, $qr_file, QR_ECLEVEL_L, 4);

    $conn->close();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pet Registered Successfully</title>
  <link rel="stylesheet" href="css/styleQR.css">
</head>
<body>
  <div class="success-card">
    <h2>Pet Registered Successfully!!</h2>
    <p>Your pet's unique QR code:</p>
    <img src="<?php echo $qr_file; ?>" alt="QR Code">

    <div class="qr-links">
      <a href="<?php echo $qr_file; ?>" download class="btn">Download QR Code</a>
      <a href="<?php echo $qr_content; ?>" target="_blank" class="btn btn-secondary">Test QR Code Link</a>
    </div>

    <a href="register.html" class="btn">Register Another Pet</a>
  </div>
</body>
</html>
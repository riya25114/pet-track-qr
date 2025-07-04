<!-- this file was just made to test whether the qr code function was working or not. -->

<?php
include 'phpqrcode/qrlib.php';

$qr_content = "Hello from Riya!";
$qr_file = "uploads/test_qr.png";

QRcode::png($qr_content, $qr_file, QR_ECLEVEL_L, 4);

if (file_exists($qr_file)) {
    echo "QR code generated successfully!";
} else {
    echo "QR code generation failed.";
}
?>
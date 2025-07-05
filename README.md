# 🐾 PetTrackQR: Lost Pet Finder System

A web-based application to help pet owners quickly reunite with their lost pets using scannable QR codes linked to their pet’s details and owner contact information.

### Overview:
PetTrackQR allows users to:
- Register their pet's details
- Upload a pet photo
- Generate a unique QR code linked to their pet profile
- Display pet details by scanning the QR code
- Notify the pet owner via email if their pet is found

### Features:
- Register pet with details like name, type, breed, age, allergies, photo, and owner’s email.
- Generate and download a QR code for each registered pet.
- Scan a pet's QR code to view their information and notify the owner.
- PHPMailer integration for instant email notifications.
- Light/Dark theme toggle on the homepage.
- Clean, modern UI with custom icons and styling.

### Technologies used:
- HTML5, CSS3
- PHP
- MySQL
- PHPMailer
- PHP QR Code Library
- XAMPP (for local development)

### Project Structure

    pettrackqr/
    ├── css/
    │   ├── styleIndex.css        # Home page styling
    │   ├── styleScan.css         # Scan & success page styling
    │   ├── styleQR.css           # generate_qr.php style page
    │   └── style.css             # Registration page styling
    ├── images/
    │   ├── rabbit.png
    │   └── dog.png
    ├── phpqrcode/                # QR code library
    ├── PHPMailer-master/         # PHPMailer library
    ├── uploads/                  # Pet image uploads
    ├── database.sql              # SQL file for pets & notifications tables
    ├── index.html                # Home / landing page
    ├── register.html             # Pet registration form
    ├── generate_qr.php           # QR code generation script
    ├── scan.php                  # Scan QR and show pet info + notify owner
    ├── send_notification.php     # PHPMailer email notification handler
    ├── db_connection.php         # Connection to the databse which can be included in every file
    └── README.md                 # Project documentation (this file)

### Database Tables:
table "pets"

    | Field         | Type                 |
    | id            | INT (Auto Increment) |
    | pet_name      | VARCHAR              |
    | pet_type      | VARCHAR              |
    | pet_breed     | VARCHAR              |
    | pet_age       | VARCHAR              |
    | pet_allergies | VARCHAR              |
    | pet_photo     | VARCHAR              |
    | owner_email   | VARCHAR              |

table "notifications"

    | Field           | Type                 |
    | id              | INT (Auto Increment) |
    | pet_id          | INT                  |
    | finder_name     | VARCHAR              |
    | finder_contact  | VARCHAR              |
    | message         | TEXT                 |
    | timestamp       | TIMESTAMP            |

### How It Works:
Register a Pet → Owner fills in pet details and uploads a photo.
Generate QR Code → A unique QR is generated linking to that pet’s `scan.php?pet_id=X`.
Scan the QR Code → Finder scans QR with their phone to access the pet's profile.
Notify the Owner → Finder submits their contact details and message.
Email Sent via PHPMailer → Owner receives notification with finder’s info.

### Email Configuration:
Uses PHPMailer with Gmail SMTP
- Requires a Gmail App Password for secure mailing.
- Update your Gmail and app password inside `send_notification.php`:
    $mail->Username = 'your_email@gmail.com';
    $mail->Password = 'your_app_password';

## License
- This project is created for academic and learning purposes.
- Feel free to fork and improve it for personal or educational use.

## Developed by
- Riya Garg
- Computer Engineering Student
- riyagarg1215@gmail.com

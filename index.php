
<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "company_job_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$error = "";

// Submit application
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $address = trim($_POST['address']);
    $cover_letter = trim($_POST['cover_letter']);

    if (
        empty($full_name) || empty($email) ||
        empty($phone) || empty($position)
    ) {
        $error = "Please fill in all required fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO job_applications
            (full_name, email, phone, gender,
            position_applied, education_level,
            experience, address, cover_letter)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssssssss",
            $full_name,
            $email,
            $phone,
            $gender,
            $position,
            $education,
            $experience,
            $address,
            $cover_letter
        );

        if ($stmt->execute()) {
            $_SESSION['success'] =
                "Congratulations! Your job application has been submitted successfully. Thank you for applying.";

            header("Location: index.php");
            exit();

        } else {
            $error = "Application failed. Please try again.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Company Job Application</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(135deg, #dceeff, #f5f9ff);
    margin: 0;
    padding: 35px 15px;
    color: #24364b;
}

/* Main container */

.container {
    width: 600px;
    max-width: 100%;
    margin: auto;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(20, 70, 120, 0.15);
}

/* Header */

.header {
    background: linear-gradient(135deg, #073b70, #1684d4);
    color: white;
    text-align: center;
    padding: 30px 20px;
}

.header h2 {
    margin: 0;
    font-size: 26px;
    letter-spacing: 1px;
}

.header p {
    color: #e2f1ff;
    margin-top: 10px;
    font-size: 14px;
}

/* Form area */

.form-content {
    padding: 30px;
}

.section-title {
    color: #07549a;
    font-size: 18px;
    font-weight: bold;
    border-bottom: 2px solid #dceeff;
    padding-bottom: 10px;
    margin-top: 10px;
}

/* Labels */

label {
    display: block;
    margin-top: 18px;
    margin-bottom: 7px;
    font-weight: 600;
    color: #24415f;
    font-size: 14px;
}

/* Input fields */

input, select, textarea {
    width: 100%;
    padding: 13px;
    border: 1px solid #cbd9e8;
    border-radius: 8px;
    background: #f8fbff;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #1684d4;
    background: white;
    box-shadow: 0 0 0 3px rgba(22, 132, 212, 0.12);
}

input::placeholder,
textarea::placeholder {
    color: #9aa9b9;
}

textarea {
    height: 110px;
    resize: vertical;
}

/* Submit button */

button {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #07549a, #1684d4);
    color: white;
    border: none;
    border-radius: 8px;
    margin-top: 28px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    letter-spacing: 0.5px;
}

button:hover {
    background: linear-gradient(135deg, #06345e, #086ab5);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(7, 84, 154, 0.25);
}

/* Error message */

.error {
    background: #ffe6e6;
    color: #b00020;
    padding: 13px;
    border-left: 4px solid #d93025;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 14px;
}

/* Footer */

.footer {
    text-align: center;
    padding: 18px;
    background: #f0f7ff;
    color: #627d98;
    font-size: 12px;
}

/* Mobile responsive */

@media (max-width: 600px) {

    body {
        padding: 15px 10px;
    }

    .form-content {
        padding: 20px;
    }

    .header h2 {
        font-size: 21px;
    }
}

</style>

</head>

<body>

<div class="container">

    <div class="header">

        <h2>COMPANY JOB APPLICATION</h2>

        <p>Build Your Future With Us</p>

    </div>

    <div class="form-content">

        <h3 class="section-title">Personal Information</h3>

        <?php if (!empty($error)): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">

            <label>Full Name *</label>

            <input type="text" name="full_name"
            placeholder="Enter your full name" required>

            <label>Email Address *</label>

            <input type="email" name="email"
            placeholder="Enter your email address" required>

            <label>Phone Number *</label>

            <input type="tel" name="phone"
            placeholder="Enter your phone number" required>

            <label>Gender</label>

            <select name="gender">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <h3 class="section-title">
                Job Information
            </h3>

            <label>Position Applying For *</label>

            <select name="position" required>
                <option value="">Select Position</option>
                <option value="Accountant">Accountant</option>
                <option value="IT Officer">IT Officer</option>
                <option value="Human Resource Officer">Human Resource Officer</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Security Officer">Security Officer</option>
                <option value="Driver">Driver</option>
                <option value="Sales Representative">Sales Representative</option>
                <option value="Manager">Manager</option>
                <option value="General Worker">General Worker</option>
            </select>

            <label>Education Level</label>

            <select name="education">
                <option value="">Select Education Level</option>
                <option value="KCSE">KCSE</option>
                <option value="Certificate">Certificate</option>
                <option value="Diploma">Diploma</option>
                <option value="Degree">Degree</option>
                <option value="Masters">Masters</option>
                <option value="Other">Other</option>
            </select>

            <label>Work Experience</label>

            <select name="experience">
                <option value="">Select Experience</option>
                <option value="No Experience">No Experience</option>
                <option value="Less than 1 year">Less than 1 year</option>
                <option value="1-3 years">1-3 years</option>
                <option value="4-6 years">4-6 years</option>
                <option value="Above 6 years">Above 6 years</option>
            </select>

            <label>Residential Address</label>

            <input type="text" name="address"
            placeholder="Enter your residential address">

            <h3 class="section-title">
                Additional Information
            </h3>

            <label>Cover Letter</label>

            <textarea name="cover_letter"
            placeholder="Tell us why you are interested in this position..."></textarea>

            <button type="submit">
                SUBMIT APPLICATION
            </button>

        </form>

    </div>

    <div class="footer">
        © 2026 Company Recruitment System. All Rights Reserved.
    </div>

</div>

<?php

if (isset($_SESSION['success'])) {

    echo "<script>
        alert(" . json_encode($_SESSION['success']) . ");
    </script>";

    unset($_SESSION['success']);
}

?>

</body>
</html>

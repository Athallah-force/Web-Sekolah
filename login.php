<?php
session_start();
require_once 'koneksi_login.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from POST
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $db = new Database();

    // Query to find user with matching username and password
    $query = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($db->koneksi, $username) . "' AND password = '" . mysqli_real_escape_string($db->koneksi, $password) . "' LIMIT 1";
    $result = mysqli_query($db->koneksi, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Successful login
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'] ?? ''; // Store role in session
        header("Location: index.php"); // Redirect to profile or dashboard page
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --error-color: #ef233c;
            --light-gray: #f8f9fa;
            --dark-gray: #6c757d;
            --white: #ffffff;
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        
        .login-container {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--primary-color);
        }
        
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .logo img {
            height: 50px;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-gray);
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .btn {
            width: 100%;
            background: var(--primary-color);
            color: var(--white);
            padding: 0.9rem;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .error-message {
            color: var(--error-color);
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 0.8rem;
            background-color: rgba(239, 35, 60, 0.1);
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .additional-links {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .additional-links a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .additional-links a:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--dark-gray);
            font-size: 0.8rem;
        }
        
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
                margin: 0 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <!-- Replace with your logo -->
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#4361ee" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
        </div>
        <h2>Silakan Login Untuk Melanjutkan</h2>
        
        <?php if ($message): ?>
            <div class="error-message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Nama</label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan Nama Anda">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password Anda">
            </div>
            
            <button type="submit" class="btn">Login</button>
            
        </form>
    </div>
</body>
</html>
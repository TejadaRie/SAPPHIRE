<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'Sapphireweb';
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

// Create connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$error = '';
$success = '';

// Handle Registration
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if username or email already exists
        $check_query = "SELECT id FROM users WHERE username = ? OR email = ?";
        $check_stmt = $pdo->prepare($check_query);
        $check_stmt->execute([$username, $email]);
        
        if ($check_stmt->rowCount() > 0) {
            $error = "Username or email already exists";
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $insert_stmt = $pdo->prepare($insert_query);
            
            if ($insert_stmt->execute([$username, $email, $hashed_password])) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $username_email = trim($_POST['username_email']);
    $password = $_POST['password'];
    
    if (empty($username_email) || empty($password)) {
        $error = "Please enter username/email and password";
    } else {
        // Check user credentials
        $login_query = "SELECT id, username, email, password FROM users WHERE username = ? OR email = ?";
        $login_stmt = $pdo->prepare($login_query);
        $login_stmt->execute([$username_email, $username_email]);
        
        if ($login_stmt->rowCount() == 1) {
            $user = $login_stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;
                
                // Redirect to admin.php
                header("Location: admin.php");
                exit();
            } else {
                $error = "Invalid password";
            }
        } else {
            $error = "User not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration - Sapphireweb</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 400px;
            max-width: 90%;
            padding: 40px;
        }
        
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .tab-buttons {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .tab-button {
            flex: 1;
            padding: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            transition: all 0.3s;
        }
        
        .tab-button.active {
            color: #667eea;
            border-bottom: 2px solid #667eea;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        button[type="submit"]:hover {
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-error {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
        
        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }
        
        .form-tab {
            display: none;
        }
        
        .form-tab.active {
            display: block;
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }
        
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Sapphireweb</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <div class="tab-buttons">
            <button class="tab-button active" onclick="showTab('login')">Login</button>
            <button class="tab-button" onclick="showTab('register')">Register</button>
        </div>
        
        <!-- Login Form -->
        <div id="login-tab" class="form-tab active">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="login-username">Username or Email</label>
                    <input type="text" id="login-username" name="username_email" required>
                </div>
                
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                
                <button type="submit" name="login">Login</button>
                
                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
        
        <!-- Registration Form -->
        <div id="register-tab" class="form-tab">
            <form method="POST" action="" onsubmit="return validatePassword()">
                <div class="form-group">
                    <label for="reg-username">Username</label>
                    <input type="text" id="reg-username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="reg-password">Password (min. 6 characters)</label>
                    <input type="password" id="reg-password" name="password" required minlength="6">
                </div>
                
                <div class="form-group">
                    <label for="reg-confirm-password">Confirm Password</label>
                    <input type="password" id="reg-confirm-password" name="confirm_password" required>
                </div>
                
                <button type="submit" name="register">Register</button>
            </form>
        </div>
    </div>
    
    <script>
        function showTab(tab) {
            const tabs = document.querySelectorAll('.form-tab');
            const buttons = document.querySelectorAll('.tab-button');
            
            if (tab === 'login') {
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
                buttons[0].classList.add('active');
                buttons[1].classList.remove('active');
            } else {
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
                buttons[0].classList.remove('active');
                buttons[1].classList.add('active');
            }
        }
        
        function validatePassword() {
            const password = document.getElementById('reg-password').value;
            const confirmPassword = document.getElementById('reg-confirm-password').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
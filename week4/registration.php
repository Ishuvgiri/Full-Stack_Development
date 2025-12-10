<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 14px; margin-top: 5px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .error-box { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>

<?php
$errors = [];
$success = '';
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($name)) {
        $errors['name'] = 'Name is required';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    } else {
        $jsonFile = 'users.json';
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $users = json_decode($jsonData, true);
            if (is_array($users)) {
                foreach ($users as $user) {
                    if (isset($user['email']) && strtolower($user['email']) === strtolower($email)) {
                        $errors['email'] = 'This email is already registered';
                        break;
                    }
                }
            }
        }
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must contain uppercase, lowercase, and numbers';
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'Please confirm your password';
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($errors)) {
        $jsonFile = 'users.json';
        
        try {
            if (!file_exists($jsonFile)) {
                file_put_contents($jsonFile, '[]');
            }

            $jsonData = file_get_contents($jsonFile);
            if ($jsonData === false) {
                throw new Exception('Failed to read users file');
            }

            $users = json_decode($jsonData, true);
            if ($users === null) {
                $users = [];
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $newUser = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword
            ];

            $users[] = $newUser;

            $jsonOutput = json_encode($users, JSON_PRETTY_PRINT);
            if (file_put_contents($jsonFile, $jsonOutput) === false) {
                throw new Exception('Failed to save user data');
            }

            $success = 'Registration successful!';
            $name = '';
            $email = '';

        } catch (Exception $e) {
            $errors['general'] = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<?php if ($success): ?>
    <div class="success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<?php if (!empty($errors['general'])): ?>
    <div class="error-box"><?php echo htmlspecialchars($errors['general']); ?></div>
<?php endif; ?>

<h2>User Registration</h2>

<form method="POST" action="">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="error"><?php echo htmlspecialchars($errors['name']); ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <?php if (!empty($errors['email'])): ?>
            <div class="error"><?php echo htmlspecialchars($errors['email']); ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <?php if (!empty($errors['password'])): ?>
            <div class="error"><?php echo htmlspecialchars($errors['password']); ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <?php if (!empty($errors['confirm_password'])): ?>
            <div class="error"><?php echo htmlspecialchars($errors['confirm_password']); ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Register</button>
</form>

</body>
</html>

<?php
// PART 2 — Add Student Info Page (add_student.php)

// Custom Functions

/**
 * Format name: Trim whitespace and capitalize first letter of each word
 */
function formatName($name) {
    $name = trim($name);
    $name = ucwords(strtolower($name));
    return $name;
}

/**
 * Validate email using filter_var and check for common patterns
 */
function validateEmail($email) {
    $email = trim($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

/**
 * Clean skills string: Remove extra spaces, special characters
 */
function cleanSkills($string) {
    $string = trim($string);
    // Remove multiple spaces
    $string = preg_replace('/\s+/', ' ', $string);
    // Remove special characters except commas and spaces
    $string = preg_replace('/[^a-zA-Z0-9,\s\+\#\-]/', '', $string);
    return $string;
}

/**
 * Save student information to students.txt file
 */
function saveStudent($name, $email, $skillsArray) {
    try {
        $filename = 'students.txt';
        
        // Convert skills array to comma-separated string
        $skillsString = implode(',', $skillsArray);
        
        // Create data line: name|email|skills
        $data = $name . '|' . $email . '|' . $skillsString . PHP_EOL;
        
        // Append to file
        $result = file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
        
        if ($result === false) {
            throw new Exception("Failed to write to file.");
        }
        
        return true;
    } catch (Exception $e) {
        throw new Exception("Error saving student: " . $e->getMessage());
    }
}

// Handle form submission
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $skills = $_POST['skills'] ?? '';
        
        // Validate inputs
        if (empty($name) || empty($email) || empty($skills)) {
            throw new Exception("All fields are required!");
        }
        
        // Format name
        $name = formatName($name);
        
        // Validate name length
        if (strlen($name) < 2) {
            throw new Exception("Name must be at least 2 characters long!");
        }
        
        // Validate email
        if (!validateEmail($email)) {
            throw new Exception("Invalid email address!");
        }
        
        // Clean and process skills
        $skills = cleanSkills($skills);
        
        if (empty($skills)) {
            throw new Exception("Please enter at least one skill!");
        }
        
        // Convert skills string into array using explode()
        $skillsArray = explode(',', $skills);
        
        // Clean each skill in array
        $skillsArray = array_map('trim', $skillsArray);
        
        // Remove empty skills
        $skillsArray = array_filter($skillsArray);
        
        if (count($skillsArray) === 0) {
            throw new Exception("Please enter at least one valid skill!");
        }
        
        // Save student info
        saveStudent($name, $email, $skillsArray);
        
        $success = "Student information saved successfully! " . count($skillsArray) . " skill(s) added.";
        
        // Clear form
        $_POST = array();
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once 'header.php';
?>

<h2 style="color: #667eea; margin-bottom: 20px;">➕ Add Student Information</h2>

<?php if ($success): ?>
    <div class="success">
        <strong>Success!</strong> <?php echo htmlspecialchars($success); ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error">
        <strong>Error!</strong> <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<form method="POST" action="" style="max-width: 600px;">
    <div class="form-group">
        <label for="name">Student Name *</label>
        <input 
            type="text" 
            id="name" 
            name="name" 
            placeholder="Enter student full name"
            value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
            required
        >
        <small style="color: #666;">Example: John Smith</small>
    </div>
    
    <div class="form-group">
        <label for="email">Email Address *</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            placeholder="student@example.com"
            value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
            required
        >
        <small style="color: #666;">Valid email address required</small>
    </div>
    
    <div class="form-group">
        <label for="skills">Skills (comma-separated) *</label>
        <textarea 
            id="skills" 
            name="skills" 
            rows="4"
            placeholder="Enter skills separated by commas"
            required
        ><?php echo isset($_POST['skills']) ? htmlspecialchars($_POST['skills']) : ''; ?></textarea>
        <small style="color: #666;">Example: PHP, JavaScript, HTML, CSS, MySQL</small>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn">💾 Save Student</button>
        <a href="index.php" class="btn" style="background: #6c757d; margin-left: 10px;">← Back to Home</a>
    </div>
</form>

<div style="margin-top: 40px; padding: 20px; background: #e7f3ff; border-left: 4px solid #2196F3; border-radius: 5px;">
    <h3 style="color: #2196F3; margin-bottom: 10px;">ℹ️ Information</h3>
    <ul style="margin-left: 20px; color: #555;">
        <li>All fields are required</li>
        <li>Name will be automatically formatted (capitalized)</li>
        <li>Email must be a valid email address</li>
        <li>Skills should be separated by commas</li>
        <li>Data is saved to <code>students.txt</code> file</li>
    </ul>
</div>

<?php
require_once 'footer.php';
?>

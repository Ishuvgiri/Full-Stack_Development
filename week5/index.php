<?php
// PART 1 — Homepage (index.php)
require_once 'header.php';
?>

<div style="text-align: center; padding: 40px 0;">
    <h2 style="color: #667eea; font-size: 2em; margin-bottom: 20px;">Welcome to Student Portfolio Manager!</h2>
    <p style="font-size: 1.2em; color: #666; margin-bottom: 40px;">
        Manage student information, skills, and portfolio files all in one place.
    </p>
    
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; width: 250px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 15px; font-size: 1.5em;">➕ Add Student</h3>
            <p style="margin-bottom: 20px;">Add new student information with name, email, and skills.</p>
            <a href="add_student.php" class="btn" style="background: white; color: #667eea;">Go to Add Student</a>
        </div>
        
        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 30px; border-radius: 10px; width: 250px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 15px; font-size: 1.5em;">📤 Upload File</h3>
            <p style="margin-bottom: 20px;">Upload portfolio files (PDF, JPG, PNG) up to 2MB.</p>
            <a href="upload.php" class="btn" style="background: white; color: #f5576c;">Go to Upload</a>
        </div>
        
        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 30px; border-radius: 10px; width: 250px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h3 style="margin-bottom: 15px; font-size: 1.5em;">👥 View Students</h3>
            <p style="margin-bottom: 20px;">View all registered students and their information.</p>
            <a href="students.php" class="btn" style="background: white; color: #00f2fe;">View Students</a>
        </div>
    </div>
</div>

<div style="margin-top: 50px; background: #f8f9fa; padding: 30px; border-radius: 10px;">
    <h3 style="color: #667eea; margin-bottom: 15px;">📋 Features</h3>
    <ul style="list-style: none; padding: 0;">
        <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">✅ Student information management</li>
        <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">✅ Skills tracking with array handling</li>
        <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">✅ Secure file uploads with validation</li>
        <li style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">✅ Error handling and data validation</li>
        <li style="padding: 10px 0;">✅ File storage and retrieval</li>
    </ul>
</div>

<?php
require_once 'footer.php';
?>

<?php
// PART 4 — View Students Page (students.php)

/**
 * Read and parse students from students.txt file
 */
function getStudents() {
    $students = [];
    $filename = 'students.txt';
    
    try {
        // Check if file exists
        if (!file_exists($filename)) {
            return $students;
        }
        
        // Read file contents
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if ($lines === false) {
            throw new Exception("Failed to read students file!");
        }
        
        // Parse each line
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            
            if (count($parts) === 3) {
                $name = trim($parts[0]);
                $email = trim($parts[1]);
                $skillsString = trim($parts[2]);
                
                // Convert skills string back to array
                $skillsArray = explode(',', $skillsString);
                $skillsArray = array_map('trim', $skillsArray);
                $skillsArray = array_filter($skillsArray);
                
                $students[] = [
                    'name' => $name,
                    'email' => $email,
                    'skills' => $skillsArray
                ];
            }
        }
        
    } catch (Exception $e) {
        // Handle error silently or log it
    }
    
    return $students;
}

require_once 'header.php';

// Get all students
$students = getStudents();
$totalStudents = count($students);
?>

<h2 style="color: #667eea; margin-bottom: 20px;">👥 View Students</h2>

<?php if ($totalStudents > 0): ?>
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        <strong>Total Students:</strong> <?php echo $totalStudents; ?>
    </div>
    
    <?php foreach ($students as $index => $student): ?>
        <div class="student-card">
            <h3>
                <?php echo ($index + 1); ?>. <?php echo htmlspecialchars($student['name']); ?>
            </h3>
            
            <p>
                <strong>📧 Email:</strong> 
                <a href="mailto:<?php echo htmlspecialchars($student['email']); ?>" style="color: #667eea; text-decoration: none;">
                    <?php echo htmlspecialchars($student['email']); ?>
                </a>
            </p>
            
            <div style="margin-top: 15px;">
                <strong>🎯 Skills (<?php echo count($student['skills']); ?>):</strong>
                <div class="skills">
                    <?php foreach ($student['skills'] as $skill): ?>
                        <span class="skill-tag">
                            <?php echo htmlspecialchars($skill); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    
    <div style="margin-top: 30px; padding: 20px; background: #e7f3ff; border-left: 4px solid #2196F3; border-radius: 5px;">
        <h3 style="color: #2196F3; margin-bottom: 10px;">📊 Statistics</h3>
        <?php
        // Calculate some statistics
        $totalSkills = 0;
        $allSkills = [];
        foreach ($students as $student) {
            $totalSkills += count($student['skills']);
            $allSkills = array_merge($allSkills, $student['skills']);
        }
        $uniqueSkills = array_unique($allSkills);
        $avgSkills = $totalStudents > 0 ? round($totalSkills / $totalStudents, 1) : 0;
        ?>
        <ul style="list-style: none; padding: 0; color: #555;">
            <li style="padding: 5px 0;">📈 Total Skills Listed: <?php echo $totalSkills; ?></li>
            <li style="padding: 5px 0;">🔢 Unique Skills: <?php echo count($uniqueSkills); ?></li>
            <li style="padding: 5px 0;">📊 Average Skills per Student: <?php echo $avgSkills; ?></li>
        </ul>
    </div>
    
    <?php if (count($uniqueSkills) > 0): ?>
        <div style="margin-top: 20px; padding: 20px; background: #f8f9fa; border-radius: 5px;">
            <h3 style="color: #667eea; margin-bottom: 15px;">🏆 All Unique Skills</h3>
            <div class="skills">
                <?php foreach ($uniqueSkills as $skill): ?>
                    <span class="skill-tag" style="background: #764ba2;">
                        <?php echo htmlspecialchars($skill); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    
<?php else: ?>
    <div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 10px;">
        <div style="font-size: 4em; margin-bottom: 20px;">📭</div>
        <h3 style="color: #666; margin-bottom: 15px;">No Students Found</h3>
        <p style="color: #999; margin-bottom: 30px;">
            There are no students registered yet. Start by adding your first student!
        </p>
        <a href="add_student.php" class="btn">➕ Add First Student</a>
    </div>
<?php endif; ?>

<div style="margin-top: 30px; text-align: center;">
    <a href="add_student.php" class="btn">➕ Add New Student</a>
    <a href="index.php" class="btn" style="background: #6c757d; margin-left: 10px;">🏠 Back to Home</a>
</div>

<div style="margin-top: 40px; padding: 20px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">
    <h3 style="color: #856404; margin-bottom: 10px;">ℹ️ About This Page</h3>
    <ul style="margin-left: 20px; color: #555;">
        <li>Student data is read from <code>students.txt</code> file</li>
        <li>Each student's skills are displayed as an array of tags</li>
        <li>Statistics are calculated dynamically from the data</li>
        <li>Data format: <code>Name | Email | Skill1,Skill2,Skill3</code></li>
    </ul>
</div>

<?php
require_once 'footer.php';
?>

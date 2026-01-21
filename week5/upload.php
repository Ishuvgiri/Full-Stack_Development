<?php
// PART 3 — Upload Portfolio File (upload.php)

/**
 * Upload portfolio file with validation
 */
function uploadPortfolioFile($file) {
    try {
        // Check if file was uploaded
        if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception("No file was uploaded!");
        }
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new Exception("File size exceeds the maximum limit of 2MB!");
                case UPLOAD_ERR_PARTIAL:
                    throw new Exception("File was only partially uploaded!");
                default:
                    throw new Exception("An error occurred during file upload!");
            }
        }
        
        // Get file information
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileTmpName = $file['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        $maxSize = 2 * 1024 * 1024;
        if ($fileSize > $maxSize) {
            throw new Exception("File size exceeds 2MB limit! Your file is " . round($fileSize / 1024 / 1024, 2) . "MB");
        }
        
        // Validate file type - Accept only PDF, JPG, PNG
        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type! Only PDF, JPG, and PNG files are allowed.");
        }
        
        // Validate MIME type for additional security
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $fileTmpName);
        finfo_close($finfo);
        
        $allowedMimes = [
            'application/pdf',
            'image/jpeg',
            'image/png'
        ];
        
        if (!in_array($mimeType, $allowedMimes)) {
            throw new Exception("Invalid file format detected!");
        }
        
        // Create uploads directory if it doesn't exist
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Failed to create uploads directory!");
            }
        }
        
        // Check if directory is writable
        if (!is_writable($uploadDir)) {
            throw new Exception("Uploads directory is not writable!");
        }
        
        // Rename file using string functions
        // Format: portfolio_YYYYMMDD_HHMMSS_originalname.ext
        $timestamp = date('Ymd_His');
        $originalName = pathinfo($fileName, PATHINFO_FILENAME);
        // Clean original name - remove special characters
        $originalName = preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName);
        $originalName = substr($originalName, 0, 30); // Limit length
        
        $newFileName = 'portfolio_' . $timestamp . '_' . $originalName . '.' . $fileType;
        $destination = $uploadDir . $newFileName;
        
        // Move uploaded file
        if (!move_uploaded_file($fileTmpName, $destination)) {
            throw new Exception("Failed to move uploaded file!");
        }
        
        // Return success info
        return [
            'success' => true,
            'filename' => $newFileName,
            'path' => $destination,
            'size' => $fileSize,
            'type' => $fileType
        ];
        
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

// Handle file upload
$success = '';
$error = '';
$uploadInfo = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check if file was submitted
        if (!isset($_FILES['portfolio_file'])) {
            throw new Exception("No file input found!");
        }
        
        // Upload the file
        $uploadInfo = uploadPortfolioFile($_FILES['portfolio_file']);
        
        $success = "File uploaded successfully!";
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once 'header.php';
?>

<h2 style="color: #667eea; margin-bottom: 20px;">📤 Upload Portfolio File</h2>

<?php if ($success): ?>
    <div class="success">
        <strong>Success!</strong> <?php echo htmlspecialchars($success); ?>
        <?php if ($uploadInfo): ?>
            <div style="margin-top: 10px; padding-top: 10px; border-top: 1px solid #c3e6cb;">
                <strong>File Details:</strong><br>
                📄 Filename: <?php echo htmlspecialchars($uploadInfo['filename']); ?><br>
                📂 Location: <?php echo htmlspecialchars($uploadInfo['path']); ?><br>
                📏 Size: <?php echo round($uploadInfo['size'] / 1024, 2); ?> KB<br>
                📋 Type: <?php echo strtoupper($uploadInfo['type']); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="error">
        <strong>Error!</strong> <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<form method="POST" action="" enctype="multipart/form-data" style="max-width: 600px;">
    <div class="form-group">
        <label for="portfolio_file">Select Portfolio File *</label>
        <input 
            type="file" 
            id="portfolio_file" 
            name="portfolio_file" 
            accept=".pdf,.jpg,.jpeg,.png"
            required
            style="padding: 10px; border: 2px dashed #667eea; background: #f8f9fa; cursor: pointer;"
        >
        <small style="color: #666;">
            Accepted formats: PDF, JPG, PNG | Maximum size: 2MB
        </small>
    </div>
    
    <div style="margin-top: 20px;">
        <button type="submit" class="btn">📤 Upload File</button>
        <a href="index.php" class="btn" style="background: #6c757d; margin-left: 10px;">← Back to Home</a>
    </div>
</form>

<div style="margin-top: 40px; padding: 20px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">
    <h3 style="color: #856404; margin-bottom: 10px;">⚠️ Upload Requirements</h3>
    <ul style="margin-left: 20px; color: #555;">
        <li><strong>File Types:</strong> Only PDF, JPG, and PNG files are accepted</li>
        <li><strong>File Size:</strong> Maximum 2MB per file</li>
        <li><strong>Naming:</strong> Files will be automatically renamed with timestamp</li>
        <li><strong>Storage:</strong> Files are stored in the <code>/uploads/</code> directory</li>
        <li><strong>Security:</strong> File type and MIME type validation is performed</li>
    </ul>
</div>

<div style="margin-top: 20px; padding: 20px; background: #e7f3ff; border-left: 4px solid #2196F3; border-radius: 5px;">
    <h3 style="color: #2196F3; margin-bottom: 10px;">📋 File Naming Convention</h3>
    <p style="color: #555;">
        Uploaded files are renamed using the following format:<br>
        <code style="background: #f8f9fa; padding: 5px 10px; border-radius: 3px; display: inline-block; margin-top: 10px;">
            portfolio_YYYYMMDD_HHMMSS_originalname.ext
        </code>
    </p>
    <p style="color: #555; margin-top: 10px;">
        <strong>Example:</strong> <code>portfolio_20251222_143025_resume.pdf</code>
    </p>
</div>

<?php
require_once 'footer.php';
?>

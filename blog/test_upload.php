<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];
        $imageName = basename($image['name']);
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $imageName;

        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully to: $targetFilePath";
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload error. Code: " . $_FILES['image']['error'];
    }
}
?>
<form action="test_upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" id="image">
    <button type="submit">Test Upload</button>
</form>

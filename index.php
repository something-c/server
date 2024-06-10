<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Sharing Site</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        .files {
            margin-top: 20px;
        }
        .files li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>File Sharing Site</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $uploadDirectory = 'uploads/';
        $uploadFile = $uploadDirectory . basename($_FILES['file']['name']);

        // Check if the uploads directory exists, if not, create it
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo "<p>File is valid, and was successfully uploaded.</p>";
        } else {
            echo "<p>File upload failed.</p>";
        }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Upload a file:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Upload</button>
    </form>
    <h2>Available Files:</h2>
    <ul class="files">
        <?php
        $files = array_diff(scandir('uploads'), array('.', '..'));
        foreach ($files as $file) {
            echo "<li><a href='uploads/$file' download>$file</a></li>";
        }
        ?>
    </ul>
</body>
</html>

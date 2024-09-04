<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Featured Image</title>
</head>
<body>
    <h1>Upload Featured Image</h1>
    <form action="uploadFeaturedImageHandler.php" method="post" enctype="multipart/form-data">
        <label for="featured_image">Select image to upload:</label>
        <input type="file" name="featured_image" id="featured_image" required>
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>

<?php
include('includes/head.php');
include('includes/config.php');
$msg = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM courses WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $course = mysqli_fetch_assoc($result);

    if (!$course) {
        $msg = "<div class='alert alert-danger'>Course not found.</div>";
        exit;
    }
} else {
    $msg = "<div class='alert alert-danger'>Invalid request.</div>";
    exit;
}

if (isset($_POST['update_course'])) {
    $name = $_POST['name'];
    $instructor = $_POST['instructor'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $thumbnailPath = $course['thumbnail'];
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnailPath = 'uploads/' . basename($_FILES['thumbnail']['name']);
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailPath);
    }

    $updateQuery = "UPDATE courses SET name = ?, instructor = ?, price = ?, description = ?, thumbnail = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssdssi", $name, $instructor, $price, $description, $thumbnailPath, $id);
    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Course updated successfully.</div>";
        header('location:courses.php');
    } else {
        $msg = "<div class='alert alert-danger'>Error updating course: " . $conn->error . "</div>";
    }
    exit;
}
?>


<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Course</h1>

                    <form method="POST" enctype="multipart/form-data" action="#">
    <div class="mb-3">
        <label for="name" class="form-label">Course Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $course['name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="instructor" class="form-label">Instructor</label>
        <input type="text" class="form-control" id="instructor" name="instructor" value="<?php echo $course['instructor']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="<?php echo $course['price']; ?>" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Course Description</label>
        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $course['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="thumbnail" class="form-label">Update Thumbnail (Optional)</label>
        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
        <img src="<?php echo $course['thumbnail']; ?>" alt="Current Thumbnail" style="width: 100px; margin-top: 10px;">
    </div>
    <button type="submit" class="btn btn-primary" name="update_course">Update Course</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>
</body>

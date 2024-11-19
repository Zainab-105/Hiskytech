<?php
include('includes/connection.php');
include('includes/head.php');

// Fetch existing service data
if (isset($_GET['id'])) {
    $serviceId = $_GET['id'];
    $serviceQuery = "SELECT * FROM services WHERE id = $serviceId";
    $serviceResult = mysqli_query($conn, $serviceQuery);
    $service = mysqli_fetch_assoc($serviceResult);

    $languageIconsQuery = "SELECT * FROM language_icons WHERE service_id = $serviceId";
    $languageIconsResult = mysqli_query($conn, $languageIconsQuery);
} else {
    echo "Invalid service ID.";
    exit;
}
?>

<body>
<div id="wrapper">
    <?php include('includes/sidebar.php') ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include('includes/nav.php'); ?>
            <div class="container-fluid">
                <h1 class="h3 mb-0 text-gray-800">Edit Service</h1>
                
                <form action="update_service.php?id=<?php echo $serviceId; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Service Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $service['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="icon">Current Icon:</label>
                        <img src="<?php echo $service['icon']; ?>" alt="Service Icon" width="100">
                        <label for="icon">Upload New Icon:</label>
                        <input type="file" id="icon" name="icon" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Service Description:</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required><?php echo $service['description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="heading">Service Heading:</label>
                        <input type="text" id="heading" name="heading" class="form-control" value="<?php echo $service['heading']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="language_icons">Current Language Icons:</label><br>
                        <?php while ($icon = mysqli_fetch_assoc($languageIconsResult)) { ?>
                            <img src="<?php echo $icon['image_path']; ?>" width="50" alt="Language Icon">
                        <?php } ?>
                        <label for="language_icons">Upload New Language Icons:</label>
                        <input type="file" id="language_icons" name="language_icons[]" class="form-control-file" accept="image/*" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>
</body>

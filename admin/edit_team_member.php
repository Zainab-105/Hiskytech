<?php
include('includes/head.php');
include('includes/config.php');
$msg='';
// Fetch the member details based on the `id` passed via GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM team_members WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $member = mysqli_fetch_assoc($query);

    if (!$member) {
        echo "No member found with ID $id";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $profile_image = $member['profile_image']; 
    if (!empty($_FILES['profile_image']['name'])) {
        $image_name = time() . '_' . $_FILES['profile_image']['name'];
        $target_dir = "uploads/team_members/";
        $target_file = $target_dir . basename($image_name);


        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $profile_image = $target_file;
        } else {
            echo "Failed to upload image.";
        }
    }


    $update_sql = "UPDATE team_members SET name='$name', role='$role', profile_image='$profile_image' WHERE id=$id";
    if (mysqli_query($conn, $update_sql)) {
        header('location:index.php');
   $msg = '<div class="alert alert-success">Data Updated successfully.<a href="index.php">View Updated Data</a></div>';;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<body id="page-top">
    <div id="wrapper">
        <?php include('includes/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('includes/nav.php'); ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Team Member</h1>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo $member['name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" id="role" class="form-control" value="<?php echo $member['role']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="profile_image">Profile Image</label><br>
                            <img src="<?php echo $member['profile_image']; ?>" alt="Profile Image" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">
                            <input type="file" name="profile_image" id="profile_image" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Member</button>
                        <a href="team_members_list.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>
</body>

<?php 
$team_members = [];  // Array to store all team members and their social media links

$sql = "SELECT * FROM team_members";
$query = mysqli_query($conn, $sql);
if ($query) {
    while ($row = mysqli_fetch_array($query)) {
        $member = [
            'name' => $row['name'],
            'role' => $row['role'],
            'profile_image' => $row['profile_image'],
            'linkedin_url' => $row['linkedin_url'],
            'facebook_url' => $row['facebook_url'],  // Fetch the actual URL
            'instagram_url' => $row['instagram_url'], // Fetch the actual URL
        ];

        // Store the member data in the $team_members array
        $team_members[] = $member;
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

<section class="team " id="team">
    <div class="container">
        <div class="service-heading">
            <div>
                <h2>Meet Our Experts</h2>
            </div>
            <div>
                <p class="team-text">A diverse group of passionate tech enthusiasts dedicated to
                    delivering the best solutions.</p>
            </div>
        </div>

        <div class="row responsive">
            <?php foreach ($team_members as $member): ?>
                <div class="col-md-3 team-card">
                    <div class="back-img">
                        <div class="card-image">
                            <img src="admin/<?= $member['profile_image'] ?>" alt="<?= $member['name'] ?>">
                        </div>
                        <div class="content">
                            <div class="card-content">
                                <h3><?= $member['name'] ?></h3>
                                <p><?= $member['role'] ?></p>
                            </div>
                            <div class="card-social">
                                <a href="<?= $member['linkedin_url'] ?>"><i class="fab fa-linkedin-in custom-icon-large"></i></a>
                                <a href="<?= $member['facebook_url'] ?>"><i class="fab fa-facebook-f custom-icon-large"></i></a>
                                <a href="<?= $member['instagram_url'] ?>"><i class="fab fa-instagram custom-icon-large"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

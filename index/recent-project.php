
<section class="recent-projects-section">
        <!-- Section Heading -->
        <div class="service-heading">
                <div>
                    <h2>Our Recent Projects</h2>
                </div>
                <div>
                    <p>Explore the innovative solutions we’ve delivered.</p>
                </div>
            </div>


        <div class="recent-projects-container">
        <div class="row justify-content-center">
                <!-- Card 1 -->
                <?php
        $a = 1;
        $sql = "SELECT * FROM projects ORDER BY id DESC LIMIT 3";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $id = $row['id'];
    ?>
                <div class="col-md-4">
                    <div class="recent-flip-card">
                        <div class="recent-flip-card-inner" id="card1">
                            <div class="recent-flip-card-front recent-project-card">
                                <div class="card-body">
                                <div class="recent-image-container"
                                    >
                                    <img src="admin/<?php echo $row['project_logo']; ?>" alt=""
                                        class="recent-card-img-top img-fluid"
                                        style="max-width: 200px; height: 82px">
                                </div>
                                <hr class="mt-3" style="width: 50%; margin: auto;">
                                <div >
                                    <p class="recent-card-text">  <?php echo $row['description']; ?></p>
                                </div>
                                </div>
                              
                            </div>

                            <!-- Back of the first card -->
                            <div class="recent-flip-card-back recent-project-card-back">
                                <div class="card-body">
                                    <div class="recent-image-container">
                                        <img src="admin/<?php echo $row['project_overview_image']; ?>" alt="Software Icon" class="img-fluid" style="width:237px;height:135px;object-fit:cover;">
                                    </div>
                                    <h4 class="recent-text" style="color:#1B1B1E;"><?php echo $row['project_name']; ?></h4>
                                    <div class="backbuttons">
                                        <a href="#" class="btn-light-gray mt-3 text-center"
                                            style="border-radius: 50px; display: block; line-height: 38px; "><?php echo $row['field']; ?></a>
                                        <a href="#" class=" btn-blue mt-3 text-center"
                                            style="border-radius: 50px; display: block; line-height: 38px;">View Project Details</a>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $a++;
            }
        } else {
            echo "<tr><td colspan='6'>No records found.</td></tr>";
        }
    ?>
            </div>
        </div>
    </section>
<!-- First Row: Logo, Navigation, and Contact Us Button -->
<!-- Section for Desktop -->
<section class="section-A d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center box2">
            <!-- First Column: Logo -->
            <div class="col-md-2 text-start">
                <a href="index.php">
                    <img src="image/HiSkyTech Png_LOGO-Horizantal-02 4.png" alt="Logo" class="img-fluid"
                        style="max-height: 80px;">
                </a>
            </div>

            <!-- Second Column: Navigation Bar -->
            <div class="col-md-8">
    <nav class="navbar-expand-lg navbar" style="background-color: transparent !important">
        <div class="navbar-collapse justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#about-us">About Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#team">Our Team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="careers.php">Careers</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="hireDeveloperDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hire Developer
                    </a>
                 
                    <ul class="dropdown-menu" aria-labelledby="hireDeveloperDropdown">
    <?php
    $sql = "SELECT id, name FROM developers";
    $query = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($query) > 0) {
        while($row = mysqli_fetch_assoc($query)){
    ?>
            <li><a class="dropdown-item" href="hiredeveloper.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
    <?php
        }
    } else {
        echo "<li>No developers available</li>";
    }
    ?>
</ul>

                </li>
             
            </ul>
        </div>
    </nav>
</div>


            <!-- Third Column: Contact Us Button -->
            <div class="col-md-2 text-center contact">
                <a href="#contact" class="mt-3"
                    style="background-color: rgb(10,58,143); height: 44px; width: 158px; border-radius: 8px;color:white;">
                    Book Consultation
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section for Mobile -->
<section class="section-A d-block d-lg-none">
   
  <!-- Bootstrap 5 Example -->
<nav class="navbar navbar-expand-md" style="font-size: 16px; background-color:#F6F7FC;">
  <div class="container-fluid">
    <a href="index.php">
      <img src="image/HiSkyTech Png_LOGO-Horizantal-02 4.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="#about-us">About Us</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#team">Our Team</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="projects.php">Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="careers.php">Careers</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="hireDeveloperDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hire Developer
        </a>
        <ul class="dropdown-menu" aria-labelledby="hireDeveloperDropdown">
            <?php
            $sql = "SELECT id, name FROM developers";
            $query = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <li><a class="dropdown-item" href="hiredeveloper.php?id=<?php echo $row['id']; ?>" style="color:#666;"><?php echo $row['name']; ?></a></li>
            <?php
                }
            } else {
                echo "<li class='dropdown-item'>No developers available</li>";
            }
            ?>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#our-team">Our Team</a>
    </li>
    <li class="nav-item text-center contact">
        <a href="#contact" class="mt-3" style="background-color: rgb(10,58,143); padding:13px 0px;width: 300px; border-radius:100px; color:white;font-size: 18px;">Book Consultation</a>
    </li>
</ul>

   
  </div>
</nav>

</section>



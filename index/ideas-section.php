<section class="ideas">
        <div class="container">
            <div class="row">
                <div class="col-md-5 idea-heading">
                    <h4 style="display: inline-block;">Transforming Ideas into Digital Reality with
                        <span class="color-hi-tech">Hi</span><span class="color-sky">Sky</span><span
                            class="color-hi-tech">Tech</span>.
                    </h4>

                </div>
                <div class="col-md-7 idea-p">
                    <p>At HiSkyTech, we specialize in UI/UX design, mobile app development, and graphic
                        design services. Our mission is to create seamless digital experiences tailored to
                        your needs. Watch this video to learn how we transform ideas into reality with our
                        expert solutions. </p>
                </div>

            </div>
            <?php
            $sql="SELECT * FROM company_video";
            $query=mysqli_query($conn,$sql);
            $video=mysqli_fetch_assoc($query);
            ?>
            <div class="row idea-img">
                <video src="admin/uploads/videos/<?=$video['video']?>" controls style="width: 100%; max-width: 100%; height: auto;">
                    Your browser does not support the video tag.
                </video>

            </div>

        </div>
        </div>
    </section>
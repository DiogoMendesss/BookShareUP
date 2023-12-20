<main id="homePage-main">
    <div class="home-book"> <!-- flex container  -->
        <!-- the 3 hidden, for conditional next/back button action-->
        <input type="checkbox" id="home-checkbox1"> 
        <input type="checkbox" id="home-checkbox2">
        <input type="checkbox" id="home-checkbox3">
        <!-- page 0 -->
        <!-- <div id="home-cover"><img src="images/bookcovers/1.jpg"></div> -->
        <div id="home-cover">
        <?php
            if ($register_request=='register') {
                include_once('template/register_form.php');
            }
            else {
                include_once('template/login_form.php');
            }
        ?> 
        </div>
        <!-- book part that actually flips -->
        <div class="home-flip-book">
            <!-- 2nd/1st pages -->
            <div class="home-flip" id="home-sheet1">
                <div class="home-back">
                    <img src="image/backgrounds/page_with_logo.png">
                    <label class="home-back-btn" for="home-checkbox1">Back</label>
                </div>
                <div class="home-front">
                    <h2>Booksharing UP</h2>
                    <p>The first book sharing platform in the UP community.</p>
                    <label class="home-next-btn" for="home-checkbox1">Next</label>
                </div>
            </div>
            <!-- 4th/3th pages  -->
            <div class="home-flip" id="home-sheet2">
                <div class="home-back">
                    <img src="image/backgrounds/page_with_logo.png">
                    <label class="home-back-btn" for="home-checkbox2">Back</label>
                </div>
                <div class="home-front">
                    <h2>Hope you like it!</h2>
                    <p>Welcome to Booksharing UP, a platform where book lovers can connect and share their favorite reads.
                        Join our community to discover new books and share your thoughts with fellow readers..</p>
                    <label class="home-next-btn" for="home-checkbox2">Next</label>
                </div>
            </div>
            <!-- 6th/5th pages -->
            <div class="home-flip" id="home-sheet3">
                <div class="home-back">
                    <img src="image/backgrounds/back_cover.png">
                    <label class="home-back-btn" for="home-checkbox3">Back</label>
                </div>
                <div class="home-front">
                    <h2>Faculties in the Program</h2>
                    <ul>
                        <?php foreach($campuses as $campus) { ?>
                            <li><?php echo $campus['name'] ?></li>
                        <?php } ?>
                    </ul>
                    <label class="home-next-btn" for="home-checkbox3">Next</label>
                </div>
            </div>
        </div>
    </div>
</main>
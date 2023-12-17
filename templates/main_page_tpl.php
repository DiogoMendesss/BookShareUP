<main>
    <div class="main-book"> <!-- flex container  -->
        <!-- the 3 hidden, for conditional next/back button action-->
        <input type="checkbox" id="main-checkbox1"> 
        <input type="checkbox" id="main-checkbox2">
        <input type="checkbox" id="main-checkbox3">
        <!-- page 0 -->
        <div id="main-cover"><img src="images/bookcovers/1.jpg"></div>
        <!-- book part that actually flips -->
        <div class="main-flip-book">
            <!-- 2nd/1st pages -->
            <div class="main-flip" id="main-sheet1">
                <div class="main-back">
                    <img src="images/bookcovers/2.jpg">
                    <label class="main-back-btn" for="main-checkbox1">Back</label>
                </div>
                <div class="main-front">
                    <h2>Booksharing UP</h2>
                    <p>The first book sharing platform in the UP community.</p>
                    <label class="main-next-btn" for="main-checkbox1">Next</label>
                </div>
            </div>
            <!-- 4th/3th pages  -->
            <div class="main-flip" id="main-sheet2">
                <div class="main-back">
                    <img src="images/bookcovers/3.jpg">
                    <label class="main-back-btn" for="main-checkbox2">Back</label>
                </div>
                <div class="main-front">
                    <h2>Hope you like it!</h2>
                    <p>Welcome to Booksharing UP, a platform where book lovers can connect and share their favorite reads.
                        Join our community to discover new books and share your thoughts with fellow readers..</p>
                    <label class="main-next-btn" for="main-checkbox2">Next</label>
                </div>
            </div>
            <!-- 6th/5th pages -->
            <div class="main-flip" id="main-sheet3">
                <div class="main-back">
                    <img src="images/bookcovers/4.jpg">
                    <label class="main-back-btn" for="main-checkbox3">Back</label>
                </div>
                <div class="main-front">
                    <h2>Universities in the Program</h2>
                    <ul>
                        <li>University 1</li>
                        <li>University 2</li>
                        <li>University 3</li>
                        <!-- Add more universities as needed -->
                    </ul>
                    <label class="main-next-btn" for="main-checkbox3">Next</label>
                </div>
            </div>
        </div>
    </div>

    


























</main>
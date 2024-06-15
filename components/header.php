<!-- components/header.php -->
<link rel="stylesheet" href="css/index_login.css">
<header class="bg-dark text-white py-3 mb-5">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Cohort Hive</h1>
        <nav class="d-flex align-items-center">
            <a href="#" class="nav-link text-white me-3">Home</a>
            <a href="#" class="nav-link text-white me-3">Features</a>
            <a href="#" class="nav-link text-white me-3">Contact</a>
            <a href="#" class="btn btn-outline-light ms-3 me-2 sign-in-btn">Sign In</a>
            <a href="#" class="btn btn-primary ms-2 sign-up-btn">Sign Up</a>
        </nav>
    </div>
</header>

<!-- Sign In Pop-up -->
<div id="signInPopup" class="popup hide">
    <button class="close-btn">&times;</button>
    <form>
        <div class="mb-3">
            <label for="signInEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signInEmail">
        </div>
        <div class="mb-3">
            <label for="signInPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signInPassword">
        </div>
        <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Sign In</button>
    </form>
</div>

<!-- Sign Up Pop-up -->
<div id="signUpPopup" class="popup hide">
    <button class="close-btn">&times;</button>
    <form>
        <div class="mb-3">
            <label for="signUpEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signUpEmail">
        </div>
        <div class="mb-3">
            <label for="signUpPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signUpPassword">
        </div>
        <div class="mb-3">
            <label for="signUpConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="signUpConfirmPassword">
        </div>
        <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Sign Up</button>
    </form>
</div>

<!-- Background Blur -->
<div id="blurBackground" class="blur hide"></div>
<script src="js/index_login.js"></script>

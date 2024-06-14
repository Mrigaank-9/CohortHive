<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collab Hub</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- Header -->
    <header class="bg-dark text-white py-3 mb-5">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Collab Hub</h1>
        <nav class="d-flex align-items-center">
            <a href="#" class="nav-link text-white me-3">Home</a>
            <a href="#" class="nav-link text-white me-3">Features</a>
            <a href="#" class="nav-link text-white me-3">Contact</a>
            <a href="#" class="btn btn-outline-light ms-3 me-2">Sign In</a>
            <a href="#" class="btn btn-primary ms-2">Sign Up</a>
        </nav>
    </div>
</header>


    <!-- Main content -->
    <div class="blur"></div>
    <div class="noBlur"></div>
    <div class="container">
        <div class="startSec">
            <div class="intro">
                <div class="title">Collab Hub</div>
                <p class="subTitle">Where Developers Unite and Innovate Together</p>
            </div>
            <div class="meeting">
                <button class="btn btn-outline-secondary btn-lg btn-dark create" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Create a Room</button>
                <span class="midEle">or</span>
                <button class="btn btn-outline-secondary btn-lg btn-dark join" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Join a Room</button>
            </div>
        </div>
        <div class="createMsg meeting hide">
            <button class="close-btn">&times;</button>
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
            </form>
        </div>
        <div class="joinMsg meeting hide">
            <button class="close-btn">&times;</button>
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
            </form>
        </div>
        <div class="historySec"></div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">About Collab Hub</h5>
                    <p>
                        Collab Hub is where developers unite and innovate together. Join us to create, share, and collaborate on exciting projects.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#" class="text-white text-decoration-none">Home</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">Features</a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Follow Us</h5>
                    <ul class="list-unstyled d-flex justify-content-center">
                        <li>
                            <a href="#" class="text-white text-decoration-none me-3"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none me-3"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none me-3"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="#" class="text-white text-decoration-none"><i class="fab fa-github"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contact Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <i class="fas fa-envelope me-2"></i> info@collabhub.com
                        </li>
                        <li>
                            <i class="fas fa-phone me-2"></i> +1 234 567 890
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i> 123 Developer Lane, Tech City, USA
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-secondary">
            © 2024 Collab Hub
        </div>
    </footer>

    <!-- Include FontAwesome for social media icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>

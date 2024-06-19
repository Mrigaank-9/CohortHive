<header class="bg-dark text-white py-3 mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand mb-0" style="font-size: 1.5rem;">
                    <?php echo $_SESSION['room_name']; ?>
                </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-house"></i><span class="ms-2 d-lg-none">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="chat/" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-chat"></i><span class="ms-2 d-lg-none">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Conference" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-camera-video"></i><span class="ms-2 d-lg-none">Conference</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-github"></i><span class="ms-2 d-lg-none">GitHub</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-briefcase"></i><span class="ms-2 d-lg-none">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-easel"></i><span class="ms-2 d-lg-none">Presentations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Settings" class="nav-link text-white d-flex align-items-center">
                                <i class="bi bi-gear"></i><span class="ms-2 d-lg-none">Settings</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                            <li class="nav-item">
                                <span class="nav-link text-white d-flex align-items-center" style="font-size: 1.25rem;">
                                    <i class="bi bi-person-circle me-2"></i> <?php echo $_SESSION['username']; ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a href="../components/logout.php" class="btn btn-outline-light ms-3 me-2">Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>



    <style>
        .nav-link {
            font-size: 1.5rem;
        }
        @media (min-width: 992px) {
            .navbar-nav .nav-link {
                margin-right: 2rem; 
            }
        }
    </style>
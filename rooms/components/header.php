<header class="bg-dark text-white py-0 mb-1">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <img src="../images/logo.png" alt="Logo" width="70" height="70" class="d-inline-block align-text-center">
                    <h1 class="mb-0 ms-2">Cohort Hive</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-house me-2"></i><span class="d-lg-none">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="chat/" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-chat me-2"></i><span class="d-lg-none">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Conference" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-camera-video me-2"></i><span class="d-lg-none">Conference</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-github me-2"></i><span class="d-lg-none">GitHub</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-briefcase me-2"></i><span class="d-lg-none">Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-easel me-2"></i><span class="d-lg-none">Presentations</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Settings" class="nav-link text-white d-flex align-items-center mx-2">
                                <i class="bi bi-gear me-2"></i><span class="d-lg-none">Settings</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                            <li class="nav-item">
                                <span class="nav-link text-white d-flex align-items-center" style="font-size: 1.25rem; cursor:default">
                                    <i class="bi bi-person-circle mx-3 me-2"></i> <?php echo $_SESSION['username']; ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <a href="../components/logout.php" class="btn btn-outline-light ms-3 me-3">Logout</a>
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
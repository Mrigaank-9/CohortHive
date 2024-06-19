<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <h2>Settings</h2>
            <ul>
                <li onclick="openSection('welcome')">Welcome</li>
                <li onclick="openSection('accountDetails')">Account Details</li>
                <li onclick="openSection('roomDetails')">Room Details</li>
                <li onclick="openSection('changePassword')">Change Password</li>
                <li onclick="openSection('changeName')">Change Name</li>
            </ul>
            <button class="back-button" onclick="goBack()">← Back To Room</button>
        </div>
        <div class="content">
            <div id="welcome" class="section active">
                <h3>Welcome to Settings</h3>
                <p>Select an option from the sidebar to manage your account and room settings.</p>
            </div>

            <div id="accountDetails" class="section">
                <h3>Account Details</h3>
                <form id="accountForm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <button type="button" onclick="saveChanges('accountForm')">Save Changes</button>
                </form>
            </div>

            <div id="roomDetails" class="section">
                <h3>Room Details</h3>
                <form id="roomForm">
                    <div class="form-group">
                        <label for="roomName">Room Name</label>
                        <input type="text" id="roomName" name="roomName" required>
                    </div>
                    <div class="form-group">
                        <label for="roomDesc">Room Description</label>
                        <textarea id="roomDesc" name="roomDesc" required></textarea>
                    </div>
                    <button type="button" onclick="saveChanges('roomForm')">Save Changes</button>
                </form>
            </div>

            <div id="changePassword" class="section">
                <h3>Change Password</h3>
                <form id="passwordForm">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    <button type="button" onclick="saveChanges('passwordForm')">Save Changes</button>
                </form>
            </div>

            <div id="changeName" class="section">
                <h3>Change Name</h3>
                <form id="nameForm">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required>
                    </div>
                    <button type="button" onclick="saveChanges('nameForm')">Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modals for Confirmation Messages -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('confirmationModal')">&times;</span>
            <h2>Confirmation</h2>
            <p id="confirmationMessage"></p>
        </div>
    </div>

    <script src="scripts.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>

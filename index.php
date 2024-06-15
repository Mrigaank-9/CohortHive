<?php require_once "index-php.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cohort Hive</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/index_login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php 
    // Include header
    include 'components/header.php';
    ?>

    <!-- Main content -->
    <div class="container">
        <div class="startSec">
            <div class="intro">
                <div class="title">Cohort Hive</div>
                <p class="subTitle">Where Developers Unite and Innovate Together</p>
            </div>
            <div class="meeting">
                <button class="btn btn-outline-secondary btn-lg btn-dark create" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Create a Room</button>
                <span class="midEle">or</span>
                <button class="btn btn-outline-secondary btn-lg btn-dark join" style="--bs-btn-font-size: 1.5rem; --bs-btn-color: white">Join a Room</button>
            </div> 
        </div>
        <div id="createfromid" class="createMsg form hide">
            <button class="close-btn">&times;</button>
            <form method="POST">
                <div class="mb-3">
                    <label for="roomName" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" name="room_name" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                </div>
                <button type="submit" name="create_room" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
            </form>
        </div>

        <div class="joinMsg form hide">
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
        <div class="historySec">
          <div class="history">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Room No.</th>
                  <th scope="col">Room Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="table-group-divider">
                <tr>
                  <th scope="row">1</th>
                  <td>Rajeev's Room</td>
                  <td><a href="#" class="actionLink">Join</a></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Mrigaank's Room</td>
                  <td><a href="#" class="actionLink">Join</a></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td >Saket's Room</td>
                  <td><a href="#" class="actionLink">Join</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <?php 
    // Include footer
    include 'components/footer.php';
    ?>

    <!-- Other scripts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <script src="js/index_login.js"></script>
</body>
</html>

<?php 
  if(session_status()===PHP_SESSION_NONE){
    session_start();
  }
  require_once "../components/config.php";
  if(!$_SESSION['loggedin']){
    header("location : ../index.php");
  }
  $room_code="";

  if (isset($_GET['room'])) {
    $room_code = $_GET['room'];
    // Prepare the statement to fetch Room_ID based on Room_code
    $stmt = $conn->prepare("SELECT Room_ID FROM `codetoroomid` WHERE Room_code = ?");
    $stmt->bind_param("s", $room_code);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($room_id);
    $stmt->fetch();
    $stmt->close();
    if (!empty($room_id)) {
        $_SESSION['room_id'] = $room_id;
    } else {
        echo "Room not found or invalid room code.";
    }
}
else{
    header("Location:../index.php");
}
if(isset($_SESSION['room_id'])){
    $stmt=$conn->prepare("SELECT Name,Password FROM `rooms` WHERE ID=?");
    $stmt->bind_param("s",$_SESSION['room_id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($room_name,$room_password);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['room_name']=$room_name;
    $_SESSION['room_password']=$room_password;
}


// Fetch owner_id from rooms table using room_id
$query = $conn->prepare("SELECT Owner_ID FROM `rooms` WHERE ID = ?");
$query->bind_param("s", $_SESSION['room_id']);
$query->execute();
$result = $query->get_result();
$owner_id = $result->fetch_assoc()['Owner_ID'];

// Fetch owner's name from users table
$query = $conn->prepare("SELECT Name FROM `users` WHERE ID = ?");
$query->bind_param("s", $owner_id);
$query->execute();
$result = $query->get_result();
$owner_name = $result->fetch_assoc()['Name'];

// Fetch user IDs from rooms_users table excluding the owner
$query = $conn->prepare("SELECT User_ID FROM `usertoroom` WHERE Room_ID = ? AND User_ID != ?");
$query->bind_param("ss", $_SESSION['room_id'], $owner_id);
$query->execute();
$result = $query->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $user_id = $row['User_ID'];

    // Fetch user details from users table
    $user_query = $conn->prepare("SELECT ID, Name FROM `users` WHERE ID = ?");
    $user_query->bind_param("s", $user_id);
    $user_query->execute();
    $user_result = $user_query->get_result();
    $user_data = $user_result->fetch_assoc();

    $users[] = $user_data;
}

if (isset($_GET['remove_user_id'])) {
    $user_id_to_remove = $_GET['remove_user_id'];
    $room_id = $_SESSION['room_id'];

    // Remove user from rooms_users table
    $query = $conn->prepare("DELETE FROM `usertoroom` WHERE Room_ID = ? AND User_ID = ?");
    $query->bind_param("ss", $room_id, $user_id_to_remove);
    $query->execute();

    // Remove user from chat_user table
    $query = $conn->prepare("DELETE FROM `chat_user` WHERE Room_ID = ? AND User_ID = ?");
    $query->bind_param("ss", $room_id, $user_id_to_remove);
    $query->execute();

    // Redirect to avoid resubmission on refresh
    header("Location:rooms/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms | <?php echo  $_SESSION['room_name']; ?></title>

    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>
<body>

   <?php require_once "../components/preloader.php"; ?>
   <?php require_once "components/header.php";?>

  <div class="blur"></div>
    <div class="container">
        
        <div class="startSec">
            <div class="roomDet">
                <div class="roomName"><?php echo  $_SESSION['room_name']; ?></div>
                <div class="ownerName"><?php echo  $owner_name; ?></div>
                <div id="roomId" class="roomsubdet"><span class="idtitle">Code: </span><?php echo $room_code; ?><button class="btn btn-sm" onclick="copyID()"><i class="fa-regular fa-copy"></i></button></div>
                <div id="roomPass" class="roomsubdet"><span class="idtitle">Password: </span><?php echo  $_SESSION['room_password']; ?><button class="btn btn-sm" onclick="copyPass()"><i class="fa-regular fa-copy"></i></button></div>
                <div class="attendeeList">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Attendee Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                          <?php
                           $i=1;
                           foreach ($users as $user): ?>
                             <tr>
                               <th scope="row"><?php echo $i++;?></th>
                               <td><?php echo htmlspecialchars($user['Name']); ?></td>
                               <td><a href="?remove_user_id=<?php echo htmlspecialchars($user['ID']); ?>" class="actionLink">Laat Markar Bahr Nikale</a></td>
                             </tr>
                         <?php endforeach; ?>
                        </tbody>
                      </table>
                </div>
            </div>

            <div class="announcements">
                <div class="accouncementsContent">
                    <div class="roomName">Announcements</div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-group-divider">
                      <tr>
                        <th scope="row">1</th>
                        <td>Is earth Round? Or is it flat??</td>
                        <td>Rajeev Singh</td>
                        <td><a href="#" class="actionLink"><button class="btn btn-outline-secondary btn-lg btn-dark seeAnnouncements" style="--bs-btn-font-size: 0.8rem; --bs-btn-color: white">Read</button></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Important Bug fixed!</td>
                        <td>Mrigaank Jaswal</td>
                        <td><a href="#" class="actionLink"><button class="btn btn-outline-secondary btn-lg btn-dark seeAnnouncements" style="--bs-btn-font-size: 0.8rem; --bs-btn-color: white">Read</button></a></td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Important Update!</td>
                        <td>Saket Agarwal</td>
                        <td><a href="#" class="actionLink"><button class="btn btn-outline-secondary btn-lg btn-dark seeAnnouncements" style="--bs-btn-font-size: 0.8rem; --bs-btn-color: white">Read</button></a></td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="addAnnouncement"><button class="btn btn-outline-secondary btn-lg btn-dark addAnnouncement" style="--bs-btn-font-size: 0.9rem; --bs-btn-color: white">Add Announcement</button></div>
                </div>
                
            </div>
        </div>      
    </div>
    <div id="createAnnouncementid" class="createAnnouncement form hide">
      <button class="close-btn">&times;</button>
      <form>
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="roomName" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="creator" class="form-label">Creator</label>
              <input type="text" class="form-control" id="roomName" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
              <label for="formFile" class="form-label">Upload the File</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          <button type="submit" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
        </form>
  </div>
  <div id="viewAnnouncementid" class="viewAnnouncement form hide">
    <button class="close-btn">&times;</button>
      <form>
          <div class="roomName">Title</div>
          <div class="media"></div>
        </form>
  </div>

  <?php require_once "../components/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>


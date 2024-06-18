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
    $_SESSION['room_code']=$room_code;
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
if(isset($_POST['announce'])){
  // Escape user inputs for security (prevent SQL injection)
  $title = $conn->real_escape_string($_POST['title']);
  $description = $conn->real_escape_string($_POST['description']);
  $room_id = $_SESSION['room_id']; // Assuming you have room_id stored in session
  $user_id = $_SESSION['id']; // Assuming you have user_id stored in session

  // SQL query to insert data into announcements table
  $sql = "INSERT INTO `announcements` (Room_ID,User_ID,Title, Description) 
          VALUES ('$room_id', '$user_id','$title', '$description')";

  if ($conn->query($sql) === TRUE) {
      echo '<script>
            window.alert("Announcement Added Successfully!"); </script>';
      // Optionally, you can redirect or show a success message here
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fetching Announcements
$sql = "SELECT a.ID, a.Title, a.Description, a.User_ID, u.Name
        FROM announcements a
        LEFT JOIN users u ON a.User_ID = u.ID
        WHERE Room_ID = ?
        ORDER BY a.ID DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['room_id']);
$stmt->execute();
$result = $stmt->get_result();
$rowNumber = 1;

$announce_result=[];
if (isset($_GET['view_announcement'])) {
  $announcement_id = $_GET['view_announcement'];

  $query = $conn->prepare("SELECT a.ID, a.Title, a.Description, a.User_ID, u.Name
        FROM announcements a
        LEFT JOIN users u ON a.User_ID = u.ID
        WHERE a.ID = ?
        ORDER BY a.ID DESC");
  $query->bind_param("i", $announcement_id);
  $query->execute();
  $announce_result=$query->get_result();
}

$conn->close();
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
                               <td>
                                  <?php if ($_SESSION['id'] != $owner_id): ?>
                                      <a href="?remove_user_id=<?php echo htmlspecialchars($user['ID']); ?>" class="actionLink" disabled style="cursor: not-allowed;">Kick</a>
                                  <?php else: ?>
                                      <a href="?remove_user_id=<?php echo htmlspecialchars($user['ID']); ?>" class="actionLink">Kick</a>
                                  <?php endif; ?>
                               </td>
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
                      <?php
                       if ($result->num_rows > 0) {
                           while ($row = $result->fetch_assoc()) {
                               $title = htmlspecialchars($row['Title']);
                               $description = htmlspecialchars($row['Description']);
                               $creator = htmlspecialchars($row['Name']);
                               echo '<tr>';
                               echo '<th scope="row">' . $rowNumber . '</th>';
                               echo '<td>' . $title . '</td>';
                               echo '<td>' . $creator . '</td>';
                               echo '<td><a href="" class="actionLink"><button class="btn btn-outline-secondary btn-lg btn-dark seeAnnouncements" style="--bs-btn-font-size: 0.8rem; --bs-btn-color: white" disabled style="cursor: not-allowed;">Read</button></a></td>';
                               echo '</tr>';
                               $rowNumber++;
                           }
                       } else {
                           echo '<tr><td colspan="4">No announcements found.</td></tr>';
                       }  
                       ?>
                    </tbody>
                  </table>
                  <div class="addAnnouncement"><button class="btn btn-outline-secondary btn-lg btn-dark addAnnouncement" style="--bs-btn-font-size: 0.9rem; --bs-btn-color: white">Add Announcement</button></div>
                </div>
                
            </div>
        </div>      
    </div>
    <div id="createAnnouncementid" class="createAnnouncement form hide">
    <button class="close-btn">&times;</button>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title" required>
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Upload File</label>
            <input class="form-control" type="file" id="formFile" disabled style="cursor: not-allowed;">
        </div>
        <button type="submit" name="announce" class="btn btn-outline-secondary btn-lg btn-dark" style="--bs-btn-font-size: 1.1rem; --bs-btn-color: white">Submit</button>
    </form>
</div>
<div id="viewAnnouncementid" class="viewAnnouncement form hide">
    <button class="close-btn">&times;</button>
    <div class="roomName"><?php echo $announce_result['Title'];?></div>
    <div class="creator"><?php echo $announce_result['Name'];?></div>
    <div class="description"><?php echo $announce_result['Description'];?></div>
</div>


  <?php require_once "../components/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>
</html>


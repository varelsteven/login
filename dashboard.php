<?php
include 'koneksi.php';
if(!isset($_SESSION['id'])) header("location:index.php");
$id = $_SESSION['id'];
$sql = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM canvas WHERE id = '$id'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/game.css">
</head>
<body>

<div class="container">
            <div class="bg"></div>
            <div class="mainn">
                <p class="p">PLAYER : <?php echo $sql["username"]; ?> # <?php echo $sql["id"]; ?></p>
                
                <div class="ccolor">
                    <label id="pies">Choose Color :</label>
                    <input type="color" class="color">
                </div>
                
                <div class="btn">
                    <a href="logout.php"><button>Logout</button></a>
                    <button id="strt" onclick="coba()">Start</button>
                </div>
            </div>
    </div>
    <p class="pie" style="display:none;">PLAYER : <?php echo $sql["username"]; ?> # <?php echo $sql["id"]; ?></p>
                    <div class="wthree_footer_copy">
                    <p style="text-align:center;"><small>&copy; Create Development By rell</small></p>

</div>
<script src="asset/js/script.js"></script>
</body>
</html>
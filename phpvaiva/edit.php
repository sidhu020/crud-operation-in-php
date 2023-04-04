<?php
include 'conn.php';

$id = $_GET['infoID'];
$view = "SELECT * from info_tbl where md5(infoID) = '$id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $ID = $_GET['infoID'];

    $fn = $_POST['fname'];
    $ln = $_POST['lname'];

    $insert = "UPDATE info_tbl set firstName = '$fn', lastName = '$ln' where md5(infoID) = '$ID'";

    if ($conn->query($insert) == TRUE) {
        echo "Sucessfully update data";
        header('location: maintenance.php');
    } else {
        echo "Ooppss cannot add data" . $conn->error;
        header('location: maintenance.php');
    }
    $conn->close();
}
include 'header.php';
?>

<div id="content">
    <form action="" method="POST">
        <table align="center">
            <tr>
                <td>Fisrt Name: <input type="text" name="fname" value="<?php echo $row['firstName']; ?>" placeholder="Type Firstname here" required></td>
            </tr>
            <tr>
                <td>Last Name: <input type="text" name="lname" value="<?php echo $row['lastName']; ?>" placeholder="Type Last Name here.." required></td>
            </tr>
            <tr>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
    <br>
</div>
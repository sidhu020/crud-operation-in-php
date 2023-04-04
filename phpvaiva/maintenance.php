<?php
include 'conn.php';
if (isset($_POST['add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $insert = "INSERT INTO info_tbl (firstName,lastName) VALUES ('$fname','$lname')";

    if ($conn->query($insert) == TRUE) {
        echo "Successfully add data";
        header('location:maintenance.php');
    } else {
        echo "Oopps cannot add data" . $conn->connect_error;
        header('location:maintenance.php');
    }
    $_insert->close();
}
?>
<br>
<div id="content">

    <br>
    <form action="maintenance.php" method="POST">
        <table align="center">
            <tr>
                <td>First name : <input type="text" name="fname" value="" placeholder="Type firstName here" required>
                </td>
            </tr>
            <tr>
                <td>Last name : <input type="text" name="lname" placeholder="Type last name here" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="add" value="Add"></td>
            </tr>
        </table>
    </form>
    <div>
        <br>
        <table align="center" border="1" cellspacing="0" width="500">
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM info_tbl";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_array()) {
            ?>
                    <tr>
                        <td align="center"><?php echo $row['firstName']; ?></td>
                        <td align="center"><?php echo $row['lastName']; ?></td>
                        <td align="center"><a href="edit.php?infoID=<?php echo md5($row['infoID']); ?>">Edit</a>/<a href="delete.php?infoID=<?php echo md5($row['infoID']); ?>">Delete</a></td>
                    </tr>
            <?php
                }
            } else {
                echo "<center><p> No Records </p></center>";
            }
            $conn->close();
            ?>
        </table>
    </div>
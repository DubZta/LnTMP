<?php include("connection.php");
$fetchData = fetch_data($database, $conn);

$sql = "SELECT id, firstName, lastName, email FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['firstName']}</td>";
        echo "<td>{$row['lastName']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}

$conn->close();
?>
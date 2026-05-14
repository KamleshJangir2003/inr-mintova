<?php
include("inc/function.php"); // DB connection file

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=members.xls");
header("Pragma: no-cache");
header("Expires: 0");

$tname = 'imaksoft_member';
$where = "WHERE paystatus='A' ORDER BY id DESC";

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, trim($_POST['search']));
    $where = "WHERE paystatus='A' AND (userid LIKE '%$search%' OR name LIKE '%$search%' OR phone LIKE '%$search%') ORDER BY id DESC";
}

$query = "SELECT * FROM $tname $where";
$result = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "
<tr>
<th>Sl_No</th>
<th>User ID</th>
<th>Sponsor</th>
<th>Name</th>
<th>Password</th>
<th>Transaction Password</th>
<th>Email</th>
<th>Phone</th>
<th>USDT TRC20</th>
<th>Account Status</th>
<th>Pay Status</th>
<th>Date</th>
</tr>
";

$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$i++."</td>";
    echo "<td>".$row['userid']."</td>";
    echo "<td>".$row['sponsor']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".base64_decode($row['password'])."</td>";
    echo "<td>".$row['tpassword']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>".$row['bitcoin']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>".$row['paystatus']."</td>";
    echo "<td>".$row['date']."</td>";
    echo "</tr>";
}

echo "</table>";
exit;
?>

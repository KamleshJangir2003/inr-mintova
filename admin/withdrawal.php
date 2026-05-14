<?php include('head.php');
$left=60;

 ?>

<?php include('header.php') ?>

<?php include('sidebar.php') ?>


<div class="main-content app-content">

<div class="main-container container-fluid">

<div class="main-content-body">
<div class="row row-sm">

<?php if(($_REQUEST['case'] ?? '')==='pen'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header">
<div class="card-title">Pending Withdrawal</div>
</div>
<div class="card-body" style="overflow:auto;">
<div class="jumps-prevent" style="padding-top: 20px;"></div>



<?php


// Define the table name and limit
$tname = 'imaksoft_withdrawal'; // Table name
$lim = 10000; // Number of records per page

// Query to fetch data from the database
$query = "SELECT * FROM $tname WHERE status = 'P' ORDER BY id DESC LIMIT $lim";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($conn));
}

// Get the number of rows returned by the query
$num = mysqli_num_rows($result);
?>


<table id="myTable" class="table table-bordered table-striped">

 <thead>
        <tr>
            <th>Sl No</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Request</th>
            <th>Payout</th>
            <th>Wallet</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are records
        if ($num > 0) {
            $i = 1;
            // Fetch records and display in the table
            while ($fetch = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$i}</td>";
                echo "<td>{$fetch['userid']}</td>";
                echo "<td>" . getMemberUserid($conn, $fetch['userid'], 'name') . "</td>";
                echo "<td>{$fetch['request']}</td>";
                echo "<td>{$fetch['payout']}</td>";
                echo "<td>{$fetch['bitcoin']}</td>";
                              echo "<td>";
if ($fetch['status'] == 'P') {
    echo "<a href='withdrawal-process?case=status&id={$fetch['id']}&page=" . ($_REQUEST['page'] ?? 1) . "' onClick=\"return confirm('Are you sure you want to activate this status?');\" style='text-decoration:none; color:#FF0000;'>Pending</a>";
} else {
    echo "<span style='color:green;'>Completed</span>";
}
echo "</td>";
                echo "<td>{$fetch['date']}</td>";
             
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='15'>No Record Found!</td></tr>";
        }
        ?>
</tbody>
</table>
</div>
<div align="center"><?=$pagination ?? ''?></div>
</div>
</div>
</div>
</div>
<?php }else if(($_REQUEST['case'] ?? '')==='app'){?>

<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header">
<div class="card-title">Approved Withdrawal</div>
</div>
<div class="card-body" style="overflow:auto;">
    
    <div class="jumps-prevent" style="padding-top: 20px;"></div>

<!-- Add this before your closing </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>


<?php


// Define the table name and limit
$tname = 'imaksoft_withdrawal'; // Table name
$lim = 10000; // Number of records per page

// Query to fetch data from the database
$query = "SELECT * FROM $tname WHERE status = 'C' ORDER BY id DESC LIMIT $lim";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($conn));
}

// Get the number of rows returned by the query
$num = mysqli_num_rows($result);
?>



<table id="myTable" class="table table-bordered table-striped">
 <thead>
        <tr>
            <th>Sl No</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Request</th>
            <th>Payout</th>
            <th>Wallet</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are records
        if ($num > 0) {
            $i = 1;
            // Fetch records and display in the table
            while ($fetch = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$i}</td>";
                echo "<td>{$fetch['userid']}</td>";
                echo "<td>" . getMemberUserid($conn, $fetch['userid'], 'name') . "</td>";
                echo "<td>{$fetch['request']}</td>";
                echo "<td>{$fetch['payout']}</td>";
                echo "<td>{$fetch['bitcoin']}</td>";
                echo "<td>" . ($fetch['status'] == 'P' ? 'Pending' : 'Completed') . "</td>";
                echo "<td>{$fetch['date']}</td>";

                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='15'>No Record Found!</td></tr>";
        }
        ?>

</tbody>
</table>
</div>
<div align="center"><?=$pagination ?? ''?></div>
</div>
</div>
</div>
</div>


<?php }else if(($_REQUEST['case'] ?? '')==='fail'){?>

<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header">
<div class="card-title">Failed Withdrawal</div>
</div>
<div class="card-body" style="overflow:auto;">
    
    <div class="jumps-prevent" style="padding-top: 20px;"></div>

<!-- Add this before your closing </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>


<?php


// Define the table name and limit
$tname = 'imaksoft_withdrawal'; // Table name
$lim = 10000; // Number of records per page

// Query to fetch data from the database
$query = "SELECT * FROM $tname WHERE status = 'F' ORDER BY id DESC LIMIT $lim";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($conn));
}

// Get the number of rows returned by the query
$num = mysqli_num_rows($result);
?>



<table id="myTable" class="table table-bordered table-striped">
 <thead>
        <tr>
            <th>Sl No</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Request</th>
            <th>Payout</th>
            <th>Wallet</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are records
        if ($num > 0) {
            $i = 1;
            // Fetch records and display in the table
            while ($fetch = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$i}</td>";
                echo "<td>{$fetch['userid']}</td>";
                echo "<td>" . getMemberUserid($conn, $fetch['userid'], 'name') . "</td>";
                echo "<td>{$fetch['request']}</td>";
                echo "<td>{$fetch['payout']}</td>";
                echo "<td>{$fetch['bitcoin']}</td>";
                echo "<td>" . ($fetch['status'] == 'F' ? 'Pending' : 'Failed') . "</td>";
                echo "<td>{$fetch['date']}</td>";

                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='15'>No Record Found!</td></tr>";
        }
        ?>

</tbody>
</table>
</div>
<div align="center"><?=$pagination ?? ''?></div>
</div>
</div>
</div>
</div>


<?php }?>

</div>
</div>
<script type="text/javascript">
//<![CDATA[

theForm.oldSubmit = theForm.submit;
theForm.submit = WebForm_SaveScrollPositionSubmit;

theForm.oldOnSubmit = theForm.onsubmit;
theForm.onsubmit = WebForm_SaveScrollPositionOnSubmit;
//]]>
</script>
</form>
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>
<script src="assets/plugins/bootstrap/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/ionicons/ionicons.js"></script>
<script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
<script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="assets/js/chart.flot.sampledata.js"></script>
<script src="assets/js/eva-icons.min.js"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/p-scroll.js"></script>
<script src="assets/plugins/side-menu/sidemenu.js"></script>
<script src="assets/js/sticky.js"></script>
<script src="assets/plugins/sidebar/sidebar.js"></script>
<script src="assets/plugins/sidebar/sidebar-custom.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/morris.js/morris.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/index.js"></script>
<script src="assets/js/themecolor.js"></script>
<script src="assets/js/swither-styles.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/switcher/js/switcher.js"></script>
<script>
        $(document).ready(function () {
            $("#copy").text($("#ref_link").val());
            $('.clipboard').on('click', function () {
                var $temp = $("<input>");
                var $url = $("#ref_link").val();//$(location).attr('href');
                //$("#linkModal").modal();
                $("body").append($temp);
                $temp.val($url).select();
                document.execCommand("copy");
                //$("#lblCopyLink").text($temp[0].value);
                alert("link copied");
                $temp.remove();
            });
        });
    </script>
</body>
</html>

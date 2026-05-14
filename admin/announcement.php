<?php include('head.php') ?>
<body class="main-body app sidebar-mini ltr light-theme open">

<?php include('header.php') ?>

<?php include('sidebar.php') ?>
<div class="jumps-prevent" style="padding-top: 20px;"></div>


<div class="main-content app-content">

<div class="main-container container-fluid">

<div class="main-content-body">
<div class="row row-sm">


<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">

<div class="card">
<div class="card-header">
<div class="card-title">Announcement</div>
</div>
<div class="card-body">

<?php if(isset($_REQUEST['e'])==1){?><p align="center" style="color:#CC0000; padding-bottom:8px;">Already Exists !!</p><?php }?>
<?php if(isset($_REQUEST['m'])==1){?><p align="center" style="color:#00CC33; padding-bottom:8px;">Announcement Added Successfully!!</p><?php }?>

<form class="form" action="notice-process?case=add" method="post">

<div class="form-body">
<div class="form-group">
<label for="userinput5">Announcement<span style="color:#CC0000;">*</span></label>
<textarea class="form-control border-button" type="text" placeholder="Enter Announcement" required id="announcement" name="announcement"></textarea>
</div>
</div>

<div class="form-actions right">

<button type="submit" class="btn btn-success">
<i class="icon-check2"></i>Submit</button>
</div>
</form>
</div>

</div>
</div>

</div>
</div>
</div>


<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Notice</h4>
</div>

<div>&nbsp;</div>
<div class="table-responsive">
    <?php

$tname = 'imaksoft_announcement';
$lim = 100;
$tpage = 'member.php';
$where = "ORDER BY id DESC";

if (isset($_GET['act']) && $_GET['act'] === 'search' && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, trim($_POST['search']));
    $where = "WHERE userid LIKE '%$search%' OR name LIKE '%$search%' OR phone LIKE '%$search%' ORDER BY id DESC";
}

$query = "SELECT * FROM $tname $where LIMIT $lim";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
?>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr>
<th style="text-align:center;">Sl_No</th>
<th style="text-align:center;">Notice</th>
<th style="text-align:center;">Date</th>
</tr>
</thead>
<tbody>

                <?php if ($num > 0): $i = 1; ?>
                    <?php while ($fetch = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td align="center"><?php echo $i++; ?></td>
                            <td align="center"><?php echo htmlspecialchars($fetch['announcement']); ?></td>
                             <td align="center"><?php echo htmlspecialchars($fetch['date']); ?></td>
                             
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" align="center" style="color:#FF0000;">No Record Found!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

</tbody>
</table>
<div align="center"><?=$pagination ?? ''?></div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>


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

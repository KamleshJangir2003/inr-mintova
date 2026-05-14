<?php include('head.php') ?>

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
<div class="card-title">Change Password</div>
</div>
<div class="card-body">
<?php if(($_REQUEST['m'] ?? null)==1){?><div align="center"><div id="norecord" style="color:#FF0000;">Current password does not match!</div></div><?php }?>
<?php if(($_REQUEST['n'] ?? null)==2){?><div align="center"><div id="norecord" style="color:#009900;">New password successfully updated!</div></div><?php }?>
<?php if(($_REQUEST['p'] ?? null)==3){?><div align="center"><div id="norecord" style="color:#FF0000;">Confirm password does not match!</div></div><?php }?>

<form class="form" action="change-password-process" method="post">
<div class="form-body">

<div class="form-group">
<label for="timesheetinput1">Current Password<span style="color:#CC0000;">*</span></label>
<div class="position-relative has-icon-left">
<input type="password" id="current" name="current" class="form-control" placeholder="Current Password" required>
<div class="form-control-position">
</div>
</div>
</div>

<div class="form-group">
<label for="timesheetinput2">New Password<span style="color:#CC0000;">*</span></label>
<div class="position-relative has-icon-left">
<input type="password" id="newpass" class="form-control" placeholder="New Password" name="newpass" required>
<div class="form-control-position">
</div>
</div>
</div>

<div class="form-group">
<label for="timesheetinput3">Confirm Password<span style="color:#CC0000;">*</span></label>
<div class="position-relative has-icon-left">
<input type="password" id="conpass" class="form-control" placeholder="Confirm Password" name="conpass" required>
<div class="form-control-position">
</div>
</div>
</div>

</div>

<div class="form-actions right">
<button type="submit" class="btn btn-primary">
<i class="icon-check2"></i> Save
</button>
</div>
</form></div>
</div>
</div>
</div>
</div>
</div></div>
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

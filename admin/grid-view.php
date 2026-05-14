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
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Grid View</h4>
<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
<div class="heading-elements">
<ul class="list-inline mb-0">
<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
<li><a data-action="reload"><i class="icon-reload"></i></a></li>
<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
</ul>
</div>
</div>
<div class="card">
<div class="portlet box blue-hoki">
<div class="portlet-title">

<div class="portlet-body" style="overflow:auto;">
<div align="center">&nbsp;</div>
<?php if($_REQUEST['placement']){?><h3 align="center" style="color:#FF0000;font-size:20px;line-height:20px;">User ID: <?=$_REQUEST['placement']?>&nbsp;&nbsp;&nbsp;Name: <?=ucwords(strtolower(getMemberUserid($conn,$_REQUEST['placement'],'name')))?></h3><?php }?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 1</h2>

<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
if($_REQUEST['placement'])
{
$sql="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$_REQUEST['placement']."' AND `status`='A'";
}else{
$sql="SELECT * FROM `imaksoft_member` WHERE `status`='A' ORDER BY `id` LIMIT 1";
}
$res=query($conn,$sql);
$num=numrows($res);
$i=0;
$arr=array();
if($num>0)
{
while($fetch=fetcharray($res))
{
$arr[$i]=$fetch['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch['userid']?>"><?=$fetch['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch['name']))?></th>
<th align="center"><?php if($fetch['sponsor']){?><?=$fetch['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch['date']?></th>
</tr>
<?php $i++;}}?>
</tbody>
</table>
<?php
$count=count($arr);
if($count>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 2</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr1=array();
for($k=0;$k<$count;$k++)
{
$sql1="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr[$k]."' AND `status`='A'";
$res1=query($conn,$sql1);
$num1=numrows($res1); 
if($num1>0)
{
while($fetch1=fetcharray($res1))
{
$arr1[$i]=$fetch1['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch1['userid']?>"><?=$fetch1['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch1['name']))?></th>
<th align="center"><?php if($fetch1['sponsor']){?><?=$fetch1['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch1['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch1['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch1['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count1=count($arr1);
if($count1>0)
{?>

<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 3</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr2=array();
for($k=0;$k<$count1;$k++)
{
$sql2="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr1[$k]."' AND `status`='A'";
$res2=query($conn,$sql2);
$num2=numrows($res2);
if($num2>0)
{
while($fetch2=fetcharray($res2))
{
$arr2[$i]=$fetch2['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch2['userid']?>"><?=$fetch2['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch2['name']))?></th>
<th align="center"><?php if($fetch2['sponsor']){?><?=$fetch2['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch2['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch2['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch2['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count2=count($arr2);
if($count2>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 4</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr3=array();
for($k=0;$k<$count2;$k++)
{
$sql3="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr2[$k]."' AND `status`='A'";
$res3=query($conn,$sql3);
$num3=numrows($res3);
if($num3>0)
{
while($fetch3=fetcharray($res3))
{
$arr3[$i]=$fetch3['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch3['userid']?>"><?=$fetch3['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch3['name']))?></th>
<th align="center"><?php if($fetch3['sponsor']){?><?=$fetch3['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch3['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch3['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch3['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count3=count($arr3);
if($count3>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 5</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr4=array();
for($k=0;$k<$count3;$k++)
{
$sql4="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr3[$k]."' AND `status`='A'";
$res4=query($conn,$sql4);
$num4=numrows($res4);
if($num4>0)
{
while($fetch4=fetcharray($res4))
{
$arr4[$i]=$fetch4['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch4['userid']?>"><?=$fetch4['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch4['name']))?></th>
<th align="center"><?php if($fetch4['sponsor']){?><?=$fetch4['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch4['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch4['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch4['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count4=count($arr4);
if($count4>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 6</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr5=array();
for($k=0;$k<$count4;$k++)
{
$sql5="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr4[$k]."' AND `status`='A'";
$res5=query($conn,$sql5);
$num5=numrows($res5);
if($num5>0)
{
while($fetch5=fetcharray($res5))
{
$arr5[$i]=$fetch5['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch5['userid']?>"><?=$fetch5['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch5['name']))?></th>
<th align="center"><?php if($fetch5['sponsor']){?><?=$fetch5['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch5['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch5['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch5['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>

<?php }?>
<?php
$count5=count($arr5);
if($count5>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 7</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr6=array();
for($k=0;$k<$count5;$k++)
{
$sql6="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr5[$k]."' AND `status`='A'";
$res6=query($conn,$sql6);
$num6=numrows($res6);
if($num6>0)
{
while($fetch6=fetcharray($res6))
{
$arr6[$i]=$fetch6['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch6['userid']?>"><?=$fetch6['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch6['name']))?></th>
<th align="center"><?php if($fetch6['sponsor']){?><?=$fetch6['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch6['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch6['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch6['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>

<?php }?>
<?php
$count6=count($arr6);
if($count6>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 8</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr7=array();
for($k=0;$k<$count6;$k++)
{
$sql7="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr6[$k]."' AND `status`='A'";
$res7=query($conn,$sql7);
$num7=numrows($res7);
if($num7>0)
{
while($fetch7=fetcharray($res7))
{
$arr7[$i]=$fetch7['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch7['userid']?>"><?=$fetch7['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch7['name']))?></th>
<th align="center"><?php if($fetch7['sponsor']){?><?=$fetch7['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch7['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch7['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch7['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count7=count($arr7);
if($count7>0)
{?>
<h2 style="color:#FF0000;font-size:20px;padding-left:20px;">Genealogy - Level 9</h2>
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr class="headback">
<th align="center">User_ID</th>
<th align="center">Name</th>
<th align="center">Sponsor</th>
<th align="center">Status</th>
<th align="center">Pay_Status</th>
<th align="center">Join</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$arr8=array();
for($k=0;$k<$count7;$k++)
{
$sql8="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$arr7[$k]."' AND `status`='A'";
$res8=query($conn,$sql8);
$num8=numrows($res8);
if($num8>0)
{
while($fetch8=fetcharray($res8))
{
$arr8[$i]=$fetch8['userid'];
?>
<tr>
<th align="center"><a href="grid-view?placement=<?=$fetch8['userid']?>"><?=$fetch8['userid']?></a></th>
<th align="center"><?=ucwords(strtolower($fetch8['name']))?></th>
<th align="center"><?php if($fetch8['sponsor']){?><?=$fetch8['sponsor']?><?php }else{?>----<?php }?></th>
<th align="center"><?php if($fetch8['status']=='A'){?><span style="color:#00CC00;">Active</span><?php }else{?><span style="color:#FF0000;">Inactive</span><?php }?></th>
<th align="center"><?php if($fetch8['paystatus']=='A'){?><span style="color:#00CC00;">Paid</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th>
<th align="center"><?=$fetch8['date']?></th>
</tr>
<?php $i++;}}}?>
</tbody>
</table>
<?php }?>
<?php
$count8=count($arr8);
if($count8>0)
{?>
<?php }?>

</div>
</div>
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

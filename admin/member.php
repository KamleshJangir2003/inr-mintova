<?php include('head.php') ;
$left=411;
?>

<?php include('header.php') ?>

<?php include('sidebar.php') ?>
<div class="jumps-prevent" style="padding-top: 20px;"></div>


<div class="main-content app-content">

<div class="main-container container-fluid">

<div class="main-content-body">
<div class="row row-sm">

<?php if($_REQUEST['inc']=='memdet'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
    <h4 class="card-title">Member Details</h4>
<a href="member-export" class="btn btn-success mt-3">Download Excel</a>
<form action="member?inc=memdet&act=search" method="post" class="mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by User ID, Name or Phone" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
</div>


<div>&nbsp;</div>
<div class="table-responsive">
<?php

$tname = 'imaksoft_member';
$lim = 10000;
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
            <thead>
                <tr align="Center">
                    <th>Sl_No</th>
                    <th>User ID</th>
                    <th>Direct_Login</th>
                    <th>Sponsor</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Transaction_Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>INR_TRC20_Wallet</th>
                    <th>Pay_Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($num > 0): $i = 1; ?>
                    <?php while ($fetch = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td align="center"><?php echo $i++; ?></td>
                            <td align="center"><?php echo htmlspecialchars($fetch['userid']); ?></td>
                            <td align="center">
                                <a href="../mem/admin-login-process?userid=<?php echo urlencode($fetch['userid']); ?>&password=<?php echo urlencode(base64_decode($fetch['password'])); ?>&ch=sc" target="_blank">
                                    <strong style="color:#ffeb07;">Login</strong>
                                </a>
                            </td>
                            <td align="center"><?php echo !empty($fetch['sponsor']) ? htmlspecialchars($fetch['sponsor']) : '---'; ?></td>
                            <td align="center"><?php echo ucfirst(htmlspecialchars($fetch['name'])); ?></td>
                            <td align="center"><?php echo htmlspecialchars(base64_decode($fetch['password'])); ?></td>
                            <td align="center"><?php echo ucfirst(htmlspecialchars($fetch['tpassword'])); ?></td>
                            <td align="center"><?php echo htmlspecialchars($fetch['email']); ?></td>
                            <td align="center"><?php echo htmlspecialchars($fetch['phone']); ?></td>
                            <td align="center"><?php echo htmlspecialchars($fetch['bitcoin']); ?></td>
                            <td align="center">
                                <a href="member-process?case=status&id=<?php echo $fetch['id']; ?>&st=<?php echo $fetch['status']; ?>" onclick="return confirm('Change status?');">
                                    <span style="color:<?php echo ($fetch['status'] == 'I') ? '#CC0000' : '#00CC00'; ?>;">
                                        <?php echo ($fetch['status'] == 'I') ? 'Unblock' : 'Block'; ?>
                                    </span>
                                </a>
                            </td>
                            <td align="center" style="padding:5px; color:<?php echo ($fetch['paystatus'] == 'A') ? '#00CC00' : '#FF0000'; ?>;">
                                <?php echo ($fetch['paystatus'] == 'A') ? 'Paid' : 'Pending'; ?>
                            </td>
                            <td align="center"><?php echo htmlspecialchars($fetch['date']); ?></td>
                            <td align="center">
                                <!--<a href="member?inc=view&id=<?php echo $fetch['id']; ?>">-->
                                <!--    <img src="images/eye.png" title="View Details" height="18">-->
                                <!--</a>-->
                                <a href="member?inc=edit&id=<?php echo $fetch['id']; ?>">
                                    <img src="images/edit.png" title="Edit">
                                </a>
                                <!--<a href="member-process?case=delete&id=<?php echo $fetch['id']; ?>" onclick="return confirm('Are you sure want to delete this?')">-->
                                <!--    <img src="images/delete.png" title="Delete">-->
                                <!--</a>-->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" align="center" style="color:#FF0000;">No Record Found!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>
</div>
</div>
</div>
</div>

<?php }else if($_REQUEST['inc']=='bank'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">

<div class="col-md-12">

<div class="card">
<div class="card-header">
<div class="card-title">Members Bank Details</div>
</div>
<div class="card-body" style="overflow:auto;">

<table class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
<thead>
<tr align="center">
<th width="82" align="center">Sl_No.</th>                           
<th width="168" align="center">User_ID</th>             
<th width="182" align="center">Name</th>                        
<th width="176" align="center">Bank</th>                        
<th width="406" align="center">Branch</th>
<th width="406" align="center">Account_Name</th>
<th width="406" align="center">Account_No</th>
<th width="406" align="center">IFS_Code</th>
</tr>
</thead>
<tbody>
<?php
$tname = 'imaksoft_member';
$lim = 100;
$tpage = 'bank-details.php';

$where = "";
if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'search' && !empty($_POST['search'])) {
    $search = trim(mysqli_real_escape_string($conn, $_POST['search']));
    $where = "WHERE `userid` LIKE '%$search%' OR `name` LIKE '%$search%'";
}

$sql = "SELECT * FROM `$tname` $where ORDER BY `id` DESC LIMIT $lim";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
$i = 1;
?>

<tbody>
<?php if ($num > 0): ?>
    <?php while ($fetch = mysqli_fetch_assoc($result)): ?>
        <tr align="center">
            <td><?=$i?></td>
            <td><?=$fetch['userid']?></td>
                        <td align="center"><?=getMemberUserid($conn, $fetch['userid'], 'name')?></td>

            <td><?= $fetch['bname'] ?: '<span style="color:#FF0000;">Not Updated</span>' ?></td>
            <td><?= $fetch['branch'] ?: '<span style="color:#FF0000;">Not Updated</span>' ?></td>
            <td><?= $fetch['accname'] ?: '<span style="color:#FF0000;">Not Updated</span>' ?></td>
            <td><?= $fetch['accno'] ?: '<span style="color:#FF0000;">Not Updated</span>' ?></td>
            <td><?= $fetch['ifscode'] ?: '<span style="color:#FF0000;">Not Updated</span>' ?></td>
        </tr>
        <?php $i++; ?>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="8" align="center" style="color:#FF0000;">No Record Found!</td></tr>
<?php endif; ?>
</tbody>

</table>
</div>
<div align="center"><?=$pagination?></div>
</div>
</div>
</div>
</div>
</div>
</div>



<?php }else if($_REQUEST['inc']=='view'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Level Income Statement</h4>
</div>

<div>&nbsp;</div>
<div class="table-responsive">
<?php
$sql="SELECT * FROM `imaksoft_member` WHERE `id`='".trim($_REQUEST['id'])."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res)
?>
<table width="95%" class="table table-striped table-bordered table-hover" id="sample_1">
<tr><th width="33%">User ID</th><th width="67%"><?=$fetch['userid']?></th></tr>
<tr><th>Sponsor ID</th><th><?php if($fetch['sponsor']){?><?=$fetch['sponsor']?><?php }else{?>--<?php }?></th></tr>
<tr><th>Placement</th><th><?php if($fetch['placement']){?><?=$fetch['placement']?><?php }else{?>--<?php }?></th></tr>
<tr><th>Name</th><th><?=ucfirst($fetch['name'])?></th></tr>
<tr><th>Password</th><th><?=base64_decode($fetch['password'])?></th></tr>
<tr><th>Email</th><th><?=$fetch['email']?></th></tr>
<tr><th>Phone</th><th><?=$fetch['phone']?></th></tr>
<tr><th>Address</th><th><?=$fetch['address']?></th></tr>
<tr><th>Status</th><th><?php if($fetch['status']=='A'){?><span style="color:#009900;">Active</span><?php }else{?><span style="color:#FF0000;">Pending</span><?php }?></th></tr>
<tr><th>Joining</th><th><?=$fetch['date']?></th></tr>

<tr><th>Bank</th><th><?=$fetch['bname']?></th></tr>
<tr><th>Branch</th><th><?=$fetch['branch']?></th></tr>
<tr><th>Account Holder Name</th><th><?=$fetch['accname']?></th></tr>
<tr><th>Account No</th><th><?=$fetch['accno']?></th></tr>
<tr><th>IFS Code</th><th><?=$fetch['ifscode']?></th></tr>

<tr><th>Bitcoin</th><th><?=$fetch['bitcoin']?></th></tr>
<tr><th>UPI</th><th><?=$fetch['upi']?></th></tr>

</table>
<?php } ?>
</div>
</div>
</div>
</div>
</div>


<?php }else if($_REQUEST['inc']=='edit'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Member Details</h4>
</div>
<div class="card-body">
<?php if($_REQUEST['e']=='1'){?><p align="center" style=" color:#FF0000;">Already exists!</p><?php }?>
<?php if($_REQUEST['m']=='1'){?><p align="center" style=" color:#00CC33;">Updated successfully!</p><?php }?>

<?php 
$sql="SELECT * FROM `imaksoft_member` WHERE `id`='".trim($_REQUEST['id'])."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
?>
<form class="form" action="member-process?case=edit&id=<?=$_REQUEST['id']?>&page=<?=$_REQUEST['page']?>" method="post">
<div class="form-body">

<div class="form-group">
<label for="userinput5">Name</label>
<input class="form-control border-primary" type="text" placeholder="Enter Name" id="name" name="name" value="<?=$fetch['name']?>">
</div>

<div class="form-group">
<label for="userinput5">Password</label>
<input class="form-control border-primary" type="text" placeholder="Enter Password" id="password" name="password" value="<?=base64_decode($fetch['password'])?>">
</div>

<div class="form-group">
<label for="userinput5">Transaction Password</label>
<input class="form-control border-primary" type="text" placeholder="Enter Transaction Password" id="tpassword" name="tpassword" value="<?=$fetch['tpassword']?>">
</div>


<div class="form-group">
<label for="userinput5">Email</label>
<input class="form-control border-primary" type="text" placeholder="Enter Email" id="email" name="email" value="<?=$fetch['email']?>" />
</div>

<div class="form-group">
<label for="userinput5">Phone</label>
<input class="form-control border-primary" type="text" placeholder="Enter Phone" id="phone" name="phone" value="<?=$fetch['phone']?>" />
</div>


<input class="form-control border-primary" type="hidden" placeholder="Enter Address" required id="address" name="address" value="<?=$fetch['address']?>" />



<input class="form-control border-primary" type="hidden" placeholder="Enter Bank Name" required id="bname" name="bname" value="<?=$fetch['bname']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter Branch" required id="branch" name="branch" value="<?=$fetch['branch']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter Account Holder Name" required id="accname" name="accname" value="<?=$fetch['accname']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter Account No" required id="accno" name="accno" value="<?=$fetch['accno']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter IFS Code" required id="ifscode" name="ifscode" value="<?=$fetch['ifscode']?>" />


<div class="form-group">
<label for="userinput5">INR TRC20 Wallet Address<span style="color:#CC0000;">*</span></label>
<input class="form-control border-primary" type="text" placeholder="Enter INR TRC20 Wallet Address" required id="bitcoin" name="bitcoin" value="<?=$fetch['bitcoin']?>" />
</div>


<input class="form-control border-primary" type="hidden" placeholder="Enter UPI" required id="upi" name="upi" value="<?=$fetch['upi']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter Pan Card" required id="pancard" name="pancard" value="<?=$fetch['pancard']?>" />

<input class="form-control border-primary" type="hidden" placeholder="Enter Aadhar Card" required id="aadharcard" name="aadharcard" value="<?=$fetch['aadharcard']?>" />


</div>

<div class="form-actions right">

<button type="submit" class="btn btn-primary">
<i class="icon-check2"></i>Submit</button>
</div>
</form>
<?php }?>
</div>
</div>
</div>
</div>
</div>




<?php }else if($_REQUEST['inc']=='kyc'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Kyc Details</h4>
</div>

<div>&nbsp;</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr>
<th width="10%">Sl_No.</th>                         
<th width="10%">User_ID</th>                
<th width="10%">Name</th>                       
<th width="10%">Identity_Proof</th> 
<th width="10%">Status</th>                     
<th width="10%">Address_Proof</th>
<th width="10%">Status</th>
<th width="10%">Date</th>   
<th width="10%">Action</th>
</tr>
</thead>
<tbody>

<?php
$tname='imaksoft_member_kyc';
$lim=10000;
$tpage='kyc-details.php';

if($_REQUEST['act']=='search')
{
$where="WHERE `userid` LIKE '".trim($_POST['search'])."' ORDER BY `id` DESC";
}else{
$where="ORDER BY `id` DESC";
}
include('pagination.php');
$num=numrows($result);
$i=1;
if($num>0)
{
while($fetch=fetcharray($result))
{
?>
<tr align="center">
<td style="padding:2px;"><?=$i?></td>
<td style="padding:2px;"><?=$fetch['userid']?></td>
<td style="padding:2px;"><?=getMemberUserid($conn,$fetch['userid'],'name')?></td>

<td style="padding:2px;"><?php if($fetch['idproof']){?><img src="../member/kyc/<?=$fetch['idproof']?>" height="100" width="100" /><?php }?></td>

<td style="padding:2px;"><?php if($fetch['idstatus']=='I'){?><a href="kyc-status.php?case=idstatus&id=<?=$fetch['id']?>&st=<?=$fetch['idstatus']?>" style="text-decoration:none;" onClick="return confirm('Are you sure want to change the status?');"><span class="label label-info" style="color:#FF0000;">Pending</span></a><?php }else{?><a href="kyc-status.php?case=idstatus&id=<?=$fetch['id']?>&st=<?=$fetch['idstatus']?>" style="text-decoration:none;" onClick="return confirm('Are you sure want to change the status?');"><span class="label label-success" style="color:#00CC00;">Approved</span></a><?php }?></td>

<td style="padding:2px;"><?php if($fetch['address']){?><img src="../member/kyc/<?=$fetch['address']?>" height="100" width="100" /><?php }?></td>

<td style="padding:2px;"><?php if($fetch['addstatus']=='I'){?><a href="kyc-status.php?case=addstatus&id=<?=$fetch['id']?>&st=<?=$fetch['addstatus']?>" style="text-decoration:none;" onClick="return confirm('Are you sure want to change the status?');"><span class="label label-info" style="color:#FF0000;">Pending</span></a><?php }else{?><a href="kyc-status.php?case=addstatus&id=<?=$fetch['id']?>&st=<?=$fetch['addstatus']?>" style="text-decoration:none;" onClick="return confirm('Are you sure want to change the status?');"><span class="label label-success" style="color:#00CC00;">Approved</span></a><?php }?></td>

<td style="padding:2px;"><?=$fetch['date']?></td>
<td align="center" style="padding:5px;">
<a href="kyc-status.php?case=delete&id=<?=$fetch['id']?>" onclick="return confirm('Are you sure want to delete?');"><img src="images/delete.png" /></a></td>
</tr>              
<?php $i++;}}else{?>
<tr><td colspan="9" align="center" style="color:#FF0000;">No Record Found!</td></tr>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<?php }else if($_REQUEST['inc']=='income'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Wallet Details</h4>
</div>

<div>&nbsp;</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr>
<th style="text-align:center;">Sl_No</th>
<th style="text-align:center;">User_ID</th>
<th style="text-align:center;">Name</th>
<th style="text-align:center;">Total_Income</th>
<th style="text-align:center;">ROI_Wallet</th>
<th style="text-align:center;">Current_Wallet</th>
</tr>
</thead>
<tbody>

<?php
$tname='imaksoft_member';
$lim=100;
$tpage='income-statement.php';

if($_REQUEST['act']=='search')
{
$where="WHERE `userid` LIKE '".input($_POST['search'])."' ORDER BY `id` DESC";
}else{
$where="ORDER BY `id` DESC";
}

include('pagination.php');
$num=numrows($result);
$i=1;
if($num>0)
{
while($fetch=fetcharray($result))
{
?>
<tr>
<td align="center" ><?=$i?></td>
<td align="center"><?=$fetch['userid']?></td>
<td align="center" ><?=ucfirst(getMemberUserid($conn,$fetch['userid'],'name'))?></td>
<td align="center"><?=geTotalCommission($conn,$fetch['userid'])?></td>
<td align="center"><?=getROIBonus($conn,$fetch['userid'])?></td>
<td align="center"><?=getAvailableFundWallet($conn,$fetch['userid'])?></td>

</tr>
<?php $i++;}}else{?>
<tr><td colspan="9" align="center" style="color:#FF0000;">No Record Found!</td></tr>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<?php }else if($_REQUEST['inc']=='pen'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
    <h4 class="card-title">Inactive / Pending Members</h4>
    <form action="member?inc=pen&act=search" method="post" class="mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by User ID, Name or Phone">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
</div>
<div class="table-responsive">
<?php
$where = "WHERE `paystatus`='I'";
if (isset($_GET['act']) && $_GET['act'] === 'search' && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, trim($_POST['search']));
    $where = "WHERE `paystatus`='I' AND (`userid` LIKE '%$search%' OR `name` LIKE '%$search%' OR `phone` LIKE '%$search%')";
}
$result = mysqli_query($conn, "SELECT * FROM `imaksoft_member` $where ORDER BY `id` DESC");
$num = mysqli_num_rows($result);
?>
<table class="table table-bordered table-striped">
<thead>
<tr align="center">
    <th>Sl_No</th>
    <th>User ID</th>
    <th>Sponsor</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>TRC20 Wallet</th>
    <th>Date</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php if ($num > 0): $i = 1; ?>
    <?php while ($fetch = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td align="center"><?=$i++?></td>
        <td align="center"><?=htmlspecialchars($fetch['userid'])?></td>
        <td align="center"><?=!empty($fetch['sponsor']) ? htmlspecialchars($fetch['sponsor']) : '---'?></td>
        <td align="center"><?=ucfirst(htmlspecialchars($fetch['name']))?></td>
        <td align="center"><?=htmlspecialchars($fetch['phone'])?></td>
        <td align="center"><?=htmlspecialchars($fetch['email'])?></td>
        <td align="center"><?=htmlspecialchars($fetch['bitcoin'])?></td>
        <td align="center"><?=htmlspecialchars($fetch['date'])?></td>
        <td align="center">
            <a href="member-process?case=activate&id=<?=$fetch['id']?>&redirect=pen" onclick="return confirm('Activate this member?');" style="color:#00CC00;"><strong>Activate</strong></a>
            &nbsp;|
            <a href="member?inc=edit&id=<?=$fetch['id']?>">
                <img src="images/edit.png" title="Edit" height="16">
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="9" align="center" style="color:#FF0000;">No Inactive Members Found!</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<?php }else if($_REQUEST['inc']=='act'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">
<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
    <h4 class="card-title">Activation Pending Members</h4>
    <form action="member?inc=act&act=search" method="post" class="mt-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by User ID, Name or Phone">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
</div>
<div class="table-responsive">
<?php
$where = "WHERE `paystatus`='I'";
if (isset($_GET['act']) && $_GET['act'] === 'search' && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, trim($_POST['search']));
    $where = "WHERE `paystatus`='I' AND (`userid` LIKE '%$search%' OR `name` LIKE '%$search%' OR `phone` LIKE '%$search%')";
}
$result = mysqli_query($conn, "SELECT * FROM `imaksoft_member` $where ORDER BY `id` DESC");
$num = mysqli_num_rows($result);
?>
<table class="table table-bordered table-striped">
<thead>
<tr align="center">
    <th>Sl_No</th>
    <th>User ID</th>
    <th>Sponsor</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Date</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php if ($num > 0): $i = 1; ?>
    <?php while ($fetch = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td align="center"><?=$i++?></td>
        <td align="center"><?=htmlspecialchars($fetch['userid'])?></td>
        <td align="center"><?=!empty($fetch['sponsor']) ? htmlspecialchars($fetch['sponsor']) : '---'?></td>
        <td align="center"><?=ucfirst(htmlspecialchars($fetch['name']))?></td>
        <td align="center"><?=htmlspecialchars($fetch['phone'])?></td>
        <td align="center"><?=htmlspecialchars($fetch['email'])?></td>
        <td align="center"><?=htmlspecialchars($fetch['date'])?></td>
        <td align="center">
            <a href="member-process?case=activate&id=<?=$fetch['id']?>" onclick="return confirm('Activate this member?');" style="color:#00CC00;"><strong>Activate</strong></a>
        </td>
    </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="8" align="center" style="color:#FF0000;">No Pending Members Found!</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<?php }else if($_REQUEST['inc']=='invd'){?>
<div class="main-panel">
<div class="content">
<div class="page-inner">

<div class="row">
<div class="col-xs-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">Investment Details</h4>
</div>

<div>&nbsp;</div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead class="bg-teal bg-lighten-4">
<tr>
<th style="text-align:center;">Sl_No</th>
<th style="text-align:center;">User_ID</th>
<th style="text-align:center;">Name</th>
<th style="text-align:center;">Package</th>
<th style="text-align:center;">Amount</th>
<th style="text-align:center;">Date</th>
</tr>
</thead>
<tbody>

<?php
$tname='imaksoft_member_investment';
$lim=100;
$tpage='investment-statement.php';

if($_REQUEST['act']=='search')
{
$where="WHERE `userid` LIKE '".input($_POST['search'])."' ORDER BY `id` DESC";
}else{
$where="ORDER BY `id` DESC";
}

include('pagination.php');
$num=numrows($result);
$i=1;
if($num>0)
{
while($fetch=fetcharray($result))
{
?>
<tr>
<td align="center"><?=$i?></td>
<td align="center" ><?=$fetch['userid']?></td>
<td align="center" ><?=ucfirst(getMemberUserid($conn,$fetch['userid'],'name'))?></td>
<td align="center"><?=getSettingsPackage($conn,$fetch['package'],'plan')?></td>
<td align="center" ><?=$fetch['amount']?></td>
<td align="center" ><?=$fetch['date']?></td>
</tr>
<?php $i++;}}else{?>
<tr><td colspan="6" align="center" style="color:#FF0000;">No Record Found!</td></tr>
<?php }?>
</tbody>
</table>
</div>
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

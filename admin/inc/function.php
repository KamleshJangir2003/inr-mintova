<?php
declare(strict_types=1);

/*-----------------Database Connection-----------------------*/
$conn = mysqli_connect('localhost', 'u937873453_new', 'u937873453_New', 'u937873453_new');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Kolkata');
/*-----------------Database Connection-----------------------*/

$title = 'Mintova';
$domain = 'www.jerryglow.com';
$welcome = 'welcome@jerryglow.com';
$support = 'support@jerryglow.com';
$recovery = 'recovery@jerryglow.com';
$prefix = 'MS';
$currency = 'Rs.';

function redirect($url)
{
header('Location: '.$url);
exit();
}
function query($conn,$sql)
{
$res=mysqli_query($conn,$sql);
return $res;
}
function numrows($exe)
{
$no=mysqli_num_rows($exe);
return $no;
}
function fetcharray($res)
{
$fetch=mysqli_fetch_array($res);
return $fetch;
}

function input($string)
{
$string=addslashes(trim(strip_tags($string)));
return $string;
}

function output($string)
{
$string=stripslashes(trim(strip_tags($string)));
return $string;
} 

function getUser($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_admin` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}


function getAdminName($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_admin` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}


function getSettingsJoining($conn,$field)
{
$sql="SELECT * FROM `imaksoft_settings_direct` ORDER BY `id` LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getDirectBonusMember($conn,$userid)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_direct` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getTotalDirectBonus($conn)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_direct` ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

//-------------23-07-2019-----------//
function getFirstMember($conn)
{
$sql="SELECT * FROM `imaksoft_member` ";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $num;
}
}


function getNoAnnouncement($conn)
{
$sql="SELECT * FROM `imaksoft_announcement` ";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $num;
}
}

function getContactDetails($conn,$field)
{
$sql="SELECT * FROM `imaksoft_contact` ";
$res=query($conn,$sql);
 $num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}

function getFromUserID($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getUserID($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

//-------------26-07-2019-----------//

function getMember($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_member` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}



function getAnnouncement($conn,$field)
{
$sql="SELECT * FROM `imaksoft_announcement` ORDER BY `id` DESC";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getCommStatus($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_commission_roi` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getMemberUserid($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getSettingsPackage($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_settings_package` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

/*------------31-07-2019---------------------*/
function getTotalMember($conn)
{
$sql="SELECT `id` FROM `imaksoft_member`";
$res=query($conn,$sql);
$num=numrows($res);

return $num;
}


function getApprovedMember($conn)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `status`='A' AND `paystatus`='A'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getInactiveMember($conn)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `status`='A' AND `paystatus`='I'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getPendingWithdrawalMember($conn,$userid)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `userid`='".$userid."' AND `status`='P'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getTokenBuyMember($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_token_transactions` WHERE `userid`='".$userid."' ";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getMyTokenBuyMember($conn,$userid)
{
$sql="SELECT SUM(`tokens`) AS total FROM `imaksoft_token_transactions` WHERE `userid`='".$userid."' ";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getApprovedWithdrawalMember($conn,$userid)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `userid`='".$userid."' AND  `status`='C'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getWithdrawalMember($conn,$userid)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}

function getAddress($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_contact` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}

function getPendingWithdrawalAdmin($conn)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `status`='P' ";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}

function getApprovedWithdrawalAdmin($conn)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `status`='C'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}


function getNoOfFeedback($conn)
{
$sql="SELECT `id` FROM `imaksoft_feedback`";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getTotalSupport($conn)
{
$sql="SELECT `id` FROM `imaksoft_support`";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getNoOfSponsor($conn,$sponsor)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `sponsor`='".$sponsor."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getSponsorPosition($conn,$sponsor,$position)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `sponsor`='".$sponsor."' AND `position`='".$position."' AND `paystatus`='A'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getWithdrawalAdmin($conn)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getPendingWithdrawal($conn)
{
$sql="SELECT SUM(`payout`) AS total FROM `imaksoft_withdrawal` WHERE `status`='P' ORDER BY `id` DESC";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}

function getApprovedWithdrawal($conn)
{
$sql="SELECT SUM(`payout`) AS total FROM `imaksoft_withdrawal` WHERE `status`='A' ORDER BY `id` DESC";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getMemberFirstMember($conn)
{
$sql="SELECT * FROM `imaksoft_member` ORDER BY `id` LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch['userid'];
}
}

function getTotalROIBonus($conn)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_roi` WHERE`status`='R'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getTotalLevelBonus($conn)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_level` ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getTotalAdsBonus($conn)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_ads` ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getROIBonus($conn,$userid)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_roi` WHERE `userid`='".$userid."' AND `status`='R' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getLevelBonus($conn,$userid)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_level` WHERE `userid`='".$userid."'  ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getAdsBonus($conn,$userid)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_ads` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}


function getInvestmentDeposit($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_member_roi` WHERE `userid`='".$userid."' AND `remarks`='Deposit' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getIMPSWithdrawal($conn,$userid)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal_imps` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}

function getTotalIMPSWithdrawal($conn)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal_imps` ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getMemberWithdrawal($conn,$userid)
{
$sql="SELECT SUM(`request`) AS total FROM `imaksoft_withdrawal` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}
function getMemberCoinPayment($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_member_coinpayment` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}




function getPaymentApproved($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `mi_member_payment` WHERE `userid`='".$userid."' AND `status`='C' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}



function getPaymentApprovedOnline($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `transaction` WHERE `userid`='".$userid."' AND `status`='Approved' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getWithdrawalMember1($conn,$userid)
{
    $sql = "SELECT SUM(`request`) AS total 
            FROM `imaksoft_withdrawal` 
            WHERE `userid` = '".$userid."' AND `status` = 'C'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getAvailableWallet($conn,$userid)
{
$total=(geTotalCommission($conn,$userid)+getDepositMember($conn,$userid)+getPaymentApproved($conn,$userid))-(getWithdrawalMember1($conn,$userid)+getDeductMember($conn,$userid)+getMemberInvestment($conn,$userid)+getTokenBuyMember($conn,$userid));

return $total;
}


function getAvailableFundWallet($conn,$userid)
{
$total=(getDepositMember($conn,$userid)+geTotalCommission($conn,$userid))-(getDeductMember($conn,$userid)+getMemberInvestment($conn,$userid)+getWithdrawalMember1($conn,$userid));

return $total;
}

function geTotalCommission($conn,$userid)
{
$total=(getROIBonus($conn,$userid)+getLevelBonus($conn,$userid)+getDirectBonusMember($conn,$userid)+getLevelROIBonus($conn,$userid)+getRewardddBonus($conn,$userid));

return $total;
}


function getROIWallet($conn,$userid)
{

}

function getMemberInvestment($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_member_investment` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getDepositMember($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_deposit` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getDeductMember($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_deduct` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}


function getPendingTotalWithdrawal($conn,$column)
{
$sql="SELECT SUM(`".$column."`) AS total FROM `imaksoft_withdrawal` WHERE`status`='P'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getApprovedTotalWithdrawal($conn,$column)
{
$sql="SELECT SUM(`".$column."`) AS total FROM `imaksoft_withdrawal` WHERE `status`='C'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

//---------------------------18/12/2019---------------------//
function getNoOfActiveSponsor($conn,$userid)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `sponsor`='".$userid."' AND `status`='A' AND `paystatus`='A'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

//---------------------19/12/2019-----------------------//
function getActiveSponsorDate($conn,$sponsor,$fmdate,$todate)
{
$sql="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$sponsor."' AND `paystatus`='A' AND `date` BETWEEN '".$fmdate."' AND '".$todate."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}



function getAchievedMember($conn,$userid,$table,$nomember,$fmdate,$todate)
{
$sql="SELECT `id` FROM `".$table."` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

$noactive=getActiveSponsorDate($conn,$userid,$fmdate,$todate);
if($noactive>=$nomember)
{
$next=($nomember-1);

$sql2="SELECT * FROM `imaksoft_member` WHERE `sponsor`='".$userid."' AND `paystatus`='A' AND `date` BETWEEN '".$fmdate."' AND '".$todate."' ORDER BY `id` LIMIT $next,1";
$res2=query($conn,$sql2);
$num2=numrows($res2);
$fetch2=fetcharray($res2);

$sql1="SELECT * FROM `".$table."` WHERE `id`>'".$fetch2['id']."'";
$res1=query($conn,$sql1);
$num1=numrows($res1);

if($num1>0){$total=$num1;}else{$total=0;}
}else{
$total=0;
}
}else{
$total=0;
}
return $total;
}


function getFromDateGenealogy($conn,$table,$userid)
{
$sql="SELECT * FROM `".$table."` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['date'];
}
}

function getMemberSponsorByDate($conn,$userid,$fromdate,$todate)
{
$sql="SELECT `id` FROM `imaksoft_member` WHERE `sponsor`='".$userid."' AND `paystatus`='A' AND `approved` BETWEEN '".$fromdate."' AND '".$todate."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

//----------------------18/03/2020---------------------//
function getUplineID($conn,$userid)
{
$sql="SELECT * FROM `imaksoft_genealogy` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch['placement'];
}
}

function getDownlineByPosition($conn,$sponsor,$position)
{
$sql="SELECT * FROM `imaksoft_genealogy` WHERE `placement`='".$sponsor."' AND `position`='".$position."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch['userid'];
}
}

function getDownlinePosition($conn,$userid,$placement)
{
$sql1="SELECT * FROM `imaksoft_genealogy` WHERE `userid`='".$userid."' AND `placement`='".$placement."'";
$res1=query($conn,$sql1);
$num1=numrows($res1);
if($num1>0)
{
$fetch1=fetcharray($res1);

return $fetch1['position'];
}
}

function getTotalSales($conn,$userid)
{
$total=getSales($conn,$userid,'left')+getSales($conn,$userid,'right');
return $total;
}

function getSettingsWithdrawal($conn,$field)
{
$sql="SELECT * FROM `imaksoft_settings_withdrawal` ORDER BY `id` DESC LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getSettingsLevel($conn,$level)
{
$sql="SELECT * FROM `imaksoft_settings_level` WHERE `level`='".$level."' ORDER BY `id` DESC LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['percentage'];
}
}

function getCountry($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_country` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getCountAccount($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_commission_roi` WHERE `userid`='".$userid."' ";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getMatrixTreeFirst($conn,$placement)
{
$sql="SELECT * FROM `imaksoft_genealogy` WHERE `placement`='".$placement."' ORDER BY `id` LIMIT 0,1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['userid'];
}
}

function getMatrixTreeSecond($conn,$placement)
{
$sql="SELECT * FROM `imaksoft_genealogy` WHERE `placement`='".$placement."' ORDER BY `id` LIMIT 1,1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['userid'];
}
}

function getMatrixTreeThird($conn,$placement)
{
$sql="SELECT * FROM `imaksoft_genealogy` WHERE `placement`='".$placement."' ORDER BY `id` LIMIT 2,1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['userid'];
}
}

function getLastROIAccount($conn,$userid)
{
$sql="SELECT * FROM `imaksoft_member_roi` WHERE `userid`='".$userid."' ORDER BY `id` DESC LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

$last=$fetch['account'];
}else{
$last=0;
}
return $last;
}

function getMemberCount($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member_count` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}

function getKycInformation($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member_kyc` WHERE `userid`='".$userid."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getSettingsCoinpayment($conn,$field)
{
$sql="SELECT * FROM `imaksoft_settings_coin_payment` ORDER BY `id` LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getCoinPaymentByInvoice($conn,$invoice,$field)
{
$sql="SELECT * FROM `imaksoft_member_coinpayment` WHERE `invoice`='".$invoice."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}


function getMemberAdsVisit($conn,$userid,$adsid,$date)
{
$sql="SELECT * FROM `imaksoft_advertisement_view` WHERE `userid`='".$userid."' AND `adsid`='".$adsid."' AND `date`='".$date."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getAdvertisementNum($conn)
{
$sql="SELECT * FROM `imaksoft_advertisement`";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getAdvertisementByPackage($conn,$package)
{
$sql="SELECT * FROM `imaksoft_advertisement` WHERE `package`='".$package."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}


function getMemberAdsNum($conn,$userid,$date)
{
$sql="SELECT * FROM `imaksoft_advertisement_view` WHERE `userid`='".$userid."' AND `date`='".$date."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getAdvertisement($conn,$id,$field)
{
$sql="SELECT * FROM `imaksoft_advertisement` WHERE `id`='".$id."'";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch[$field];
}
}

function getMemberAds($conn,$userid,$date)
{
$sql="SELECT * FROM `imaksoft_advertisement_view` WHERE `userid`='".$userid."' AND `date`='".$date."'";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getTotalAdvertisement($conn)
{
$sql="SELECT * FROM `imaksoft_advertisement` WHERE `status`='A' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
return $num;
}

function getPackageMember($conn,$userid,$field)
{
$sql="SELECT * FROM `imaksoft_member_investment` WHERE `userid`='".$userid."' ORDER BY `id` DESC LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);
return $fetch[$field];
}
}


function getLevelROIBonus($conn,$userid)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_level_roi` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}



function getRewardddBonus($conn,$userid)
{
$sql="SELECT SUM(`amount`) AS total FROM `imaksoft_task_collection` WHERE `userid`='".$userid."' ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}

function getTotalLevelROIBonus($conn)
{
$sql="SELECT SUM(`bonus`) AS total FROM `imaksoft_commission_level_roi` ORDER BY `id`";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

if($fetch['total']>0)
{
$total=$fetch['total'];
}else{
$total=number_format(0,2);
}
}else{
$total=number_format(0,2);
}
return $total;
}


function getSettingsLevelROI($conn,$level)
{
$sql="SELECT * FROM `imaksoft_settings_level_roi` WHERE `level`='".$level."' ORDER BY `id` DESC LIMIT 1";
$res=query($conn,$sql);
$num=numrows($res);
if($num>0)
{
$fetch=fetcharray($res);

return $fetch['percentage'];
}
}
?>
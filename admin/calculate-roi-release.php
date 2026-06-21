<?php
function getLevelCalcuation($conn,$userid,$amount,$k)
{
    $currentUserid = $userid;
    for($k = 1; $k <= 20; $k++) {
        $sponsor1 = getMemberUserID($conn, $currentUserid, 'sponsor');
        if(!$sponsor1) break;
        $level = 'Level ' . $k;
        $percentage = getSettingsLevelROI($conn, $level, 'percentage');
        $bonus = ($amount * $percentage) / 100;
        if($bonus > 0) {
            $sqla = "INSERT INTO `imaksoft_commission_level_roi` (`userid`,`fromid`,`level`,`dailybonus`,`percentage`,`bonus`,`date`) VALUES('".$sponsor1."','".$userid."','".$level."','".$amount."','".$percentage."','".$bonus."','".date('Y-m-d')."')";
            query($conn, $sqla);
        }
        $currentUserid = $sponsor1;
    }
}

//------------------------------------------------//
$sqlr="SELECT * FROM `imaksoft_commission_roi` WHERE `status`='H' AND `date`<='".date('Y-m-d')."'";
$resr=query($conn,$sqlr);
$numr=numrows($resr);
if($numr>0)
{
while($fetchr=fetcharray($resr))
{
$sqlr2="UPDATE `imaksoft_commission_roi` SET `status`='R'  WHERE `date`='".date('Y-m-d')."'  AND `id`='".$fetchr['id']."'";
$resr2=query($conn,$sqlr2);

$userid=$fetchr['userid'];
$amount=$fetchr['bonus'];

//--------------Level ROI--------------------------//
$k=1;
getLevelCalcuation($conn,$userid,$amount,$k);
//----------------------------------------//
}
}
?>
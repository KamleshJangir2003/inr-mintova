<?php
/**
 * Single Leg Plan - Daily Cron Job
 * Run this daily via cron: 0 0 * * * php /path/to/cron-sl-daily.php
 * Also handles Saturday Prize Pool distribution
 */

include('../admin/inc/function.php');

$today = date('Y-m-d');
$dayOfWeek = date('N'); // 6 = Saturday

// =============================================
// 1. Distribute Daily 2% Single Leg Income
// =============================================
$activeEarnings = $conn->query("SELECT * FROM sl_milestone_earned WHERE status='A' AND days_paid < days_total");

while ($e = $activeEarnings->fetch_assoc()) {
    // Check if already paid today
    $alreadyPaid = $conn->query("SELECT id FROM sl_daily_income WHERE userid='".mysqli_real_escape_string($conn,$e['userid'])."' AND milestone_id='".$e['milestone_id']."' AND date='$today'");
    if ($alreadyPaid->num_rows > 0) continue;

    // Credit daily amount to imaksoft_deposit (wallet)
    $conn->query("INSERT INTO imaksoft_deposit (userid, amount, date) VALUES ('".mysqli_real_escape_string($conn,$e['userid'])."', '".$e['daily_amount']."', '$today')");

    // Log in sl_daily_income
    $conn->query("INSERT INTO sl_daily_income (userid, milestone_id, amount, date) VALUES ('".mysqli_real_escape_string($conn,$e['userid'])."', '".$e['milestone_id']."', '".$e['daily_amount']."', '$today')");

    // Update days_paid
    $newDaysPaid = $e['days_paid'] + 1;
    $newStatus = $newDaysPaid >= $e['days_total'] ? 'C' : 'A';
    $conn->query("UPDATE sl_milestone_earned SET days_paid='$newDaysPaid', status='$newStatus' WHERE id='".$e['id']."'");
}

// =============================================
// 2. Saturday Prize Pool Distribution
// =============================================
if ($dayOfWeek == 6) {
    // Check if already distributed this Saturday
    $alreadyDist = $conn->query("SELECT id FROM sl_prize_pool WHERE week_end_date='$today' AND distributed=1");
    if ($alreadyDist->num_rows == 0) {

        // Count active paid members for pool amount
        $memberCount = $conn->query("SELECT COUNT(*) as total FROM imaksoft_member WHERE paystatus='A'");
        $mc = $memberCount->fetch_assoc();
        $totalPool = (int)$mc['total'] * 100;

        if ($totalPool > 0) {
            // Find achievers (10+ directs) — count directs joined this week
            $weekStart = date('Y-m-d', strtotime('monday this week'));
            $achievers = $conn->query("SELECT m.userid, COUNT(d.id) as dc FROM imaksoft_member m LEFT JOIN imaksoft_member d ON d.sponsor=m.userid AND d.paystatus='A' AND d.date >= '$weekStart' WHERE m.paystatus='A' GROUP BY m.userid HAVING dc >= 10");

            $achieverCount = $achievers->num_rows;
            if ($achieverCount > 0) {
                $perAchiever = round($totalPool / $achieverCount, 2);

                // Insert pool record
                $conn->query("INSERT INTO sl_prize_pool (week_end_date, total_amount, achievers_count, per_achiever, distributed, created_date) VALUES ('$today', '$totalPool', '$achieverCount', '$perAchiever', 1, '$today')");
                $poolId = $conn->insert_id;

                // Distribute to each achiever
                $achievers->data_seek(0);
                while ($a = $achievers->fetch_assoc()) {
                    $conn->query("INSERT INTO sl_prize_pool_log (userid, pool_id, amount, date) VALUES ('".mysqli_real_escape_string($conn,$a['userid'])."', '$poolId', '$perAchiever', '$today')");
                    $conn->query("INSERT INTO imaksoft_deposit (userid, amount, date) VALUES ('".mysqli_real_escape_string($conn,$a['userid'])."', '$perAchiever', '$today')");
                }
            } else {
                // No achievers — just log the pool
                $conn->query("INSERT INTO sl_prize_pool (week_end_date, total_amount, achievers_count, per_achiever, distributed, created_date) VALUES ('$today', '$totalPool', 0, 0, 1, '$today')");
            }
        }
    }
}

echo "Done: " . date('Y-m-d H:i:s');
?>

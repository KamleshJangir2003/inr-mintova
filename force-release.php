<?php
// For development - show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Start output buffering to see results
ob_start();

include('admin/inc/function.php');

echo "<h3>ROI Processing Report - " . date('Y-m-d H:i:s') . "</h3>";
echo "<hr>";

// Debug: Check if functions exist
echo "Checking functions:<br>";
echo "query() exists: " . (function_exists('query') ? 'YES' : 'NO') . "<br>";
echo "numrows() exists: " . (function_exists('numrows') ? 'YES' : 'NO') . "<br>";
echo "fetcharray() exists: " . (function_exists('fetcharray') ? 'YES' : 'NO') . "<br>";
echo "getMemberUserID() exists: " . (function_exists('getMemberUserID') ? 'YES' : 'NO') . "<br>";
echo "getNoOfActiveSponsor() exists: " . (function_exists('getNoOfActiveSponsor') ? 'YES' : 'NO') . "<br>";
echo "getSettingsLevelROI() exists: " . (function_exists('getSettingsLevelROI') ? 'YES' : 'NO') . "<br>";
echo "<hr>";

// FUNCTION: Check if sponsor qualifies for specific level
function checkLevelQualification($conn, $sponsorid, $levelNumber)
{
    // Get total active direct referrals
    $totalDirects = getNoOfActiveSponsor($conn, $sponsorid);
    
    echo "Checking Level $levelNumber qualification for $sponsorid: Has $totalDirects direct referrals<br>";
    
    // Check qualification based on level
    if ($levelNumber <= 6) {
        // Levels 1-6: Need at least 2 direct referrals
        if ($totalDirects >= 2) {
            // Check if they have enough for this specific level
            // For level N, they need at least N*2 directs (but max 12 for level 6)
            $requiredForLevel = $levelNumber * 2;
            if ($totalDirects >= $requiredForLevel) {
                echo "✓ $sponsorid QUALIFIES for Level $levelNumber (has $totalDirects directs, needs $requiredForLevel)<br>";
                return true;
            } else {
                echo "✗ $sponsorid NEEDS MORE for Level $levelNumber (has $totalDirects directs, needs $requiredForLevel)<br>";
                return false;
            }
        } else {
            echo "✗ $sponsorid FAILS Level $levelNumber (has only $totalDirects directs, needs at least 2)<br>";
            return false;
        }
    } 
    elseif ($levelNumber == 7) {
        // Level 7: Need at least 3 direct referrals (total 15 for all levels)
        if ($totalDirects >= 15) {
            echo "✓ $sponsorid QUALIFIES for Level 7 (has $totalDirects directs, needs 15)<br>";
            return true;
        } else {
            echo "✗ $sponsorid FAILS Level 7 (has $totalDirects directs, needs 15)<br>";
            return false;
        }
    }
    else {
        // Levels 8-20: Should not reach here based on your requirement of 7 levels
        echo "✗ $sponsorid: Level $levelNumber is beyond 7 levels system<br>";
        return false;
    }
}

// FUNCTION: Level ROI Calculation with Progressive Direct Requirements
function getLevelCalcuation($conn, $userid, $amount, $k)
{
    // Only process up to 7 levels as per your requirement
    if ($k <= 7) 
    {
        // GET SPONSOR
        $sponsor1 = getMemberUserID($conn, $userid, 'sponsor');

        if ($sponsor1) 
        {
            // CHECK IF SPONSOR QUALIFIES FOR THIS LEVEL
            $qualifies = checkLevelQualification($conn, $sponsor1, $k);
            
            if ($qualifies) 
            {
                $level = 'Level '.$k;
                $percentage = getSettingsLevelROI($conn, $level, 'percentage');
                $bonus = ($amount * $percentage) / 100;

                if ($bonus > 0) 
                {
                    // First, check if commission already exists for today to prevent duplicates
                    $check_duplicate = "SELECT id FROM imaksoft_commission_level_roi 
                                       WHERE userid = '$sponsor1' 
                                       AND fromid = '$userid' 
                                       AND level = '$level' 
                                       AND DATE(date) = CURDATE()";
                    $dup_result = query($conn, $check_duplicate);
                    
                    if (numrows($dup_result) == 0) {
                        $sqla = "
                            INSERT INTO imaksoft_commission_level_roi 
                            (userid, fromid, level, dailybonus, percentage, bonus, date)
                            VALUES 
                            ('".$sponsor1."', '".$userid."', '".$level."', '".$amount."', '".$percentage."', '".$bonus."', '".date('Y-m-d')."')
                        ";
                        $resa = query($conn, $sqla);
                        
                        if ($resa) {
                            echo "<span style='color:green;'>✓ Level $k Commission PAID: $sponsor1 received INR " . number_format($bonus,2) . " (" . $percentage . "% of INR " . number_format($amount,2) . ") from $userid</span><br>";
                        } else {
                            echo "<span style='color:red;'>✗ Failed to insert commission for $sponsor1 at Level $k</span><br>";
                        }
                    } else {
                        echo "<span style='color:orange;'>⚠ Commission already paid today for $sponsor1 at Level $k</span><br>";
                    }
                }
                else {
                    echo "⚠ Level $k: Bonus is 0 for $sponsor1 (percentage: $percentage%)<br>";
                }
            } 
            else 
            {
                echo "<span style='color:red;'>✗ Level $k Skipped: $sponsor1 doesn't meet requirements</span><br>";
                
                // Store in a pending/hold table if you want to track unmet commissions
                // This can be paid later when conditions are met
                storePendingCommission($conn, $sponsor1, $userid, $k, $amount);
            }
        }
        else
        {
            echo "Level $k: No sponsor found for $userid (End of referral chain)<br>";
            return; // Stop recursion if no sponsor
        }

        // NEXT LEVEL
        $k = $k + 1;
        getLevelCalcuation($conn, $sponsor1, $amount, $k);
    }
    else
    {
        echo "Reached maximum 7 levels<br>";
    }
}

// FUNCTION: Store pending commissions for future payment
function storePendingCommission($conn, $sponsorid, $fromid, $level, $amount)
{
    $levelName = 'Level '.$level;
    $percentage = getSettingsLevelROI($conn, $levelName, 'percentage');
    $bonus = ($amount * $percentage) / 100;
    
    if ($bonus > 0) {
        // Check if already in pending
        $check_sql = "SELECT id FROM imaksoft_pending_commissions 
                     WHERE userid = '$sponsorid' 
                     AND fromid = '$fromid' 
                     AND level = '$levelName'
                     AND DATE(date) = CURDATE()";
        $check_result = query($conn, $check_sql);
        
        if (numrows($check_result) == 0) {
            $sql = "INSERT INTO imaksoft_pending_commissions 
                   (userid, fromid, level, dailybonus, percentage, bonus, date, status)
                   VALUES 
                   ('$sponsorid', '$fromid', '$levelName', '$amount', '$percentage', '$bonus', CURDATE(), 'pending')";
            query($conn, $sql);
            
            echo "<span style='color:blue;'>📝 Pending commission stored for $sponsorid at $levelName (INR " . number_format($bonus,2) . ")</span><br>";
        }
    }
}

// ---------------------------------------------------------
// DAILY ROI PROCESSING
// ---------------------------------------------------------

echo "<h4>Step 1: Checking for pending ROI records...</h4>";

// Create pending commissions table if it doesn't exist
$create_table = "CREATE TABLE IF NOT EXISTS imaksoft_pending_commissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50),
    fromid VARCHAR(50),
    level VARCHAR(20),
    dailybonus DECIMAL(10,2),
    percentage DECIMAL(5,2),
    bonus DECIMAL(10,2),
    date DATE,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
query($conn, $create_table);

// FIRST, check if we've already processed today's ROI to prevent duplicate processing
$check_sql = "SELECT COUNT(*) as processed FROM imaksoft_commission_roi 
              WHERE status='R' AND DATE(date) = CURDATE()";
$check_result = query($conn, $check_sql);
$check_row = fetcharray($check_result);
$already_processed = $check_row['processed'];

if ($already_processed > 0) {
    echo "WARNING: ROI already processed today ($already_processed records). Processing again may create duplicates!<br>";
    echo "<strong>Advice:</strong> Run this script once daily via cron job, not by refreshing.<br>";
}

// Get today's held ROI records
$today = date('Y-m-d');
$sqlr = "SELECT * FROM imaksoft_commission_roi 
         WHERE status='H' AND DATE(date) = '$today'";
$resr = query($conn, $sqlr);
$numr = numrows($resr);

echo "Found $numr ROI records with status 'H' for today ($today)<br>";

if ($numr > 0) 
{
    $total_processed = 0;
    while ($fetchr = fetcharray($resr)) 
    {
        echo "<hr>";
        echo "<h4>Processing ROI for user: " . $fetchr['userid'] . " (Amount: INR " . $fetchr['bonus'] . ")</h4>";
        
        // UPDATE STATUS TO RELEASED
        $sqlr2 = "
            UPDATE imaksoft_commission_roi 
            SET status='R'  
            WHERE id='".$fetchr['id']."'
        ";
        $resr2 = query($conn, $sqlr2);
        
        if ($resr2) {
            echo "✓ Status updated from 'H' to 'R'<br>";
        } else {
            echo "✗ Failed to update status<br>";
        }

        $userid = $fetchr['userid'];
        $amount = $fetchr['bonus'];

        // CALL 7 LEVEL ROI (not 20 as per your requirement)
        $k = 1;
        echo "Starting level calculation for upline (7 levels max)...<br>";
        getLevelCalcuation($conn, $userid, $amount, $k);
        
        $total_processed++;
    }
    
    echo "<hr>";
    echo "<h4>Summary</h4>";
    echo "Total ROI records processed: $total_processed<br>";
    
    // Show what was generated
    $summary_sql = "SELECT 
                    COUNT(*) as total_commissions,
                    SUM(bonus) as total_payout,
                    GROUP_CONCAT(DISTINCT level ORDER BY level) as levels_paid
                    FROM imaksoft_commission_level_roi 
                    WHERE DATE(date) = CURDATE()";
    $summary_result = query($conn, $summary_sql);
    $summary_row = fetcharray($summary_result);
    
    echo "Total commissions generated today: " . $summary_row['total_commissions'] . "<br>";
    echo "Total payout amount: INR " . number_format($summary_row['total_payout'], 2) . "<br>";
    echo "Levels paid: " . ($summary_row['levels_paid'] ? $summary_row['levels_paid'] : 'None') . "<br>";
    
    // Show pending commissions
    $pending_sql = "SELECT COUNT(*) as pending_count, SUM(bonus) as pending_total 
                   FROM imaksoft_pending_commissions 
                   WHERE DATE(date) = CURDATE() AND status = 'pending'";
    $pending_result = query($conn, $pending_sql);
    $pending_row = fetcharray($pending_result);
    
    echo "Pending commissions (requirements not met): " . $pending_row['pending_count'] . " (Total: INR " . number_format($pending_row['pending_total'], 2) . ")<br>";
    
} else {
    echo "No ROI records to process today.<br>";
    
    // Show what's in the ROI table for reference
    $check_sql = "SELECT status, COUNT(*) as count FROM imaksoft_commission_roi 
                  WHERE DATE(date) = CURDATE() 
                  GROUP BY status";
    $check_result = query($conn, $check_sql);
    
    echo "Today's ROI records by status:<br>";
    if (numrows($check_result) > 0) {
        while ($row = fetcharray($check_result)) {
            echo "- Status '{$row['status']}': {$row['count']} records<br>";
        }
    } else {
        echo "No ROI records found for today.<br>";
    }
}

// Show final summary
echo "<hr>";
echo "<h4>Final Database Check</h4>";

// Check commission_level_roi table
$final_sql = "SELECT level, COUNT(*) as count, SUM(bonus) as total 
              FROM imaksoft_commission_level_roi 
              WHERE DATE(date) = CURDATE() 
              GROUP BY level 
              ORDER BY CAST(SUBSTRING(level, 7) AS UNSIGNED)";
$final_result = query($conn, $final_sql);

if (numrows($final_result) > 0) {
    echo "<table border='1' cellpadding='5' style='border-collapse: collapse;'>";
    echo "<tr style='background-color: #f2f2f2;'><th>Level</th><th>Requirements</th><th>Commissions</th><th>Total Paid</th></tr>";
    
    $level_requirements = [
        1 => "2 direct referrals",
        2 => "4 direct referrals",
        3 => "6 direct referrals",
        4 => "8 direct referrals",
        5 => "10 direct referrals",
        6 => "12 direct referrals",
        7 => "15 direct referrals"
    ];
    
    while ($row = fetcharray($final_result)) {
        $level_num = str_replace('Level ', '', $row['level']);
        $requirements = isset($level_requirements[$level_num]) ? $level_requirements[$level_num] : 'N/A';
        
        echo "<tr>";
        echo "<td>{$row['level']}</td>";
        echo "<td>{$requirements}</td>";
        echo "<td>{$row['count']}</td>";
        echo "<td>INR " . number_format($row['total'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No level commissions generated today.<br>";
}

echo "<hr>";
echo "<h4>Level Requirements Summary:</h4>";
echo "<ul>";
echo "<li><strong>Level 1:</strong> 2 direct referrals</li>";
echo "<li><strong>Level 2:</strong> 4 direct referrals</li>";
echo "<li><strong>Level 3:</strong> 6 direct referrals</li>";
echo "<li><strong>Level 4:</strong> 8 direct referrals</li>";
echo "<li><strong>Level 5:</strong> 10 direct referrals</li>";
echo "<li><strong>Level 6:</strong> 12 direct referrals</li>";
echo "<li><strong>Level 7:</strong> 15 direct referrals</li>";
echo "</ul>";
echo "<p><strong>Note:</strong> All referrals must be active direct referrals (not downline).</p>";

// Flush output
ob_end_flush();
?>
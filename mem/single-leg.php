<?php
session_start();
include('../admin/inc/function.php');
if(!isset($_SESSION['mid'])) redirect('../index');
$userid = getMember($conn, $_SESSION['mid'], 'userid');

// Get counts first (single queries)
$teamCount   = getSLTeamCount($conn, $userid);
$directCount = getSLDirectCount($conn, $userid);

// Award milestones/rewards only if needed (check before heavy call)
checkAndAwardSLMilestones($conn, $userid);
checkAndAwardSLRewards($conn, $userid);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <title><?=$title?></title>
  <link rel="shortcut icon" href="assets/images/favicon.ico"/>
  <link rel="stylesheet" href="assets/css/core/libs.min.css"/>
  <link rel="stylesheet" href="assets/css/coinex.min.css?v=1.0.0"/>
  <link rel="stylesheet" href="assets/css/custom.min.css?v=1.0.0"/>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Outfit', sans-serif; }
    .milestone-card {
      border-radius: 12px;
      border: 1px solid rgba(255,255,255,0.1);
      background: rgba(30,41,59,0.8);
      transition: 0.3s;
    }
    .milestone-card.earned { border-color: #22c55e; background: rgba(34,197,94,0.08); }
    .milestone-card.locked { opacity: 0.5; }
    .milestone-card.active-earning { border-color: #f59e0b; background: rgba(245,158,11,0.08); }
    .badge-earned  { background: #22c55e; color:#fff; padding:4px 12px; border-radius:20px; font-size:12px; }
    .badge-locked  { background: #6b7280; color:#fff; padding:4px 12px; border-radius:20px; font-size:12px; }
    .badge-active  { background: #f59e0b; color:#000; padding:4px 12px; border-radius:20px; font-size:12px; }
    .progress-bar-sl { height: 8px; border-radius: 4px; background: #374151; }
    .progress-fill   { height: 8px; border-radius: 4px; background: linear-gradient(90deg,#22c55e,#16a34a); }
    .reward-card { border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); background: rgba(30,41,59,0.8); }
    .reward-card.done { border-color: #22c55e; }
    .stats-box { background: rgba(30,41,59,0.9); border-radius:12px; border:1px solid rgba(255,255,255,0.1); padding:20px; }
  </style>
</head>
<body>
<?php include('sidebar.php') ?>
<main class="main-content">
  <div class="position-relative">
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar border-bottom pb-lg-3 pt-lg-3">
      <div class="container-fluid navbar-inner">
        <a href="dashboard" class="navbar-brand"></a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
          <i class="icon">
            <svg width="20px" height="20px" viewBox="0 0 24 24"><path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/></svg>
          </i>
        </div>
        <h4 class="title">Single Leg Income</h4>
      </div>
    </nav>
  </div>

  <div class="container-fluid content-inner pb-0 pt-3">

    <!-- Stats Row -->
    <div class="row mb-4">
      <div class="col-md-3 col-6 mb-3">
        <div class="stats-box text-center">
          <h5 class="text-warning"><?=$teamCount?></h5>
          <small class="text-muted">Total Team</small>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="stats-box text-center">
          <h5 class="text-info"><?=$directCount?></h5>
          <small class="text-muted">Direct Members</small>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="stats-box text-center">
          <h5 class="text-success">INR <?=number_format(getSLDailyIncome($conn,$userid),2)?></h5>
          <small class="text-muted">SL Daily Income</small>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-3">
        <div class="stats-box text-center">
          <h5 class="text-primary">INR <?=number_format(getSLTotalIncome($conn,$userid),2)?></h5>
          <small class="text-muted">Total SL Income</small>
        </div>
      </div>
    </div>

    <!-- Milestones -->
    <h5 class="mb-3 text-white">🏆 Single Leg Milestones</h5>
    <div class="row mb-4">
    <?php
    $milestones = query($conn, "SELECT * FROM sl_milestones ORDER BY id ASC");
    while($m = mysqli_fetch_assoc($milestones)):
        $earned = query($conn, "SELECT * FROM sl_milestone_earned WHERE userid='".mysqli_real_escape_string($conn,$userid)."' AND milestone_id='".$m['id']."'");
        $earnedRow = mysqli_fetch_assoc($earned);
        $isEarned = $earnedRow ? true : false;
        $isActive = $isEarned && $earnedRow['status'] == 'A';
        $isCompleted = $isEarned && $earnedRow['status'] == 'C';
        $progress = $teamCount >= $m['team_size'] ? 100 : round(($teamCount / $m['team_size']) * 100);
        $cardClass = $isCompleted ? 'earned' : ($isActive ? 'active-earning' : ($teamCount < $m['team_size'] ? 'locked' : ''));
    ?>
    <div class="col-md-4 col-lg-3 mb-3">
      <div class="milestone-card p-3 <?=$cardClass?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <strong>Level <?=$m['id']?></strong>
          <?php if($isCompleted): ?>
            <span class="badge-earned">✓ Done</span>
          <?php elseif($isActive): ?>
            <span class="badge-active">⚡ Earning</span>
          <?php elseif($teamCount >= $m['team_size'] && $directCount >= $m['required_direct']): ?>
            <span class="badge-earned">✓ Unlocked</span>
          <?php else: ?>
            <span class="badge-locked">🔒 Locked</span>
          <?php endif; ?>
        </div>
        <p class="mb-1 small text-muted">Team Required: <strong class="text-white"><?=number_format($m['team_size'])?></strong></p>
        <p class="mb-1 small text-muted">Total Income: <strong class="text-success">INR <?=number_format($m['income'],2)?></strong></p>
        <p class="mb-1 small text-muted">Direct Needed: <strong class="text-warning"><?=$m['required_direct']?></strong></p>
        <p class="mb-2 small text-muted">Daily: <strong class="text-info">2% for 30 days</strong></p>
        
        <?php if($isActive && $earnedRow): ?>
        <p class="mb-1 small">Days Paid: <strong><?=$earnedRow['days_paid']?>/<?=$earnedRow['days_total']?></strong></p>
        <p class="mb-2 small">Daily Amt: <strong class="text-warning">INR <?=number_format($earnedRow['daily_amount'],2)?></strong></p>
        <?php endif; ?>

        <div class="progress-bar-sl mb-1">
          <div class="progress-fill" style="width:<?=$progress?>%"></div>
        </div>
        <small class="text-muted"><?=min($teamCount,$m['team_size'])?>/<?=number_format($m['team_size'])?> members</small>
      </div>
    </div>
    <?php endwhile; ?>
    </div>

    <!-- Rewards Section -->
    <h5 class="mb-3 text-white">🎁 Performance Rewards</h5>
    <div class="row mb-4">
    <?php
    $rewardDefs = [
      1 => ['directs'=>10,'days'=>3,'amount'=>150,  'label'=>'Starter Reward'],
      2 => ['directs'=>20,'days'=>5,'amount'=>450,  'label'=>'Growth Reward'],
      3 => ['directs'=>30,'days'=>7,'amount'=>1050, 'label'=>'Champion Reward'],
    ];
    foreach($rewardDefs as $lvl => $r):
      $rEarned = query($conn,"SELECT id FROM sl_rewards WHERE userid='".mysqli_real_escape_string($conn,$userid)."' AND reward_level='$lvl'");
      $isDone = mysqli_num_rows($rEarned) > 0;
    ?>
    <div class="col-md-4 mb-3">
      <div class="reward-card p-3 <?=$isDone?'done':''?>">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <strong><?=$r['label']?></strong>
          <?php if($isDone): ?>
            <span class="badge-earned">✓ Earned</span>
          <?php else: ?>
            <span class="badge-locked">Pending</span>
          <?php endif; ?>
        </div>
        <p class="mb-1 small text-muted">Get <strong><?=$r['directs']?></strong> Directs in <strong><?=$r['days']?></strong> days</p>
        <p class="mb-0 small text-muted">Reward: <strong class="text-success">INR <?=number_format($r['amount'],2)?></strong></p>
      </div>
    </div>
    <?php endforeach; ?>
    </div>

    <!-- Prize Pool -->
    <h5 class="mb-3 text-white">🏊 Prize Pool</h5>
    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <div class="stats-box">
          <h6 class="text-warning">This Week's Prize Pool</h6>
          <h3 class="text-success">INR <?=number_format(getSLCurrentPrizePool($conn),2)?></h3>
          <small class="text-muted">INR 100 from every active member • Distributed every Saturday 11:59 PM</small>
          <hr>
          <p class="mb-1 small">To be Achiever: Get <strong class="text-warning">10+ Directs</strong> this week</p>
          <p class="mb-0 small">Your Directs this week: <strong class="text-info"><?=$directCount?></strong></p>
          <?php if($directCount >= 10): ?>
            <p class="mt-2 mb-0"><span class="badge-earned">✓ You are an Achiever!</span></p>
          <?php else: ?>
            <p class="mt-2 mb-0 text-danger">Need <?=10-$directCount?> more directs to qualify</p>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <div class="stats-box">
          <h6 class="text-warning">My Prize Pool Earnings</h6>
          <h3 class="text-success">INR <?=number_format(getSLPrizePoolIncome($conn,$userid),2)?></h3>
          <hr>
          <?php
          $poolLogs = $conn->query("SELECT p.week_end_date, l.amount FROM sl_prize_pool_log l JOIN sl_prize_pool p ON p.id=l.pool_id WHERE l.userid='".mysqli_real_escape_string($conn,$userid)."' ORDER BY l.id DESC LIMIT 5");
          if($poolLogs && $poolLogs->num_rows > 0):
            while($pl = $poolLogs->fetch_assoc()):
          ?>
          <div class="d-flex justify-content-between small mb-1">
            <span class="text-muted"><?=date('d M Y',strtotime($pl['week_end_date']))?></span>
            <span class="text-success">+INR <?=number_format($pl['amount'],2)?></span>
          </div>
          <?php endwhile; else: ?>
          <p class="text-muted small">No prize pool earnings yet</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Daily Income History -->
    <h5 class="mb-3 text-white">📅 Daily Income History</h5>
    <div class="card mb-4">
      <div class="card-body" style="overflow:auto;">
        <table class="table table-head-bg-primary">
          <thead>
            <tr><th>#</th><th>Milestone</th><th>Amount</th><th>Date</th></tr>
          </thead>
          <tbody>
          <?php
          $logs = $conn->query("SELECT d.*, m.team_size FROM sl_daily_income d JOIN sl_milestones m ON m.id=d.milestone_id WHERE d.userid='".mysqli_real_escape_string($conn,$userid)."' ORDER BY d.id DESC LIMIT 50");
          if($logs && $logs->num_rows > 0):
            $i=1; while($l=$logs->fetch_assoc()):
          ?>
          <tr>
            <td><?=$i++?></td>
            <td>Level <?=$l['milestone_id']?> (<?=number_format($l['team_size'])?>  team)</td>
            <td class="text-success">+INR <?=number_format($l['amount'],2)?></td>
            <td><?=date('d M Y',strtotime($l['date']))?></td>
          </tr>
          <?php endwhile; else: ?>
          <tr><td colspan="4" class="text-muted">No daily income yet</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>

<script src="assets/js/core/libs.min.js"></script>
<script src="assets/js/core/external.min.js"></script>
<script src="assets/js/coinex.js"></script>
</body>
</html>

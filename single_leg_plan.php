<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Single Leg Plan - Mintova</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="tailwind.min.css">
  <style>
    * { box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: #000; color: #fff; overflow-x: hidden; }

    /* ── Mobile Sidebar ── */
    #mobileMenu {
      position: fixed; top: 0; left: 0; width: 260px; height: 100%;
      background: rgba(10,10,10,0.97); border-right: 1px solid rgba(255,255,255,0.06);
      backdrop-filter: blur(12px); padding: 26px 22px;
      display: flex; flex-direction: column; z-index: 1001;
      transform: translateX(-100%); transition: transform .28s ease;
    }
    body.menu-open #mobileMenu { transform: translateX(0); }
    #menuOverlay {
      position: fixed; inset: 0; background: rgba(0,0,0,0.65);
      z-index: 1000; pointer-events: none; opacity: 0; transition: opacity .28s ease;
    }
    body.menu-open #menuOverlay { opacity: 1; pointer-events: auto; }
    @media (min-width: 768px) { #mobileMenu, #menuOverlay { display: none !important; } }

    /* ── Glow blobs ── */
    .blob { position: absolute; border-radius: 50%; filter: blur(120px); opacity: .3; pointer-events: none; }
    .blob-tl { width: 360px; height: 360px; top: -80px; left: -80px; background: #f97316; }
    .blob-br { width: 300px; height: 300px; bottom: -60px; right: -60px; background: #fb923c; }

    /* ── Cards ── */
    .card {
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.09);
      border-radius: 16px;
      padding: 22px;
      transition: transform .22s ease, box-shadow .22s ease;
    }
    .card:hover { transform: translateY(-3px); box-shadow: 0 0 28px rgba(251,146,60,.13); }

    /* ── Badge ── */
    .badge {
      display: inline-block;
      background: rgba(251,146,60,.15);
      border: 1px solid rgba(251,146,60,.28);
      color: #fdba74;
      font-size: 11px; font-weight: 700; letter-spacing: .06em;
      padding: 4px 14px; border-radius: 999px;
    }
    .income-badge {
      background: rgba(251,146,60,.12);
      border: 1px solid rgba(251,146,60,.22);
      color: #fdba74;
      font-size: 11px; font-weight: 600;
      padding: 4px 12px; border-radius: 999px;
      white-space: nowrap;
    }

    /* ── Section number chip ── */
    .num-chip {
      width: 32px; height: 32px; min-width: 32px;
      background: #fb923c; color: #000;
      font-size: 12px; font-weight: 800;
      border-radius: 8px;
      display: flex; align-items: center; justify-content: center;
    }

    /* ── Divider ── */
    .divider { height: 1px; background: linear-gradient(90deg, transparent, rgba(251,146,60,.18), transparent); margin: 0 24px; }

    /* ── Table ── */
    .plan-table { width: 100%; border-collapse: collapse; font-size: 13px; min-width: 540px; }
    .plan-table thead tr { border-bottom: 1px solid rgba(255,255,255,.08); }
    .plan-table th { padding: 14px 16px; text-align: left; font-size: 11px; font-weight: 600; color: #9ca3af; letter-spacing: .06em; text-transform: uppercase; }
    .plan-table td { padding: 14px 16px; border-bottom: 1px solid rgba(255,255,255,.05); }
    .plan-table tbody tr:hover { background: rgba(255,255,255,.03); }
    .plan-table tbody tr:last-child td { border-bottom: none; }

    /* ── Prize pool stat ── */
    .pool-stat { text-align: center; padding: 18px 12px; }
    .pool-stat .val { font-size: clamp(18px, 4vw, 26px); font-weight: 800; color: #fb923c; }
    .pool-stat .lbl { font-size: 12px; color: #9ca3af; margin-top: 4px; }

    /* ── Responsive grid helpers ── */
    .grid-3 { display: grid; gap: 16px; grid-template-columns: 1fr; }
    .grid-2 { display: grid; gap: 16px; grid-template-columns: 1fr; }
    @media (min-width: 640px) {
      .grid-3 { grid-template-columns: repeat(2, 1fr); }
      .grid-2 { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 900px) {
      .grid-3 { grid-template-columns: repeat(3, 1fr); }
    }

    /* ── Level rows ── */
    .level-row {
      display: flex; justify-content: space-between; align-items: center;
      padding: 10px 14px;
      background: rgba(255,255,255,.04);
      border-radius: 10px;
    }

    /* ── Reward card ── */
    .reward-card { text-align: center; }
    .reward-icon {
      width: 48px; height: 48px; border-radius: 50%;
      background: rgba(251,146,60,.13);
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 14px;
    }

    /* ── Wrap ── */
    .wrap { max-width: 1100px; margin: 0 auto; padding: 0 20px; }

    section { padding: 52px 0; }
  </style>
</head>
<body>

<!-- ═══════════ HERO ═══════════ -->
<section style="position:relative; overflow:hidden; padding: 72px 0 60px;">
  <div class="blob blob-tl"></div>
  <div class="blob blob-br"></div>
  <div class="wrap" style="position:relative; z-index:1;">
    <span class="badge">SINGLE LEG PLAN</span>
    <h1 style="font-size: clamp(30px,6vw,56px); font-weight:800; line-height:1.15; margin: 16px 0 14px;">
      Grow Together,<br><span style="color:#fb923c;">Earn Together</span>
    </h1>
    <p style="color:#d1d5db; font-size:16px; max-width:480px; line-height:1.65; margin-bottom:28px;">
      One chain. Multiple incomes. Join at just <strong style="color:#fb923c;">INR 600</strong> and unlock 5 powerful earning streams.
    </p>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <a href="register" style="background:#fb923c; color:#000; font-weight:700; padding:12px 28px; border-radius:999px; text-decoration:none; display:flex; align-items:center; gap:8px; box-shadow:0 0 22px rgba(251,146,60,.35);">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21c1.5-4 5-6 6.5-6s5 2 6.5 6"/><line x1="20" y1="11" x2="20" y2="17"/><line x1="23" y1="14" x2="17" y2="14"/></svg>
        Join Now
      </a>
      <a href="plan.pdf" style="border:1px solid rgba(255,255,255,.2); color:#fff; font-weight:600; padding:12px 28px; border-radius:999px; text-decoration:none; display:flex; align-items:center; gap:8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="12" y1="18" x2="12" y2="12"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
        Download Plan
      </a>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ═══════════ QUICK INFO ═══════════ -->
<section>
  <div class="wrap">
    <div class="grid-3">

      <!-- Joining Amount -->
      <div class="card">
        <div style="width:40px;height:40px;background:rgba(251,146,60,.14);border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <p style="font-size:11px;color:#9ca3af;font-weight:600;letter-spacing:.05em;text-transform:uppercase;margin-bottom:6px;">Joining Amount</p>
        <p style="font-size:28px;font-weight:800;color:#fb923c;">INR 600</p>
      </div>

      <!-- Income Types -->
      <div class="card">
        <p style="font-size:11px;color:#9ca3af;font-weight:600;letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;">Types of Income</p>
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
          <?php foreach(['Single Leg','Direct','Level','Prize Pool','Reward'] as $inc): ?>
            <span class="income-badge"><?= $inc ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Key Terms -->
      <div class="card">
        <p style="font-size:11px;color:#9ca3af;font-weight:600;letter-spacing:.05em;text-transform:uppercase;margin-bottom:12px;">Key Terms</p>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:10px;">
          <?php foreach([
            'Daily Deposit & Withdraw',
            'Withdraw: 8:00 AM – 10:00 PM',
            '10% Admin Charge per Withdraw',
            'Min Withdraw: INR 100 (×100)'
          ] as $t): ?>
            <li style="display:flex;gap:10px;align-items:flex-start;font-size:13px;color:#d1d5db;">
              <span style="color:#fb923c;margin-top:1px;">✦</span><?= $t ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ═══════════ (I) SINGLE LEG TABLE ═══════════ -->
<section>
  <div class="wrap">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
      <span class="num-chip">I</span>
      <h2 style="font-size:22px;font-weight:700;">Single Leg Income</h2>
    </div>

    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);border-radius:16px;overflow:hidden;">
      <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
        <table class="plan-table">
          <thead>
            <tr>
              <th>Active</th>
              <th>Your Income</th>
              <th>% / Period</th>
              <th>Pool Members</th>
              <th>Distribute</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $rows = [
              ['150',    'INR 300',      '12% / 30 Days', '2,100',  'INR 700'],
              ['3,200',  'INR 1,800',    '22% / 30 Days', '4,400',  'INR 4,000'],
              ['700',    'INR 7,700',    '12% / 30 Days', '1,000',  'INR 11,000'],
              ['3,000',  'INR 36,000',   '2% / 30 Days',  '5,000',  'INR 1,00,000'],
              ['10,000', 'INR 2,50,000', '2% / 30 Days',  '—',      '—'],
            ];
            foreach ($rows as $r): ?>
              <tr>
                <td style="font-weight:600;"><?= $r[0] ?></td>
                <td style="color:#fb923c;font-weight:700;"><?= $r[1] ?></td>
                <td style="color:#d1d5db;"><?= $r[2] ?></td>
                <td style="color:#d1d5db;"><?= $r[3] ?></td>
                <td style="color:#4ade80;font-weight:600;"><?= $r[4] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div style="padding:14px 16px;border-top:1px solid rgba(255,255,255,.07);display:flex;flex-wrap:wrap;gap:16px;font-size:13px;color:#d1d5db;">
        <span>Total Income: <strong style="color:#fb923c;">INR 4,29,500</strong></span>
        <span>Total Direct Required: <strong style="color:#fb923c;">10</strong></span>
      </div>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ═══════════ (II) DIRECT + (III) LEVEL ═══════════ -->
<section>
  <div class="wrap">
    <div class="grid-2">

      <!-- Direct Income -->
      <div class="card">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px;">
          <span class="num-chip">II</span>
          <h3 style="font-size:18px;font-weight:700;">Direct Income</h3>
        </div>
        <div style="background:rgba(251,146,60,.1);border:1px solid rgba(251,146,60,.22);border-radius:12px;padding:20px;display:flex;align-items:center;gap:18px;flex-wrap:wrap;">
          <span style="font-size:40px;font-weight:800;color:#fb923c;line-height:1;">₹250</span>
          <p style="color:#d1d5db;font-size:14px;line-height:1.6;margin:0;">Instantly credited for every active direct referral you bring in.</p>
        </div>
      </div>

      <!-- Level Income -->
      <div class="card">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px;">
          <span class="num-chip">III</span>
          <h3 style="font-size:18px;font-weight:700;">Level Income</h3>
        </div>
        <div style="display:flex;flex-direction:column;gap:10px;">
          <?php foreach([
            ['Level 1 (Direct)', 'INR 250 / member'],
            ['Level 2',          'INR 10 / member'],
            ['Level 3 – 10',     'INR 5 / member'],
          ] as $lv): ?>
            <div class="level-row">
              <span style="font-size:13px;color:#d1d5db;"><?= $lv[0] ?></span>
              <span style="font-size:13px;color:#fb923c;font-weight:700;"><?= $lv[1] ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ═══════════ (IV) PRIZE POOL ═══════════ -->
<section>
  <div class="wrap">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
      <span class="num-chip">IV</span>
      <h2 style="font-size:22px;font-weight:700;">Prize Pool</h2>
    </div>

    <div style="background:linear-gradient(135deg,rgba(251,146,60,.1),rgba(255,255,255,.03));border:1px solid rgba(251,146,60,.2);border-radius:16px;padding:28px 20px;">
      <div class="grid-3" style="margin-bottom:20px;">
        <div class="pool-stat">
          <div class="val">INR 100</div>
          <div class="lbl">Collected from every active ID</div>
        </div>
        <div class="pool-stat">
          <div class="val">10 Direct</div>
          <div class="lbl">Required to become an Achiever</div>
        </div>
        <div class="pool-stat">
          <div class="val">Saturday</div>
          <div class="lbl">Distribution at 11:59 PM</div>
        </div>
      </div>
      <p style="font-size:13px;color:#9ca3af;text-align:center;border-top:1px solid rgba(255,255,255,.08);padding-top:18px;margin:0;">
        Pool is equally distributed among all achievers. Both prize pool & direct condition renew every week.
      </p>
    </div>
  </div>
</section>

<div class="divider"></div>

<!-- ═══════════ (V) REWARDS ═══════════ -->
<section>
  <div class="wrap">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
      <span class="num-chip">V</span>
      <h2 style="font-size:22px;font-weight:700;">Rewards</h2>
    </div>

    <div class="grid-3">
      <?php foreach([
        ['10 Direct', '3 Days Active', 'INR 150'],
        ['20 Direct', '5 Days Active', 'INR 450'],
        ['30 Direct', '7 Days Active', 'INR 1,050'],
      ] as $rw): ?>
        <div class="card reward-card">
          <div class="reward-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14l-5-4.87 6.91-1.01z"/></svg>
          </div>
          <p style="font-size:22px;font-weight:800;color:#fb923c;margin:0 0 6px;"><?= $rw[2] ?></p>
          <p style="font-size:14px;font-weight:600;margin:0 0 4px;"><?= $rw[0] ?></p>
          <p style="font-size:12px;color:#9ca3af;margin:0;"><?= $rw[1] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════ FOOTER ═══════════ -->
<footer style="border-top:1px solid rgba(255,255,255,.08);padding:28px 20px;text-align:center;font-size:13px;color:#6b7280;">
  © 2025 Mintova — Contact admin for any clarifications.
</footer>

<script>
(function(){
  var body = document.body;
  var btn  = document.getElementById('menuBtn');
  var ov   = document.getElementById('menuOverlay');
  var menu = document.getElementById('mobileMenu');
  if (!btn || !ov || !menu) return;
  btn.addEventListener('click', function(){ body.classList.toggle('menu-open'); });
  ov.addEventListener('click',  function(){ body.classList.remove('menu-open'); });
  menu.querySelectorAll('a,button').forEach(function(el){
    el.addEventListener('click', function(){ body.classList.remove('menu-open'); });
  });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape') body.classList.remove('menu-open'); });
})();
</script>

</body>
</html>

<?php
include('admin/inc/function.php'); // must set $conn (mysqli) and optionally redirect()
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - Mintova</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root{
      --bg:#070707;
      --card:#121212; /* NEW solid background so screenshot is visible */
      --orange:#FB923C;
      --orange-dark:#D97706;
      --orange-soft:rgba(251,146,60,0.15);
      --radius:18px;
      --shadow:0 10px 30px rgba(0,0,0,0.65);
    }
    body{
      font-family:'Poppins',sans-serif;
      background:linear-gradient(180deg,#000 0%,#050505 55%);
      color:#fff;
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
      padding:20px;
    }

    .welcome-card{
      background:var(--card); /* Solid background for screenshot */
      border:1px solid var(--orange-soft);
      border-radius:var(--radius);
      padding:30px;
      width:100%;
      max-width:420px;
      box-shadow:var(--shadow);
      text-align:center;
    }

    h2{
      font-size:28px;
      font-weight:700;
      margin-bottom:10px;
      background:linear-gradient(135deg,var(--orange),var(--orange-dark));
      -webkit-background-clip:text;
      -webkit-text-fill-color:transparent;
    }

    .welcome-text{
      font-size:15px;
      opacity:0.7;
      margin-bottom:25px;
    }

    .info-box{
      background:#1b1b1b;
      border:1px solid var(--orange-soft);
      border-radius:14px;
      padding:20px;
      margin-bottom:20px;
      text-align:left;
    }

    .info-box label{
      display:block;
      font-size:13px;
      opacity:0.7;
      margin-bottom:4px;
    }

    .info-box .value{
      font-size:15px;
      font-weight:600;
      margin-bottom:14px;
    }

    button{
      width:100%;
      padding:12px;
      border-radius:999px;
      border:none;
      font-weight:700;
      cursor:pointer;
      background:linear-gradient(90deg,var(--orange),var(--orange-dark));
      color:#0d0d0d;
      box-shadow:0 8px 30px var(--orange-soft);
      transition:0.25s ease;
      margin-top:5px;
    }

    button:hover{
      transform:translateY(-2px);
      box-shadow:0 0 25px var(--orange-soft);
    }

    #screenshotBtn{
      background:#1b1b1b !important;
      color:var(--orange) !important;
      border:1px solid var(--orange-soft) !important;
      margin-bottom:15px;
    }
  </style>
</head>

<body>
<div id="captureArea" class="welcome-card">

  <h2>Welcome to Mintova</h2>
  <div class="welcome-text">Your account has been created successfully</div>

  <div class="info-box">
    <label>User ID:</label>
    <div class="value"><?=getMember($conn,$_REQUEST['id'],'userid')?></div>

    <label>Login Password:</label>
    <div class="value"><?=base64_decode(getMember($conn,$_REQUEST['id'],'password'))?></div>

    <label>Transaction Password:</label>
    <div class="value"><?=getMember($conn,$_REQUEST['id'],'tpassword')?></div>
  </div>

  <button id="screenshotBtn" type="button">Save Screenshot</button>

  <form id="loginForm" action="login-process" method="POST">
    <input type="hidden" name="userid" id="send_userid">
    <input type="hidden" name="password" id="send_password">
    <button type="submit">Go to Login</button>
  </form>

</div>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
  document.getElementById('screenshotBtn').addEventListener('click', () => {
    html2canvas(document.getElementById('captureArea')).then(canvas => {
      const link = document.createElement('a');
      link.download = 'mintova-welcome.png';
      link.href = canvas.toDataURL();
      link.click();
    });
  });

  document.querySelector('button[type=\"submit\"]').addEventListener('click', () => {
    document.getElementById('send_userid').value = "<?=getMember($conn,$_REQUEST['id'],'userid')?>";
    document.getElementById('send_password').value = "<?=base64_decode(getMember($conn,$_REQUEST['id'],'password'))?>";
  });
</script>

</body>
</html>

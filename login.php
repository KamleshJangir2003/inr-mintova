<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Mintova</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#070707 !important;
      --panel: rgba(255,255,255,0.04) !important;
      --glass: rgba(255,255,255,0.06) !important;
      --orange: #FB923C !important;
      --orange-dark: #D97706 !important;
      --orange-soft: rgba(251,146,60,0.15) !important;
      --radius:18px !important;
      --shadow: 0 10px 30px rgba(0,0,0,0.65) !important;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{
      font-family:'Poppins',sans-serif;
      background: linear-gradient(180deg, #000 0%, #050505 55%) !important;
      color:#fff !important;
      display:flex;
      justify-content:center;
      align-items:center;
      height:100vh;
      padding:20px;
    }
    .login-card{
      background: var(--panel) !important;
      border:1px solid var(--orange-soft) !important;
      border-radius: var(--radius) !important;
      padding:40px 30px;
      width:100%;
      max-width:400px;
      backdrop-filter: blur(10px);
      box-shadow: var(--shadow) !important;
    }
    .login-card h2{
      font-size:28px;
      font-weight:700;
      margin-bottom:20px;
      background: linear-gradient(135deg, var(--orange), var(--orange-dark)) !important;
      -webkit-background-clip: text !important;
      -webkit-text-fill-color: transparent !important;
    }
    .login-card label{
      display:block;
      font-weight:600;
      margin-bottom:6px;
      color: #fff !important;
    }
    .login-card input{
      width:100%;
      padding:12px 14px;
      border-radius:12px;
      border:1px solid var(--orange-soft) !important;
      background: rgba(255,255,255,0.03) !important;
      color:#fff !important;
      margin-bottom:18px;
      font-weight:600;
    }
    .login-card input:focus{
      outline:none;
      border:1px solid var(--orange) !important;
      box-shadow: 0 0 10px var(--orange-soft) !important;
    }
    .login-card button{
      width:100%;
      padding:12px;
      border-radius:999px;
      border:none;
      font-weight:700;
      cursor:pointer;
      background: linear-gradient(90deg, var(--orange), var(--orange-dark)) !important;
      color:#0d0d0d !important;
      box-shadow:0 8px 30px var(--orange-soft) !important;
      transition:0.25s ease;
    }
    .login-card button:hover{
      transform: translateY(-2px);
      box-shadow:0 0 25px var(--orange-soft) !important;
    }
    .login-footer{
      margin-top:16px;
      font-size:14px;
      text-align:center;
      color: rgba(255,255,255,0.7) !important;
    }
    .login-footer a{
      color: var(--orange) !important;
      text-decoration:none;
      font-weight:600;
    }
    .login-footer a:hover{
      text-decoration:underline;
    }
  </style>
</head>
<body>
<div class="login-card">
  <h2>Welcome Back</h2>
  
  <?php if(($_REQUEST['e'] ?? null)==1){?>
  <div class="error-message">
    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
      <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"/>
    </svg>
    Invalid User ID or Password.
  </div>
  <?php }?><br><style>
.error-message {
  background: linear-gradient(135deg, #fee 0%, #fff5f5 100%);
  border: 1px solid #feb2b2;
  color: #c53030;
  padding: 12px 16px;
  border-radius: 8px;
  margin: 15px 0;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
  box-shadow: 0 2px 8px rgba(197, 48, 48, 0.1);
}

.error-message svg {
  flex-shrink: 0;
}
</style>
  <form action="login-process" method="POST">
    <label for="userid">User ID</label>
    <input type="text" id="userid" name="userid" placeholder="Enter your User ID" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>

    <button type="submit">Login</button>
  </form>
  <div class="login-footer">
   Don't have an account? <a href="register">Sign Up</a><br>
      Go back to 
      <a href="index">Home</a> 
  </div>
</div>

</body>
</html>

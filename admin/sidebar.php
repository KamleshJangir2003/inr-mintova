<div class="jumps-prevent" style="padding-top: 0px;"></div>


<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky is-expanded" style="margin-bottom: -63px;">
<aside class="app-sidebar ps ps--active-y open">
<div class="main-sidebar-header active">
<a class="logo-icon mobile-logo icon-light active" href="dashboard">
<img src="../images/logo.png" alt="logo" /></a>
<a class="logo-icon mobile-logo icon-dark active" href="dashboard">
<img src="../images/logo.png" alt="logo" /></a>
</div>
<div class="main-sidemenu is-expanded">
<div class="main-sidebar-loggedin">
<div class="app-sidebar__user">
<div class="dropdown user-pro-body text-center">
<div class="user-pic">
<img src="bg.png" alt="user-img" class="rounded-circle mCS_img_loaded">
</div>
<div class="user-info">
<h6 class=" mb-0 text-dark">ADMIN</h6>
<span class="text-muted app-sidebar__user-name text-sm"></span>
</div>
</div>
</div>
</div>
<br>
<div class="slide-left disabled active is-expanded d-none" id="slide-left">
<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
</div>
<ul class="side-menu open" style="margin-right: 0px; margin-left: 0px;">

<li class="slide"><a class="side-menu__item  " href="dashboard">
<i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a> </li>


<li class="slide <?php if($left=='600'){?> is-expanded <?php }?>">
<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
<i class="side-menu__icon fe fe-settings"></i>
<span class="side-menu__label">Settings</span>
<i class="angle fe fe-chevron-down"></i>
</a>
<ul class="slide-menu">
<li><a class="slide-item" href="settings?inc=onoff">Deposit / Withdraw</a></li>
<li><a class="slide-item" href="settings?inc=teleutube">Telegram / Youtube</a></li>
<li><a class="slide-item" href="settings?inc=qr">QR Code / Wallet</a></li>
</ul>
</li>




<li class="slide <?php if($left=='411'){?> is-expanded <?php }?>">
<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
<i class="side-menu__icon fe fe-users"></i>
<span class="side-menu__label">Members List</span>
<i class="angle fe fe-chevron-down"></i>
</a>
<ul class="slide-menu">
<li><a class="slide-item" href="member?inc=memdet">Member details</a>
<li><a class="slide-item" href="member?inc=act">Active Member</a>
<li><a class="slide-item" href="member?inc=pen">Inactive Member</a>
</li>
</ul>
</li>

<li class="slide <?php if($left=='6'){?> is-expanded <?php }?>">
<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
<i class="side-menu__icon fe fe-dollar-sign"></i>
<span class="side-menu__label">Fund Management</span>
<i class="angle fe fe-chevron-down"></i>
</a>
<ul class="slide-menu">
<li><a class="slide-item" href="deposit">Deposit</a></li>
<li><a class="slide-item" href="request">Deposit Requests</a></li>
<li><a class="slide-item" href="deduct">Deduct</a>
</li>
</ul>
</li>


<li class="slide <?php if($left=='60'){?> is-expanded <?php }?>">
<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
<i class="side-menu__icon fe fe-box"></i>
<span class="side-menu__label">Withdrawal Request</span>
<i class="angle fe fe-chevron-down"></i>
</a>
<ul class="slide-menu">
<li><a class="slide-item" href="withdrawal?case=pen">Pending Withdrawal</a>
</li>
<li><a class="slide-item" href="withdrawal?case=fail">Failed Withdrawal</a>
</li>
<li><a class="slide-item" href="withdrawal?case=app">Approved Withdrawal</a>
</li>
</ul>
</li>

<!-- Announcement -->
<li class="slide <?php if($left=='13'){?> is-expanded <?php }?>">
<a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
<i class="side-menu__icon fe fe-volume-2"></i>
<span class="side-menu__label">Announcement</span>
<i class="angle fe fe-chevron-down"></i>
</a>
<ul class="slide-menu">
<li><a class="slide-item" href="announcement">New Announcements</a></li>
</ul>
</li>


<li class="slide"><a class="side-menu__item" href="../logout"><i class="side-menu__icon fe fe-log-out"></i><span class="side-menu__label">Logout</span></a> </li>
</ul>
<div class="slide-right" id="slide-right">
<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
</div>
</div>
<div class="ps__rail-x" style="left: 0px; bottom: 0px;">
<div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
</div>
<div class="ps__rail-y" style="top: 0px; height: 625px; right: 0px;">
<div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 474px;"></div>
</div>
</aside>
</div>
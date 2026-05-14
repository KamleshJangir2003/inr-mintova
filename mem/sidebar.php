 <!-- loader Start -->
    <!-- <div id="loading">
      <div class="loader simple-loader">
        <div class="loader-body"></div>
      </div>
    </div> -->
    <!-- loader END -->
    <aside class="sidebar sidebar-default navs-rounded">
      <div
        class="sidebar-header d-flex align-items-center justify-content-start"
      >
        <a
          href="dashboard"
          class="navbar-brand dis-none align-items-center"
        >
          <img src="PSD.psd (6).png" class="img-fluid" alt="logo" height="40" />
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
          <i class="icon">
            <svg
              width="20"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M4.25 12.2744L19.25 12.2744"
                stroke="currentColor"
                stroke-width="1.5"
              ></path>
              <path
                d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976"
                stroke="currentColor"
                stroke-width="1.5"
              ></path>
            </svg>
          </i>
        </div>
      </div>
      <div class="sidebar-body p-0 data-scrollbar">
        <div class="navbar-collapse pe-3" id="sidebar">
          <ul class="navbar-nav iq-main-menu">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="dashboard"
              >
                <i class="icon">
                  <svg
                    width="22"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                  </svg>
                </i>
                <span class="item-name">Dashboard</span>
              </a>
            </li>


            <?php
$q = $conn->query("SELECT imps FROM imaksoft_settings_onoff LIMIT 1");
$onoff = $q->fetch_assoc();
?>

<?php if ($onoff['imps'] == 'A') { ?>
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="deposit">
        <i class="icon">
            <svg
                width="20"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path opacity="0.4"
                    d="M13.3051 5.88243V6.06547C12.8144 6.05584 12.3237 6.05584 11.8331 6.05584V5.89206C11.8331 5.22733 11.2737 4.68784 10.6064 4.68784H9.63482C8.52589 4.68784 7.62305 3.80152 7.62305 2.72254C7.62305 2.32755 7.95671 2 8.35906 2C8.77123 2 9.09508 2.32755 9.09508 2.72254C9.09508 3.01155 9.34042 3.24276 9.63482 3.24276H10.6064C12.0882 3.2524 13.2953 4.43736 13.3051 5.88243Z"
                    fill="currentColor"></path>
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M15.164 6.08279C15.4791 6.08712 15.7949 6.09145 16.1119 6.09469C19.5172 6.09469 22 8.52241 22 11.875V16.1813C22 19.5339 19.5172 21.9616 16.1119 21.9616C14.7478 21.9905 13.3837 22.0001 12.0098 22.0001C10.6359 22.0001 9.25221 21.9905 7.88813 21.9616C4.48283 21.9616 2 19.5339 2 16.1813V11.875C2 8.52241 4.48283 6.09469 7.89794 6.09469C9.18351 6.07542 10.4985 6.05615 11.8332 6.05615C12.3238 6.05615 12.8145 6.05615 13.3052 6.06579C13.9238 6.06579 14.5425 6.07427 15.164 6.08279ZM10.8518 14.7459H9.82139V15.767C9.82139 16.162 9.48773 16.4896 9.08538 16.4896C8.67321 16.4896 8.34936 16.162 8.34936 15.767V14.7459H7.30913C6.90677 14.7459 6.57311 14.4279 6.57311 14.0233C6.57311 13.6283 6.90677 13.3008 7.30913 13.3008H8.34936V12.2892C8.34936 11.8942 8.67321 11.5667 9.08538 11.5667C9.48773 11.5667 9.82139 11.8942 9.82139 12.2892V13.3008H10.8518C11.2542 13.3008 11.5878 13.6283 11.5878 14.0233C11.5878 14.4279 11.2542 14.7459 10.8518 14.7459ZM15.0226 13.1177H15.1207C15.5231 13.1177 15.8567 12.7998 15.8567 12.3952C15.8567 12.0002 15.5231 11.6727 15.1207 11.6727H15.0226C14.6104 11.6727 14.2866 12.0002 14.2866 12.3952C14.2866 12.7998 14.6104 13.1177 15.0226 13.1177ZM16.7007 16.4318H16.7988C17.2012 16.4318 17.5348 16.1139 17.5348 15.7092C17.5348 15.3143 17.2012 14.9867 16.7988 14.9867H16.7007C16.2885 14.9867 15.9647 15.3143 15.9647 15.7092C15.9647 16.1139 16.2885 16.4318 16.7007 16.4318Z"
                    fill="currentColor"></path>
            </svg>
        </i>
        <span class="item-name">Add Fund</span>
    </a>
</li>
<?php } ?>






             <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="collapse"
                href="#sidebar-widget"
                role="button"
                aria-expanded="false"
                aria-controls="sidebar-widget"
              >
                <i class="icon">
                  <svg
                    width="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      opacity="0.4"
                      d="M21.25 13.4764C20.429 13.4764 19.761 12.8145 19.761 12.001C19.761 11.1865 20.429 10.5246 21.25 10.5246C21.449 10.5246 21.64 10.4463 21.78 10.3076C21.921 10.1679 22 9.97864 22 9.78146L21.999 7.10415C21.999 4.84102 20.14 3 17.856 3H6.144C3.86 3 2.001 4.84102 2.001 7.10415L2 9.86766C2 10.0648 2.079 10.2541 2.22 10.3938C2.36 10.5325 2.551 10.6108 2.75 10.6108C3.599 10.6108 4.239 11.2083 4.239 12.001C4.239 12.8145 3.571 13.4764 2.75 13.4764C2.336 13.4764 2 13.8093 2 14.2195V16.8949C2 19.158 3.858 21 6.143 21H17.857C20.142 21 22 19.158 22 16.8949V14.2195C22 13.8093 21.664 13.4764 21.25 13.4764Z"
                      fill="currentColor"
                    ></path>
                    <path
                      d="M15.4303 11.5887L14.2513 12.7367L14.5303 14.3597C14.5783 14.6407 14.4653 14.9177 14.2343 15.0837C14.0053 15.2517 13.7063 15.2727 13.4543 15.1387L11.9993 14.3737L10.5413 15.1397C10.4333 15.1967 10.3153 15.2267 10.1983 15.2267C10.0453 15.2267 9.89434 15.1787 9.76434 15.0847C9.53434 14.9177 9.42134 14.6407 9.46934 14.3597L9.74734 12.7367L8.56834 11.5887C8.36434 11.3907 8.29334 11.0997 8.38134 10.8287C8.47034 10.5587 8.70034 10.3667 8.98134 10.3267L10.6073 10.0897L11.3363 8.61268C11.4633 8.35868 11.7173 8.20068 11.9993 8.20068H12.0013C12.2843 8.20168 12.5383 8.35968 12.6633 8.61368L13.3923 10.0897L15.0213 10.3277C15.2993 10.3667 15.5293 10.5587 15.6173 10.8287C15.7063 11.0997 15.6353 11.3907 15.4303 11.5887Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </i>
                <span class="item-name">Invest Now</span>
                <i class="right-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"
                    />
                  </svg>
                </i>
              </a>
              <ul
                class="sub-nav collapse"
                id="sidebar-widget"
                data-bs-parent="#sidebar"
              >
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="invest?case=new"
                  >
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> W </i>
                    <span class="item-name">New Invest</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="invest?case=history"
                  >
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> W </i>
                    <span class="item-name">View Invest</span>
                  </a>
                </li>
               
              </ul>
            </li> 


            


            <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="collapse"
                href="#sidebar-auth"
                role="button"
                aria-expanded="false"
                aria-controls="sidebar-user"
              >
                <i class="icon">
                  <svg
                    width="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M11.9846 21.606C11.9846 21.606 19.6566 19.283 19.6566 12.879C19.6566 6.474 19.9346 5.974 19.3196 5.358C18.7036 4.742 12.9906 2.75 11.9846 2.75C10.9786 2.75 5.26557 4.742 4.65057 5.358C4.03457 5.974 4.31257 6.474 4.31257 12.879C4.31257 19.283 11.9846 21.606 11.9846 21.606Z"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                    <path
                      d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                  </svg>
                </i>
                <span class="item-name">Earnings</span>
                <i class="right-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"
                    />
                  </svg>
                </i>
              </a>
              <ul
                class="sub-nav collapse"
                id="sidebar-auth"
                data-bs-parent="#sidebar"
              >
                <li class="nav-item">
                  <a class="nav-link" href="income?inc=direct">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> D </i>
                    <span class="item-name">Direct Income</span>
                  </a>
                </li>
                
                 <li class="nav-item">
                  <a class="nav-link" href="income?inc=roi">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> D </i>
                    <span class="item-name">Daily ROI Income</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="income?inc=levelroi">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> L </i>
                    <span class="item-name">Level ROI Income</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="income?inc=task">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> I </i>
                    <span class="item-name">Task & Reward Income</span>
                  </a>
                </li>
                
              </ul>
            </li>




            <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="collapse"
                href="#sidebar-user"
                role="button"
                aria-expanded="false"
                aria-controls="sidebar-user"
              >
                <i class="icon">
                  <svg
                    width="22"
                    viewBox="0 0 30 30"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z"
                      stroke="currentColor"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z"
                      stroke="currentColor"
                      stroke-width="1.42857"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    ></path>
                  </svg>
                </i>
                <span class="item-name">Team</span>
                <i class="right-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"
                    />
                  </svg>
                </i>
              </a>
              <ul
                class="sub-nav collapse"
                id="sidebar-user"
                data-bs-parent="#sidebar"
              >
                <li class="nav-item">
                  <a class="nav-link" href="downline?case=direct">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> D </i>
                    <span class="item-name">My direct referrals</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="downline?case=team">
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> I </i>
                    <span class="item-name">My Team referrals</span>
                  </a>
                </li>
                
              </ul>
            </li>
            
            
           <?php
$q = $conn->query("SELECT manual FROM imaksoft_settings_onoff LIMIT 1");
$onoff = $q->fetch_assoc();
?>

<?php if ($onoff['manual'] == 'A') { ?>
<li class="nav-item">
    <a
        class="nav-link"
        data-bs-toggle="collapse"
        href="#utilities-error"
        role="button"
        aria-expanded="false"
        aria-controls="utilities-error"
    >
        <i class="icon">
            <svg
                width="20"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    opacity="0.4"
                    d="M11.9912 18.6215L5.49945 21.864C5.00921 22.1302 4.39768 21.9525 4.12348 21.4643C4.0434 21.3108 4.00106 21.1402 4 20.9668V13.7087C4 14.4283 4.40573 14.8725 5.47299 15.37L11.9912 18.6215Z"
                    fill="currentColor"
                ></path>
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.89526 2H15.0695C17.7773 2 19.9735 3.06605 20 5.79337V20.9668C19.9989 21.1374 19.9565 21.3051 19.8765 21.4554C19.7479 21.7007 19.5259 21.8827 19.2615 21.9598C18.997 22.0368 18.7128 22.0023 18.4741 21.8641L11.9912 18.6215L5.47299 15.3701C4.40573 14.8726 4 14.4284 4 13.7088V5.79337C4 3.06605 6.19625 2 8.89526 2ZM8.22492 9.62227H15.7486C16.1822 9.62227 16.5336 9.26828 16.5336 8.83162C16.5336 8.39495 16.1822 8.04096 15.7486 8.04096H8.22492C7.79137 8.04096 7.43991 8.39495 7.43991 8.83162C7.43991 9.26828 7.79137 9.62227 8.22492 9.62227Z"
                    fill="currentColor"
                ></path>
            </svg>
        </i>
        <span class="item-name">Withdrawal</span>
        <i class="right-icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="18"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </i>
    </a>

    <ul
        class="sub-nav collapse"
        id="utilities-error"
        data-bs-parent="#sidebar"
    >
        <li class="nav-item">
            <a class="nav-link" href="withdraw?case=new">
                <i class="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="7.5"
                            stroke="currentColor"
                        ></circle>
                    </svg>
                </i>
                <span class="item-name">Make Withdrawal</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="withdraw?case=history">
                <i class="icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="7.5"
                            stroke="currentColor"
                        ></circle>
                    </svg>
                </i>
                <span class="item-name">Withdrawal History</span>
            </a>
        </li>

    </ul>
</li>
<?php } ?>

           
            <li class="nav-item">
              <a
                class="nav-link"
                data-bs-toggle="collapse"
                href="#ui"
                role="button"
                aria-expanded="false"
                aria-controls="utilities-error"
              >
                <i class="icon">
                  <svg
                    width="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      opacity="0.4"
                      d="M2 11.0786C2.05 13.4166 2.19 17.4156 2.21 17.8566C2.281 18.7996 2.642 19.7526 3.204 20.4246C3.986 21.3676 4.949 21.7886 6.292 21.7886C8.148 21.7986 10.194 21.7986 12.181 21.7986C14.176 21.7986 16.112 21.7986 17.747 21.7886C19.071 21.7886 20.064 21.3566 20.836 20.4246C21.398 19.7526 21.759 18.7896 21.81 17.8566C21.83 17.4856 21.93 13.1446 21.99 11.0786H2Z"
                      fill="currentColor"
                    ></path>
                    <path
                      d="M11.2451 15.3843V16.6783C11.2451 17.0923 11.5811 17.4283 11.9951 17.4283C12.4091 17.4283 12.7451 17.0923 12.7451 16.6783V15.3843C12.7451 14.9703 12.4091 14.6343 11.9951 14.6343C11.5811 14.6343 11.2451 14.9703 11.2451 15.3843Z"
                      fill="currentColor"
                    ></path>
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M10.211 14.5565C10.111 14.9195 9.762 15.1515 9.384 15.1015C6.833 14.7455 4.395 13.8405 2.337 12.4815C2.126 12.3435 2 12.1075 2 11.8555V8.38949C2 6.28949 3.712 4.58149 5.817 4.58149H7.784C7.972 3.12949 9.202 2.00049 10.704 2.00049H13.286C14.787 2.00049 16.018 3.12949 16.206 4.58149H18.183C20.282 4.58149 21.99 6.28949 21.99 8.38949V11.8555C21.99 12.1075 21.863 12.3425 21.654 12.4815C19.592 13.8465 17.144 14.7555 14.576 15.1105C14.541 15.1155 14.507 15.1175 14.473 15.1175C14.134 15.1175 13.831 14.8885 13.746 14.5525C13.544 13.7565 12.821 13.1995 11.99 13.1995C11.148 13.1995 10.433 13.7445 10.211 14.5565ZM13.286 3.50049H10.704C10.031 3.50049 9.469 3.96049 9.301 4.58149H14.688C14.52 3.96049 13.958 3.50049 13.286 3.50049Z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </i>
                <span class="item-name">My Profile</span>
                <i class="right-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"
                    />
                  </svg>
                </i>
              </a>
              <ul class="sub-nav collapse" id="ui" data-parent="#sidebar">
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="edit?case=profile"
                  >
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> A</i>
                    <span class="item-name">Edit Profile</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="edit?case=password"
                  >
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> A </i>
                    <span class="item-name">Change Password</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    href="edit?case=tpassword"
                  >
                    <i class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        stroke-width="1.5"
                        width="16"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <circle
                          cx="12"
                          cy="12"
                          r="7.5"
                          stroke="currentColor"
                        ></circle>
                      </svg>
                    </i>
                    <i class="sidenav-mini-icon"> A </i>
                    <span class="item-name">Transaction Password</span>
                  </a>
                </li>
                
              </ul>
            </li>


           


            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="logout"
              >
              <i class="icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                  >
                    <path
                      d="M8 10.5378C8 9.43327 8.89543 8.53784 10 8.53784H11.3333C12.4379 8.53784 13.3333 9.43327 13.3333 10.5378V19.8285C13.3333 20.9331 14.2288 21.8285 15.3333 21.8285H16C16 21.8285 12.7624 23.323 10.6667 22.9361C10.1372 22.8384 9.52234 22.5913 9.01654 22.3553C8.37357 22.0553 8 21.3927 8 20.6832V10.5378Z"
                      fill="currentColor"
                    />
                    <rect
                      opacity="0.4"
                      x="8"
                      y="1"
                      width="5"
                      height="5"
                      rx="2.5"
                      fill="currentColor"
                    />
                  </svg>
                </i>
                <span class="item-name">Logout</span>
              </a>
            </li>

           
          </ul>
        </div>
        <div id="sidebar-footer" class="position-relative sidebar-footer">
          <div class="card mx-4">
            <div class="card-body">
              <div class="sidebarbottom-content">
                <div class="image">
                  <img
                    src="assets/images/coins/13.png"
                    alt="User-Profile"
                    class="img-fluid"
                  />
                </div>
                <p class="mb-0">Invest now and earn</p>
                <button type="button" class="btn btn-primary mt-3">
                  Invest Now
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>
    

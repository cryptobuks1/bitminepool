<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <?php
    if (isset($_SESSION['is_prime_user']) && $_SESSION['is_prime_user'] == 1) {
        ?>
        <div class="menu_section">
            <a href="index"><h3>Account Information</h3></a>
            <ul class="nav side-menu">
                <li><a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                <li><a href="wallet"><i class="fa fa-google-wallet"></i>Wallet</a>
                <li><a><i class="fa fa-user"></i> My Account <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="profile">My Profile</a></li>
                        <li><a href="rank">My Rank</a></li>
                        <!--<li><a href="#">My Orders</a></li>
                        <li><a href="#">Support Ticket</a></li> -->
                        <li><a href="reflink">Referral Link</a></li>
                        <li><a href="withdrawal">Withdrawal</a></li>
                        <li><a href="support">Support</a></li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['is_admin_user']) && $_SESSION['is_admin_user'] == 1) {
                    ?>
                    <li><a><i class="fa fa-user"></i> View all transactions <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="all_transactions?type=wallet">Wallet</a></li>
                            <li><a href="all_transactions?type=invoice">Invoice</a></li>
                            <li><a href="all_transactions?type=benefits">Benefits</a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <li><a><i class="fa fa-sitemap"></i> My team <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <!-- <li><a href="#">Enrollment Tree</a></li> -->
                        <li><a href="tree">Binary Tree</a></li>
                    </ul>
                </li>

                <li><a><i class="fa fa-shopping-cart"></i> Mining <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="view_pool?purpose=Starter">Pool 1</a></li>
                        <li><a href="view_pool?purpose=Mini">Pool 2</a></li>
                        <li><a href="view_pool?purpose=Medium">Pool 3</a></li>
                        <li><a href="view_pool?purpose=Grand">Pool 4</a></li>
                        <li><a href="view_pool?purpose=Ultimate">Pool 5</a></li>
                    </ul>
                </li>


                <li><a href="logout"><i class="fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
        <?php
    } else {
        ?>
        <div class="menu_section">
            <h3>Account Information</h3>
            <ul class="nav side-menu">
                <li><a href="dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                <li><a href="wallet"><i class="fa fa-dashboard"></i>Wallet</a>    
                    <?php /*
                      <li><a><i class="fa fa-user"></i> My Account <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <!-- <li><a href="personal">Personal Information</a></li>-->
                      <li><a href="guestrank">My Rank</a></li>
                      <li><a href="guestreflink">Referral Link</a></li>
                      </ul>
                      </li>
                      <li><a><i class="fa fa-user"></i>Support<span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                      <li><a href="support">New Support  Ticket</a></li>
                      <li><a href="supportlist">Previous Support Ticket</a></li>
                      </ul>
                      </li>
                      <li><a href="upgrade"><i class="fa fa-arrow-up"></i>Upgrade Account</a>

                      </li>
                     */
                    ?>

                <li><a href="logout"><i class="fa fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
        <?php
    }
    ?>

</div>
<!-- /sidebar menu -->
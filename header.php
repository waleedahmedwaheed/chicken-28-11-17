<header class="top-bar">
        <div class="container-fluid top-nav">
            <div class="search-form search-bar">
                <form>
                    <input name="searchbox" value="" placeholder="Search Topic..." class="search-input">
                </form>
                <span class="search-close waves-effect"><i class="ico-cross"></i></span>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="clearfix top-bar-action">
                        <span class="leftbar-action-mobile waves-effect"><i class="fa fa-bars "></i></span>
                        <span class="leftbar-action desktop waves-effect"><i class="fa fa-bars "></i></span>
						 
                        <span class="rightbar-action waves-effect"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-md-5 responsive-fix top-mid">
                    <div class="notification-nav">
							<h2 style="text-align: center;font-weight: 400;"> Islamabad Chicken </h2>	
						</div>
                    <div class="pull-left mobile-search">
						 
                    </div>
                </div>
                <div class="col-md-5 responsive-fix">
                    <div class="top-aside-right">
                        <div class="user-nav">
                            <ul>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="clearfix dropdown-toggle waves-effect waves-block waves-classic">
                                        <span class="user-info"><?php echo get_title(name,$_SESSION["id"],$dbconfig); ?><cite><?php echo get_title(username,$_SESSION["id"],$dbconfig); ?></cite></span>
                                        <span class="user-thumb"><img src="images/avatar/user.jpg" alt="image"></span>
                                    </a>
                                    <ul role="menu" class="dropdown-menu fadeInUp">
                                        <li><a href="change_pass.php"><span class="user-nav-icon"><i class="fa fa-lock"></i></span><span class="user-nav-label">Change Password</span></a>
                                        </li>
                                        <li><a href="logout.php"><span class="user-nav-icon"><i class="fa fa-sign-out"></i></span><span class="user-nav-label">Logout</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="pull-right desktop-search">
							 
                        </div>
                        <span class="rightbar-action waves-effect"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
	
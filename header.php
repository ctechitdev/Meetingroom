<style>
 

.navbar {
 
  background-color: white;
  position: fixed;
  top: 0;
  width: 100%;
}

.navbar a {
  float: left;
  display: block; 
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover { 
  color: black;
}

.main {
  padding: 16px;
  margin-top: 30px;
  height: 1500px; /* Used in this example to enable scrolling */
}
</style>
<header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b>
                            <!-- Dark Logo icon -->
                            <img src="images/kpicon.png" alt="homepage" class="dark-logo "  width="50" />
                            <!-- Light Logo icon --> 
                        </b>
                        <span> ໂປຣແກຣມນຳໃຊ້ຫ້ອງປະຊຸມ </span> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
						<!-- select request device-->
						 
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-dialpad"></i></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
									<br>
                                    <li>
                                        <div class="  text-center">
                                            <div class="u-img "> <?php echo "$full_name";?></div>
                                        </div>
										 
                                    </li>
									<br>
                                    <li role="separator" class="divider"></li> 
                                    <li><a href="change_password.php" ><i class="ti-settings"></i>  ປ່ຽນລະຫັດຜ່ານຂອງຜູ່ໃຊ້ </a></li><br>
									<li><a href="token_line.php" ><i class="fa fa-mobile"></i> ແຈ້ງເຕືອນຜ່ານ Line </a></li> <br>
                                    <li><a href="Logout.php"><i class="fa fa-power-off"></i> ອອກລະບົບ </a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
		 <br> <br> <br>
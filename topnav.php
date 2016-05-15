<?php
include_once 'db.php';
$db=new DB();
?>
<div class="navbar main hidden-print">

            <!-- Brand -->
            <a href="#" class="appbrand pull-left"><span>Push Notification/GCM  <span>v2.1</span></span></a>

            
            <!-- Menu Toggle Button -->
            <button type="button" class="btn btn-navbar">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <!-- // Menu Toggle Button END -->

            <!-- Top Menu -->
            
            <!-- // Top Menu END -->


            <!-- Top Menu Right -->
            <ul class="topnav pull-right">

               
                <!-- Profile / Logout menu -->
                <li class="account">
                    <a data-toggle="dropdown" href="#" class="glyphicons logout lock"><span class="hidden-phone text"><?php  echo $db->GetUserName()?></span><i></i></a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="#" id="modalSetting" class="glyphicons cogwheel">Settings<i></i></a></li>
                        
                        <li class="highlight profile">
                            <span>
                                
                                <span class="img"></span>
                                <span class="details">
                                    <a href="#"><?php echo $db->GetUserName(); ?></a>
                                    <?php echo $db->GetUserEmail(); ?>
                                </span>
                                <span class="clearfix"></span>
                            </span>
                        </li>
                        <li>
                            <span>
                                <a class="btn btn-default btn-mini pull-right" href="./logout.php">Sign Out</a>
                            </span>
                        </li>
                    </ul>
                </li>
                <!-- // Profile / Logout menu END -->

            </ul>
            <!-- // Top Menu Right END -->
<a href="#" class="appbrand pull-right"><span>Admin Panel</span></a>

        </div>
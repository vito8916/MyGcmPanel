<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include '../install/header.php';
?>

<div id="content">
	<div style="padding: 20px;">

<!-- Documentation -->
<section class="documentation">
	<div class="row-fluid">
		<div class="span9">
				
			<!-- Documentation CONTENT -->
			<h1>Documentation</h1>
<hr class="separator bottom" />

<ul class="nav nav-tabs">
	<li class="active"><a href="index.php" title="">What's in the package</a></li>
	<li><a href="howto.php" title="">How To! Getting Started...</a></li>
	<li><a href="configuration.php" title="">Configuration</a></li>
	
	
</ul>

<h3>Change Log</h3>
<hr class="separator bottom" />
<ul>

<li><span class="label label-info">V2.1</span><br/>
<p>
	1. Add <strong>Swipe Delete Notifications</strong><br/>
	2. Support Android 5.0.3<br/>
	</p></li>
<li><span class="label label-info">V2.0</span><br/>
<p>
	1. Add <strong>Categories Support</strong> : Now you can allow users to receive notification of their choices.<br/>
	2. Of course categories are <strong>managed by admin :)</strong><br/>
	3. Change <strong>web activity</strong> behaviour , Now it opens on notification click. [to compiles Google Play Store <strong>Privacy</strong>]<br/>
	4. Add <strong>Read more</strong> button on dialog notification type.</p></li>
	
	<li><span class="label label-info">V1.1.0</span><br/>
	1. <strong>Bug Fix :</strong> Registration Issues<br/>
	2. Easy <strong>Admob</strong> Integration <br/>
	3. <strong>News</strong> Notification (Saved in phone)
</strong> offers a interactive UI to control App. </li>
	
	<li><span class="label label-info">V1.0.0</span><br/>
	Initial Release</li>
</ul>



<h3>What's in the package</h3>
<hr class="separator bottom" />
<p>GCM Implementation is contained 2 plate form</p>
<ul>
	<li><strong>Admin Panel [PHP version:]</strong> offers a interactive UI to control App. </li>
	<li><strong>Android Application </strong> offers a robust implementation with better error handling mechanism of Google Cloud Messaging / C2DM . 
</ul><br/>

<h3>Admin Panel</h3>
<hr class="separator bottom" />
<p>Admin panel provide you a great user interactive plat form where you can easily manage your <b>Dashbord</b>, <b>Users</b>, <b>Notifications</b>, <b>Reports</b> etc...
</p><p><b>Dashbord :</b> Dashbord contain an easy to use notification sender with <span class="info"><b>Live Preview</b></span>. yes you can send notification based on your App <b>[if multiple application registered]</b>.</p>
<p><b>Users :</b> This section contain detailed information about your registered users. you can set their <b>status</b> or <b>send notification</b> <i><b>individually</b></i>.</p>
<p><b>Notifications :</b> This section contains information about all your notifications with history</p>
<p><b>Reports :</b> As the name suggest, it contains all data that you like to know about your notification like
    <ol>
        <li><span class="label label-success">Success :</span> indicates the number of users that notification is sent <b>successfully.</b> </li>
        <li><span class="label label-important">Failed :</span> indicates the number of users that notification is not sent and <b>failed</b> to sent. </li>
        <li><span class="label label-warning">Updated :</span> indicates the number of users that have a <b>canonical registration id</b> and being updated to database for ensuring that the user will receive notification for sure..:) </li>
         <li><span class="label label-info">Removed :</span> indicates the number of users that are no longer using your App and have uninstalled your App. [They will be removed from our database] </li>
          
        
    </ol>
</p>


<h3>Android Application</h3>
<hr class="separator bottom" />
<p>
<p>Android Application package provides a great implementation  of Google Cloud Messaging Service / C2DM. The application contain various customized receiver like <b>Simple Notification</b>, <b>Dialog Notification</b>, <b>Web Activity Notification</b>, <b>Toast Notification</b> , <b>News Notification</b>.</p>
<ol>
    <li><b>Simple Notification :</b> Receive simple notification on your device.</li>
    <li><b>Dialog Notification :</b> Receive simple notification on your device, And display a power full interactive dialog on your device.</li>
    <li><b>Web Activity Notification :</b> Opens web activity on your device with given URL.</li>
    <li><b>Toast Notification :</b> Simply put Toast on your screen.</li>
	<li><b><span class="label label-info">New [V1.1.0]</span>News Notification [saved in phone]:</b> Store the notification in mobile and let user view them offline.</li>
</ol>
        
</p>

 <h3>Disable categories!</h3>
                    <hr class="separator bottom" />
					<p>Yes, you can completely disable the new categories feature <b>Added in V2.0</b> by doing<br/>
					1. open res-> values-> string.xml and change use_cat to <b>false</b></p>
			<!-- Documentation CONTENT END -->
				
		</div>
		<div class="span3">
			<div class="widget widget-2 primary widget-body-white">
				<div class="widget-head">
					<h4 class="heading glyphicons circle_question_mark"><i></i> Documentation</h4>
				</div>
				<div class="widget-body list list-2">
					<ul>
						
						<li class="hasSubmenu active">
							<a href="#" title="" class="glyphicons link"><i></i>Getting Started</a>
							<ul>
								<li class="active"><a href="#" title="">What's in the package</a></li>
								<li><a href="howto.php" title="">How To! Getting Started...</a></li>
								<li><a href="configuration.php" title="">Configuration</a></li>
								
								
							</ul>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Documentation END -->

</div>	
		
		</div>
<?php

include '../install/footer.php';
?>
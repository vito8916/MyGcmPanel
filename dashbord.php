<?php
if (session_id() == '') {
                session_start();
   }
   if(!$_SESSION['is_logged']){
   	header("Location: ./index.php");
   }

require 'header.php';

?>
<!-- Content -->
<div id="content">

    <h3 class="heading-mosaic">Send Notifications</h3>
    <div class="row-fluid1">
        <div class="span6">

            <!-- Widget -->
            <div class="widget" data-toggle="collapse-widget">

                <!-- Widget heading -->
                <div class="widget-head">
                    <h4 class="heading">Send Mass Notification</h4>

                </div>
				
                <!-- // Widget heading END -->

                <div class="widget-body">
                    <form action="" id="notyform" method="POST">
                        <div class="row-fluid">
                            <select name="app_type" class="span12" id="select2_1">
                                <option value="-1">Select App Type</option>
                                 <option value="0">Send to all App</option>
                                  <?php
$apps = $db->GetAppList();
foreach ($apps as $key => $app) {
  ?>
    <option value="<?php echo $app['app_type']?>"><?php echo $app['app_type']?></option>
  <?php    
}
?>

                            </select>

                        </div>
						<hr>
                        
                        <div class="row-fluid">
                            <select name="categories[]" class="span12" id="select2_4" multiple="true" placeholder="Select Categories">
                                
                                  <?php
$apps = $db->getAllCategories(true);
foreach ($apps as $key => $app) {
  ?>
    <option value="<?php echo $app['id']?>"><?php echo $app['cat_name']?></option>
  <?php    
}
?>

                            </select>

                        </div>
						<hr>
                        <div class="clearfix"></div>
                        <div class="row-fluid">
                            <select class="selectpicker span12" name="type" id="notytype">
                                <option value="1">Simple Notification</option>
                                <option value="2">Dialog Notification</option>
                                <option value="3">Web Activity</option>
                                <option value="4">Toast</option>
								<option value="5">News [saved in phone]</option>
                            </select> 
                        </div>
						<hr>
                        <div class="clearfix"></div>
                        <input type="hidden" name="send_cat"/>
                        <div class="row-fluid">
                            <input type="text" name="title" placeholder="Title" class="span12 mTitle black" />
                        </div>
                        <div class="row-fluid mMessage">
                            <input type="text" name="message" placeholder="Message" class="span12 mMsg black" />
                        </div>

                        <div class="row-fluid mEmotion hide">
                            <input type="text" name="emotion" placeholder="Emotion Eg. :)" class="span12 mEmo black" />
                        </div>
                        <div class="row-fluid mLink hide">
                            <div class="input-prepend  span12">
                                <span class="add-on">http://</span>
                                <input id="prependedInput"  class="span10 black" name="link" placeholder="Link to be open" type="text"/>
                            </div>

                        </div>
                        <hr>
                        <div class="row-fluid">
                            <button type="button" id="btn-loading" class="btn btn-primary sendnoty" data-loading-text="Loading...">Send Now</button>


                            <div class="toggle-button pull-right" data-toggleButton-style-enabled="info">
                                <input type="checkbox" checked="checked" class="mPreview"/>
                            </div>
                            <span class="pull-right">Preview Mode&nbsp;&nbsp;</span>

                        </div>
                    </form>
                </div>
            </div>
            <!-- // Widget END -->

        </div>

        <div class="span6 mPreviewContainer">
            <div class="simple_mokup offset1">
                <div class="pTitle" style="position: absolute;top: 190px;left: 680px;color: #FFF;width:250px">Title</div>
                <div class="pMsg" style="position: absolute;top: 210px;left: 680px;color: #FFF;width:250px">Message</div>
                <img src="./assets/images/simple.png"/>
            </div>
            <div class="dialoge_mokup offset1 hide">
                <div class="pTitle" style="position: absolute;top: 390px;left: 610px;color: #000;width: 250px;border-bottom: #AAAAAA 1px solid;">Title</div>
                <div class="pMsg" style="position: absolute;top: 410px;left: 610px;color: #000;width: 250px;height:70px">Message</div>
                <div class="pEmo" style="position: absolute;top: 440px;left: 865px;color: #000;font-size: 20px"> :)</div>
                <img src="./assets/images/dialoge.png"/>
            </div>
			
			   <div class="news_mokup offset1 hide">
                 <div class="pTitle" style="position: absolute;top: 210px;left: 700px;color: #000;width:250px">Title</div>
                <div class="pMsg" style="position: absolute;top: 230px;left: 700px;color: #000;width:250px">Message</div>
                <img src="./assets/images/ican.png"/>
            </div>

            <div class="webview_mokup offset1 hide">

                <img src="./assets/images/webview.png"/>
            </div>

            <div class="toast_mokup offset1 hide">
                <div class="pTitle" style="position: absolute;top: 620px;left: 650px;color: #FFF;width: 250px;">Title</div>
                <img src="./assets/images/toast.png"/>
            </div>
        </div>
        <!-- // Widget END -->

    </div>

</div>
<!-- // Content END -->
<script type="text/javascript">
    var d=document.getElementsByClassName("dashbord");
    d[0].setAttribute("class", "active");
</script>

<?php
require_once 'footer.php';
?>
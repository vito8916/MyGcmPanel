<?php

if (session_id() == '') {
                session_start();
   }
   if(!$_SESSION['is_logged']){
   	header("Location: ./index.php");
   }
   
require_once 'header.php';
?>
<script type="text/javascript">
    var d=document.getElementsByClassName("users");
    d[0].setAttribute("class", "active");
</script>

<!-- Content -->
<div id="content">

    <h3 class="heading-mosaic">List of users</h3>
    <div class="innerLR">
        <div class="widget">

            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">Users</h4>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <table class="dynamicTable table table-striped table-bordered table-condensed">

                    <!-- Table heading -->
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>App Type</th>
                            <th>Registration Date</th>
                            <th>Is Active</th>
                            <th>Notification</th>
							
                        </tr>
                    </thead>
                    <!-- // Table heading END -->

                    <!-- Table body -->
                    <tbody>
                        <?php
                        
                        $users = $db->getAllUsers();

                        foreach ($users as $key => $value) {
                            ?>
                            <!-- Table row -->
                            <tr class="gradeX">
                                <td>Email : <?php echo $value['email']; ?></td>
                                <td><?php echo $value['app_type']; ?></td>
                                <td><?php echo $value['time'] ?></td>
                                <td class="center">

                                    <div class="toggle-button pull-right" data-toggleButton-style-enabled="danger">
                                        <input type="checkbox" <?php
                        if ($value['is_active']) {
                            echo "checked=checked";
                        }
                            ?> class="mActive" id="<?php echo $value['uid'] ?>"/>
                                    </div>

                                </td>
                                <td>
                                    <span>
                                        <a id="<?php echo $value['gcm_id']?>" class="btn btn-success btn-mini notybutton">Send Notification</a>
                                    </span>
                                </td>
                            </tr>


                            <!-- // Table row END -->
                        <?php } ?>
                        <!-- Table row -->

                        <!-- // Table row END -->

                    </tbody>
                    <!-- // Table body END -->

                </table>
            </div>
        </div>
    </div>

    <div class="modal hide fade span12" id="modal-noty" role="dialoge" style="left:5%;width:90%;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
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
                                <select class="selectpicker span12" name="type" id="notytype">
                                    <option value="1">Simple Notification</option>
                                    <option value="2">Dialog Notification</option>
                                    <option value="3">Web Activity</option>
                                    <option value="4">Toast</option>
									<option value="5">News [saved in phone]</option>

                                </select> 
                            </div>
                            <hr>
                            <input type="hidden" name="gcm_id" id="gcm_id" value=""/>
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
                    <div class="pTitle" style="position: absolute;top: 150px;left: 690px;color: #FFF;">Title</div>
                    <div class="pMsg" style="position: absolute;top: 170px;left: 690px;color: #FFF;">Message</div>
                    <img src="./assets/images/simple.png"/>
                </div>
                <div class="dialoge_mokup offset1 hide">
                    <div class="pTitle" style="position: absolute;top: 350px;left: 620px;color: #000;width: 250px;border-bottom: #AAAAAA 1px solid;">Title</div>
                    <div class="pMsg" style="position: absolute;top: 370px;left: 620px;color: #000;width: 250px;height:70px">Message</div>
                    <div class="pEmo" style="position: absolute;top: 400px;left: 875px;color: #000;font-size: 20px"> :)</div>
                    <img src="./assets/images/dialoge.png"/>
                </div>

                <div class="webview_mokup offset1 hide">

                    <img src="./assets/images/webview.png"/>
                </div>

				 <div class="news_mokup offset1 hide">

                 <div class="pTitle" style="position: absolute;top: 170px;left: 710px;color: #000;">Title</div>

                    <div class="pMsg" style="position: absolute;top: 190px;left: 710px;color: #000;">Message</div>

                <img src="./assets/images/ican.png"/>

            </div>
                <div class="toast_mokup offset1 hide">
                    <div class="pTitle" style="position: absolute;top: 580px;left: 660px;color: #FFF;width: 250px;">Title</div>
                    <img src="./assets/images/toast.png"/>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
            
        </div>
    </div>
</div>
<!-- // Content END -->


<?php
require_once 'footer.php';
?>
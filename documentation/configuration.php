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
                    <h1>Getting Started</h1>
                    <hr class="separator bottom" />

                    <ul class="nav nav-tabs">
                        <li><a href="index.php" title="">What's in the package</a></li>
						<li><a href="howto.php" title="">How To! Getting Started...</a></li>
                        <li class="active"><a href="configuration.php" title="">Configuration</a></li>
	
                    </ul>

                    <h3>Admin Panel Configuration</h3>
                    <hr class="separator bottom" />
                    <p>The admin panel is build as a easy to install <b>Installation Agent</b> follow the below steps to install in your server.</p>
                    <ol>
                        <li><b>Unzip</b> the GCM_server.zip in to your web server</li>
                        <li>Now open the root directory <pre> http://YOUR_SITE.COM/PATH_TO_YOUR_GCM_SERVER_FILE</pre>of where you have unzip the folder. it will drive you to installation guide.</li>
                        <li>If not than open <pre>/install.</pre> path and you will be prompt to fill the configuration details.</li>
                        <li><b>Fill the details</b> and you have all done. :)</li>
                        <li>If you found any problems or bug . please contact us at gcmapp@icanstudioz.com</li>
                    </ol>
                    <!-- Documentation CONTENT END -->

                    <h3>Android App Configuration</h3>
                    <hr class="separator bottom" />
                    <p>Follow the steps to compile Android app</p>
                    <ol>
                        <li><b>Unzip</b> the android source into your PC.</li>
                        <li>Import the project into your Android Development IDE. if your are using <b>Eclipse</b> than <pre>create new android application project -> Using existing source -> select our project -> done</pre></li>
                        <li>Now import <pre>Google Play Service Lib</pre> includes in Zip already.</li>
                        <li>Now open <pre>src -><br/>find <b>GCM_Config.java</b> file. and edit appropriate details.</pre></li>
                        <li>Compile, Build, And Publish.:)</li>
                    </ol>
					
					 <h3>Disable categories!</h3>
                    <hr class="separator bottom" />
					<p>Yes, you can completely disable the new categories feature by doing<br/>
					1. open res-> values-> string.xml and change use_cat to <b>false</b></p>
                </div>
                <div class="span3">
                    <div class="widget widget-2 primary widget-body-white">
                        <div class="widget-head">
                            <h4 class="heading glyphicons circle_question_mark"><i></i> Documentation</h4>
                        </div>
                        <div class="widget-body list list-2">
                            <ul>

                                <li class="hasSubmenu active">
                                    <a href="index.php" title="" class="glyphicons link"><i></i>Getting Started</a>
                                    <ul>
                                        <li ><a href="index.php" title="">What's in the package</a></li>
										<li><a href="howto.php" title="">How To! Getting Started...</a></li>
                                        <li class="active"><a href="configuration.php" title="">Configuration</a></li>

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
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
                    <h1><a href="configuration.php" title="">How to!</a>
								</h1>
                    <hr class="separator bottom" />

                    <ul class="nav nav-tabs">
                        <li><a href="index.php" title="">What's in the package</a></li>
						<li class="active"><a href="howto.php" title="">How To! Getting Started...</a></li>
                        <li ><a href="configuration.php" title="">Configuration</a></li>

                    </ul>

                    <h3>Admin Panel Installation</h3>
                    <hr class="separator bottom" />
                
                    <ol>
                        <li><pre>open the ./install path on your browser.</pre>
						<img src="../assets/images/db1.png"/>
						</li>
                        <li><pre>Now fill the database information as shown in screenshots.</pre></li>
						<li><pre>Now go to Google API Console and get your API key for GCM API.</pre>
						<img src="../assets/images/db.png"/></li>
                        <li><pre>Put API key in field called Google API Key.</pre></li>
                        <li><pre>Fill the Admin details which you need to login when you want to manage or send notifications.</pre>
						<img src="../assets/images/db3.png"/>
						</li>
						<li><pre>Hit the Install button and you are done...:)</pre></li>
						<li><pre>Congratulations!!! Start Sending Notification Now...:)</pre></li>
                        <li>If you found any problems or bug . please contact us at gcmapp@icanstudioz.com</li>
                    </ol>
                    <!-- Documentation CONTENT END -->

                    <h3>Android App Installation</h3>
                    <hr class="separator bottom" />
                    <p>Follow the steps to compile and run in your Eclipss IDE.</p>
                    <ol>
                        <li><pre>Open your favorite Android IDE. Select new project import from top-left corner!</pre>
						<img src="../assets/images/and1.png"/>
						 <hr class="separator bottom" />
						</li>
                        <li><pre>Now select existing source as android application and click -> Next</pre>
						<img src="../assets/images/and2.png"/>
						 <hr class="separator bottom" />
						  <hr class="separator bottom" />
						</li>
                        <li><pre>Browse the android source provided to you by us.</pre></li>
						<li><pre>Select both Application source and Google Play Lib to import and hit -> finish.</pre>
						<img src="../assets/images/and3.png"/>
						 <hr class="separator bottom" />
						</li>
                        <li><pre>Now righr click on project and select properties as shown in scrrenshot.</pre>
						<img src="../assets/images/and4.png"/>
						<hr class="separator bottom" />
						<img src="../assets/images/and5.png"/>
							<hr class="separator bottom" />
						</li>
                        <li><pre>Select Android on left menu and than, Click add button and select Google Play Serviece Library . and hit -> Ok.</pre>
						<img src="../assets/images/and6.png"/>
						<hr class="separator bottom" />
					
						<li><pre>Now select the project and click -> clean from -> projects menu. select both the projects and hit -> Ok.</pre>
							<img src="../assets/images/and7.png"/>
						<hr class="separator bottom" />
					<img src="../assets/images/and8.png"/>
						<hr class="separator bottom" />
						</li>
							<li><pre>Run your project by right click -> Run As -> Android Application.</pre>
					<img src="../assets/images/and9.png"/>
						<hr class="separator bottom" />
					
						</li>
						
						
						
						<li><pre>Congratilation!!!</pre>
						<li>If you found any problems or bug . please contact us at gcmapp@icanstudioz.com</li>
                    </ol>
					
					<h3>Setting up your Android App And ADMOB</h3>
					<hr class="separator bottom" />
					<ol>
					<li><pre>Seeting up your Admob : Goto Res -> Values -> Strings.xml as shown in screenshot.</pre>
					<img src="../assets/images/and10.png"/>
						<hr class="separator bottom" />
					
						</li>
						
						<li><pre>Seeting your App : Goto Src -> com.icanappz.gcmimplementation -> GCM_Config.java as shown in screenshot. and set your details.</pre>
					<img src="../assets/images/and11.png"/>
						<hr class="separator bottom" />
					
						</li>
						
						<li><pre> Done! </pre>
					
						</li>
						</ol>
						

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
										<li class="active"><a href="howto.php" title="">How To! Getting Started...</a></li>
                                        <li ><a href="configuration.php" title="">Configuration</a></li>

								
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
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

    <h3 class="heading-mosaic">Reports</h3>
    <div class="innerLR">
        <div class="row-fluid">

            <!-- Widget -->
            <div class="widget" data-toggle="collapse-widget">

                <!-- Widget heading -->
                <div class="widget-head">
                    <h4 class="heading">Report between Dates</h4>

                </div>
                <!-- // Widget heading END -->

                <div class="widget-body">
                    <div class="filter-bar">
                        <form id="graphform">

                            <!-- Filter -->
                            <div>
                                <label>From:</label>
                                <div class="input-append">
                                    <input type="text" name="from" id="dateRangeFrom" class="" value="<?php echo date('Y-m-d'); ?>" style="height:25px;" />
                                    <span class="add-on glyphicons calendar"><i></i></span>
                                </div>
                            </div>
                            <!-- // Filter END -->

                            <!-- Filter -->
                            <div>
                                <label>To:</label>
                                <div class="input-append">
                                    <input type="text" name="to" id="dateRangeTo" class="" value="<?php echo date('Y-m-d'); ?>" style="height:25px;" />
                                    <span class="add-on glyphicons calendar"><i></i></span>
                                </div>
                            </div>
                            <!-- // Filter END -->

                            <div style="margin-left:10px;"><button class="btn btn-primary btn-success" id="showGraph"> Go</button></div>
                            <div class="clearfix"></div>
                            <!-- // Filter END -->

                        </form>
                    </div>

                    <div class="widget">

                <!-- Widget heading -->
                <div class="widget-head">
                    <h4 class="heading">Notifications Reports</h4>
                </div>
                <!-- // Widget heading END -->

                <div class="widget-body">
                    <table class="dynamicTableGCM table table-striped table-bordered table-condensed">

                    <!-- Table heading -->
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Link</th>
                            <th>Emotion</th>
                            <th>Time</th>
                            <th>Success</th>
                            <th>Failed</th>
                            <th>Updated</th>
                            <th>Removed</th>
                        </tr>
                    </thead>
                    <!-- // Table heading END -->

                    <!-- Table body -->
                    <tbody class="TableGCMBody">
                          
                         

                    </tbody>
                    <!-- // Table body END -->

                </table>
                </div>
            </div>

                    
                    <!-- Widget -->
                    <div class="widget">

                        <!-- Widget heading -->
                        <div class="widget-head">
                            <h4 class="heading">Lines chart with fill & without points</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body">

                            <!-- Chart with lines and fill with no points -->
                            <div id="chart_lines_fill_nopoints" style="height: 250px;"></div>
                        </div>
                    </div>

                    <div class="widget">

                        <!-- Widget heading -->
                        <div class="widget-head">
                            <h4 class="heading">Donut Chart</h4>
                        </div>
                        <!-- // Widget heading END -->

                        <div class="widget-body">

                            <!-- Chart Donut -->
                            <div id="chart_donut" style="height: 250px;"></div>
                        </div>
                    </div>
                    <!-- // Widget END -->





                </div>
            </div>
            <!-- // Widget END -->

        </div>


        <!-- // Widget END -->

    </div>

</div>
<!-- // Content END -->

<script type="text/javascript">
    var d=document.getElementsByClassName("reports");
    d[0].setAttribute("class", "active");
</script>
<?php
require_once 'footer.php';
?>
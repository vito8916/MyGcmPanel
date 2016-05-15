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
    var d=document.getElementsByClassName("categories");
    d[0].setAttribute("class", "active");
</script>

<!-- Content -->
<div id="content">

    <h3 class="heading-mosaic">List of Categories</h3>
    
     <div class="row-fluid innerLR">

            <!-- Widget -->
            <div class=" span6 widget" data-toggle="collapse-widget">

                <!-- Widget heading -->
                <div class="widget-head">
                    <h4 class="heading">Add Categories</h4>

                </div>
                <!-- // Widget heading END -->

                <div class="widget-body">
                    <form action="" id="catform" method="POST">
                        <div class="row-fluid">
                          <input type="text" class="span12" name="cat_name" value="" placeholder="Category Name"/>
                        </div>
                        <div class="row-fluid">
                          <input type="text" class="span12" name="cat_desc" value="" placeholder="Category Description"/>
                        </div>
                          <div class="row-fluid">
                          <button type="submit" class="btn btn-success offset1 pull-right" id="addcat" name="">Save</button>
                          <button type="reset" class="btn btn-warning pull-right" name="">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- // Widget END -->

        </div>
    <div class="innerLR">
        
        <div class="widget" data-toggle="collapse-widget">

            <!-- Widget heading -->
            <div class="widget-head">
                <h4 class="heading">Categories</h4>
            </div>
            <!-- // Widget heading END -->

            <div class="widget-body">
                <table class="dynamicTable table table-striped table-bordered table-condensed">

                    <!-- Table heading -->
                    <thead>
                        <tr>
                            <th>Id.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>is_active</th>
                            <th>Action</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
                    <!-- // Table heading END -->

                    <!-- Table body -->
                    <tbody class="bodycat">
                        <?php
                        $users = $db->getAllCategories();

                        foreach ($users as $key => $value) {
                            ?>
                            <!-- Table row -->
                            <tr class="gradeX" id="c<?php echo ($value['id']); ?>">
                                <td><?php echo ($value['id']==NULL)?"-":$value['id']; ?></td>
                                <td><?php echo ($value['cat_name']==NULL)?"-":$value['cat_name']; ?></td>
                                <td><?php echo ($value['cat_desc']==NULL)?"-":$value['cat_desc']; ?></td>
                                <td class="center">

                                    <div class="toggle-button pull-right" data-toggleButton-style-enabled="danger">
                                        <input type="checkbox" <?php
                        if ($value['is_active']) {
                            echo "checked=checked";
                        }
                            ?> class="mCatActive" id="<?php echo $value['id'] ?>"/>
                                    </div>

                                </td>
                                <td><button type="button" class="btn btn-danger btn-mini deleteCat" id="<?php echo ($value['id']); ?>">delete</button>
                                <button type="button" class="btn btn-success btn-mini editCat" id="<?php echo ($value['id']); ?>">edit</button></td>
                                <td><?php echo ($value['last_update']==NULL)?"-":$value['last_update']; ?></td>
                                

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
    
    <div class="modal hide fade" id="modal-cat" role="dialoge">
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
                        <h4 class="heading">Edit Categories</h4>

                    </div>
                    <!-- // Widget heading END -->

                    <div class="widget-body">
                        <form action="" id="catsaveform" method="POST">
                            
                           
                            <input type="hidden" name="cat_id" id="cat_id" value=""/>
                            <div class="row-fluid">
                                <input type="text" name="cat_name" placeholder="Name" class="span12 mTitle black" />
                            </div>
                            <div class="row-fluid mMessage">
                                <input type="text" name="cat_desc" placeholder="Description" class="span12 mMsg black" />
                            </div>

                            
                        </form>
                    </div>
                </div>
                <!-- // Widget END -->

            </div>

           
        </div>
        <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
            <a href="#" class="btn btn-primary" id="saveCat">Save changes</a>
        </div>
    </div>
</div>

   
</div>
<!-- // Content END -->


<?php
require_once 'footer.php';
?>
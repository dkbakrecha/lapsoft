<?php
if (isset($productId) && !empty($productId)) {
    echo $productId;
}
?>
<section class="content-header">
    <h1>
        Product Master
        <small><!--Preview of UI elements --></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>">
                <i class="fa fa-dashboard"></i>Home</a>
        </li>
        <li>
            <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'products', 'action' => 'index')); ?>">Product Master</a>
        </li>
        <li class="active">Edit</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- START CUSTOM TABS -->
    <h2 class="page-header">Add Product</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Part 1</a></li>

                    <li><a href="#tab_2" data-toggle="tab">Part 2</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Part 2</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Part 3</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Dropdown <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                        </ul>
                    </li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <b>How to use:</b>
                        <p>The process of adding a product is divided into multiple parts. Part first is compulsory to complete.</p>
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Basic Product Information</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            echo $this->Form->create('Product', array(
                                'role' => 'form',
                                'div' => false,
                                'class' => 'form-horizontal',));
                            echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'ProductId',));
                            ?>

                            <div class="box-body">

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Product Title</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('product_title', array(
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'label' => false,
                                            'required' => true
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Product Description</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('description', array(
                                            'class' => 'form-control',
                                            'div' => false,
                                            'rows' => 3,
                                            'label' => false
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Height</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('height', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                            'placeholder' => 'Only Number allowed',
                                            'required' => true
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Width</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('width', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                            'placeholder' => 'Only Number allowed',
                                            'required' => true
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Length</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('length', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                            'placeholder' => 'Only Number allowed',
                                            'required' => true
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">

                                <?php
                                echo $this->Form->submit('Update', array(
                                    'class' => 'btn btn-info pull-right',
                                ));
                                ?>

                            </div>
                            <?php
                            echo $this->Form->end();
                            ?>
                            <!-- /.box-footer -->

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Product Images</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            echo $this->Form->create('ProductImages', array(
                                'role' => 'form',
                                'type' => 'file',
                                'div' => false,
                                'class' => 'form-horizontal',));
                            echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'ProductId',));
                            ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-sm-9">
                                        <div id="progressBlock" style="	opacity: 0">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info progress-bar-striped">0%</div>
                                            </div>
                                            <div id="status"></div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><h4>Upload Images</h4></label>
                                    <div class="col-sm-9">
                                        <div id="images">
                                            <ul id="sortable">
                                                <?php
                                                if (isset($product_image[0])) {
                                                    foreach ($product_image as $image) {
                                                        ?>
                                                        <li id="item_<?php echo $image['ProductPhoto']['id']; ?>">
                                                            <div class="card_image">
                                                                <div class="x_img_outer">
                                                                    <div class="x_img" style="" onclick="delImage('<?php echo $image['ProductPhoto']['id']; ?>')"></div>
                                                                </div>
                                                                <?php echo $this->Image->resize('admin_uploads/' . $image['ProductPhoto']['image'], 100, 150); ?>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div onclick="$('#newImage').click();"  class="goyal btn btn-success btn-md btn-block">Upload Images</div>
                                        <div class="info-text" >First image will be cover image, you can drag image to make it first. </div>
                                    </div>

                                </div> 


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <?php
                                echo $this->Form->submit('Update', array(
                                    'class' => 'btn btn-info pull-right',
                                ));
                                ?>




                            </div>
                            <?php
                            echo $this->Form->end();
                            ?>
                            <!-- /.box-footer -->

                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        This is part 4.
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <?php echo $this->Form->create('imageTemp', array('type' => 'file', 'id' => 'imageTempStep1Form')); ?>
        <label style="display:none" class="">
            <?php
            echo $this->Form->input('uploadfile.', array(
                'name' => 'uploadfile[]',
                'id' => 'newImage',
                'type' => 'file',
                'label' => false,
                'onchange' => "$('#imageTempStep1Form').submit();",
                'class' => '',
                'multiple'));
            ?>
        </label>

    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->
</section>
<!-- /.content -->

<?php echo $this->Form->end(); ?>
<script>
    jQuery(document).ready(function($) {
      //  alert($('#ProductId').val());
    });
    function newupload() {
        alert("I am in");
        var bar = $('.progress-bar');
        var percent = $('.progress-bar');
        var status = $('#status');
        var options = {
            url: '<?php echo $this->Html->url(array("admin" => true, "controller" => "products", "action" => "image_multi_upload")); ?>', data: ({product_id: $('#ProductId').val()}),
            error: function(data) {

            },
            beforeSend: function() {
                $("#progressBlock").css('opacity', '1');
                bar.width('0%');
                percent.html('0%');
            }, beforeSubmit: function(arr, $form, options) {
                if (arr[1] && arr.length == 2) {
                    var image = arr[1].value.name;
                    var fname = image;
                    var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
                    if (!re.exec(fname)) {
                        alert("File extension not supported!");
                    }
                    var size = arr[1].value.size / 1024;
                    // console.log(size);
                    var imageSize = Math.round(size); /// IN KB
                    var maximumImageSize = 10000; ////  IN KB  ///// 10 MB
                    if (imageSize > maximumImageSize) {
                        alert('Image should be less than 10MB');
                        return false;
                    }
                }
            },
            /* progress bar call back*/
            uploadProgress: function(event, position, total, percentComplete) {

                var percentValue = percentComplete + '%';
                bar.width(percentValue);
                percent.html(percentValue);
            },
            complete: function(response) {
                $("#progressBlock").css('opacity', '0');
                response = response.responseText;
                var res_array = $.parseJSON(response);
                //if user upload single image then these error will shown.
                if (res_array.length === 1) {
                    if (response == 'TYPE_ERROR') {
                        $("html,body").animate({scrollTop: $('#phototipsa').position().top}, "slow");
                        alert('Sorry, please use a jpeg or png image.');
                        return false;
                    }
                    if (response == 'SIZE_RATIO_ERROR') {
                        $("html,body").animate({scrollTop: $('#phototipsa').position().top}, "slow");
                        alert('Image size should be minimum of 300px X 300px');
                        return false;
                    }
                    if (response == 'SIZE_ERROR') {
                        $("html,body").animate({scrollTop: $('#phototipsa').position().top}, "slow");
                        alert('Image should be less than 10MB');
                        return false;
                    }
                }
                if (res_array.length) {
                    //$('.photo_type_error').html('');
                    var pVel = 100 + '%';
                    percent.html(pVel);
                    bar.width(pVel);
                    var is_error = 0;
                    for (var i = 0; i < res_array.length; i++) {
                        if (res_array[i]['error'] == 1) {
                            is_error++;
                            continue;
                        }
                        image_preview(res_array[i]);
                    }
                    if (is_error != 0) {
                        if (is_error == res_array.length) {
                            alert('Please upload photo(s) which meet our photo upload requirements.');
                        }
                        else {
                            alert('Some photo does not meet our photo upload requirements.');
                        }
                    }
                    if (is_error == 0) {
                        $("html,body").animate({scrollTop: 1000}, "slow");
                    }
                }
                else {
                    alert('Error in image uploading, Please try again later .');
                    return false;
                }
            }
        }
        $('#imageTempStep1Form').ajaxForm(options);
    }

//    //set set preview
//    function image_preview(res) {
//        $("#busy-indicator").fadeOut();
//        var obj = res; //JSON.parse(res);
//        x_image_content = '<li id="item_' + obj.img_id + '"><div class="card_image"><div class="x_img_outer"><div class="x_img" style="display:;" onclick="delImage(' + obj.img_id + ')"></div></div><img src="' + obj.img_name + '"/></div></li>';
//        $('#sortable').prepend(x_image_content);
//        $('#ProductId').val(obj.product_id);
//        product_id = obj.product_id;
//        newupload();
//        coverPhoto();
//        sortable_image();
//        $('.percent').html('0%');
//        $('.bar').width('0%');
//    }
//
//    $(function() {
//        newupload();
//        sortable_image();
//    });
//    function sortable_image() {
//        $("#sortable").sortable({
//            start: function(event, ui) {
//                is_dragging = true;
//            },
//            stop: function(event, ui) {
//                is_dragging = false;
//            },
//            opacity: 0.8,
//            cursor: 'move',
//            update: function() {
//
//                var order = $(this).sortable("serialize");
//                $.post("<?php echo $this->Html->url(array("controller" => "products", "action" => "updateorder")); ?>", order, function(theResponse) {
//                    coverPhoto();
//                });
//            }
//        });
//    }
//    ;
//    function delImage(Photo_id) {
//        bootbox.confirm('Are you sure you want to delete this image?', function(r) {
//            if (r == true) {
//                URL = '<?php echo $this->Html->url(array("controller" => "products", "action" => "deletePhoto")); ?>';
//                $.ajax({
//                    url: URL,
//                    method: 'POST',
//                    data: ({Photo_id: Photo_id}),
//                    success: function(data) {
//                        $("#item_" + Photo_id).remove();
//                        sortable_image();
//                    }
//                });
//            }
//        });
//    }
//    ;
//    var cover_photo = '<div class="cover_photo" title="To change cover photo drag desire image at first position.">First Photo</div>';
//    function coverPhoto() {
//        $(".cover_photo").remove();
//        $("#sortable li:eq(0)").append(cover_photo);
//    }

</script>


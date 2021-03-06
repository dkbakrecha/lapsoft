<?php
//prd($productData);
?>
<style>
    table.fixed-table { table-layout:fixed; }
    table.fixed-table td { overflow: hidden; }

</style>
<?php
if (isset($this->request->data['Product']['id']) && !empty($this->request->data['Product']['id'])) {
    $productId = $this->request->data['Product']['id'];
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
    <h2 class="page-header">Edit Product</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Basic Information (1)</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Basic Information (2)</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Product Images (3)</a></li>
                    <?php
                    if ($this->request->data['Product']['multiple_parts']) {
                        ?>
                        <li><a href="#tab_4" data-toggle="tab">Multiple Parts (4)</a></li>
                        <?php
                    }
                    ?>
                    <li class="pull-right">
                        <a href="#" class="text-muted">
                            <i class="fa fa-gear"></i>
                        </a>
                    </li>
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
                                            'required' => true,
                                            'type' => 'text',
                                            'data-validation' => 'number',
                                            'data-validation-error-msg-number' => "Only numbers allowed."
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
                                            'required' => true,
                                            'type' => 'text',
                                            'data-validation' => 'number',
                                            'data-validation-error-msg-number' => "Only numbers allowed."
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
                                            'required' => true,
                                            'type' => 'text',
                                            'data-validation' => 'number',
                                            'data-validation-error-msg-number' => "Only numbers allowed."
                                        ));
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Net Size</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('net_size', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                            'placeholder' => 'Only Number allowed',
                                            'required' => true,
                                            'type' => 'text',
                                            'data-validation' => 'number',
                                            'data-validation-error-msg-number' => "Only numbers allowed."
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">CBM</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('cbm', array(
                                            'label' => false,
                                            'class' => 'form-control',
                                            'disabled' => true,
                                            'type' => 'text',
                                            'value' => '',
                                            'data-validation' => 'number',
                                            'data-validation-error-msg-number' => "Only numbers allowed."
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Finish Type</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $material = array(
                                            'Other' => 'Other',
                                            'Bamboo' => 'Bamboo',
                                            'Fabric' => 'Fabric',
                                            'Genuine Leather' => 'Genuine Leather',
                                            'Glass' => 'Glass',
                                            'Metal' => 'Metal',
                                            'Plastic' => 'Plastic',
                                            'Rattan/Wicker' => 'Rattan/Wicker',
                                            'Synthetic Leather' => 'Synthetic Leather',
                                            'Wooden' => 'Wooden');

                                        echo $this->Form->input('finishing_type', array(
                                            'label' => false,
                                            'class' => 'form-control',
                                            'options' => $material,
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Multiple Parts</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $optionsData = array(
                                            '0' => 'No',
                                            '1' => 'Yes',
                                        );
                                        echo $this->Form->input('multiple_parts', array(
                                            'label' => false,
                                            'class' => 'form-control',
                                            'options' => $optionsData,
                                        ));
                                        ?>
                                    </div>
                                </div>

                                <!--                                <div class="form-group">
                                                                    <label  class="col-sm-2 control-label">Keywords</label>
                                                                    <div class="col-sm-10">
                                <?php
//                                        echo $this->Form->input('keywords', array(
//                                            'label' => false,
//                                            'class' => 'form-control',
//                                            'placeholder' => "Keywords if any for SEO purpose."
//                                        ));
                                ?>
                                                                    </div>
                                                                </div>-->
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
                                <h3 class="box-title">Other Information</h3>
                            </div>
                            <b>Check List:</b>
                            <p>1.Only PDF file Format allowed. 2. Maximum size 2MB allowed.</p>

                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            echo $this->Form->create('Product', array(
                                'role' => 'form',
                                'type' => 'file',
                                'div' => false,
                                'class' => 'form-horizontal',
                                'url' => array('admin' => true, 'action' => 'edit')));
                            echo $this->Form->input('id', array('value' => $productId, 'hidden'));
                            ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Assembly Instructions</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('assembly_instruction', array(
                                            'class' => 'form-control',
                                            'placeholder' => '',
                                            'label' => false,
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Assembly Instruction File</label>
                                    <div class="col-sm-5">
                                        <?php
                                        echo $this->Form->input('assembly_instruction_file', array(
                                            'class' => 'btn btn-default',
                                            'div' => false,
                                            'label' => false,
                                            'type' => 'file',
                                            'multiple' => 'multiple',
                                            'data-validation' => 'required extension',
                                            'data-validation-allowing' => 'pdf',
                                            'data-validation' => 'mime size',
                                            'data-validation-max-size' => '2M',
                                        ));
                                        ?>

                                    </div>
                                    <div class="col-sm-5">
                                        <?php
                                        if (isset($productData['Product']['assembly_instruction_file']) && !empty($productData['Product']['assembly_instruction_file'])) {
                                            ?>
                                            <a href="<?php echo $this->webroot . 'files/uploads/' . $productData['Product']['assembly_instruction_file'] ?>" target="_blank">
                                                <?php
                                                echo $this->Html->image('pdf_icon.png', array('width' => 60, 'height' => 60));
                                                ?>
                                            </a>  

                                            <?
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Special Instruction</label>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('special_instruction', array(
                                                'class' => 'form-control',
                                                'label' => false,
                                            ));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label">Special Instruction File</label>
                                        <div class="col-sm-5">
                                            <?php
                                            echo $this->Form->input('special_instruction_file', array(
                                                'class' => 'btn btn-default',
                                                'type' => 'file',
                                                'label' => false,
                                                'multiple' => 'multiple',
                                                'data-validation' => 'required extension',
                                                'data-validation-allowing' => 'pdf',
                                                'data-validation' => 'mime size',
                                                'data-validation-max-size' => '2M',
                                            ));
                                            ?>
                                        </div>
                                        <div class="col-sm-5">
                                            <?php
                                            if (isset($productData['Product']['special_instruction_file']) && !empty($productData['Product']['special_instruction_file'])) {
                                                ?>
                                                <a href="<?php echo $this->webroot . 'files/uploads/' . $productData['Product']['special_instruction_file'] ?>" target="_blank">
                                                    <?php
                                                    echo $this->Html->image('pdf_icon.png', array('width' => 60, 'height' => 60));
                                                    ?>
                                                </a>  

                                                <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <?php
                                        echo $this->Form->submit('Save', array(
                                            'class' => 'btn btn-info pull-right',
                                            'value' => 'Validate',
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
                            <div class="tab-pane" id="tab_3">

                                <!-- Horizontal Form -->
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Upload Images</h3>
                                    </div>
                                    <b>How to use:</b>
                                    <p>First image will be cover image, you can drag/move any image  to make it first.</p>
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
                                            <!--                                    <label class="col-md-3 control-label"></label>-->
                                            <div class="col-sm-12">
                                                <div id="progressBlock" style="	opacity: 0">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-info progress-bar-striped">0%</div>
                                                    </div>
                                                    <div id="status"></div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <!--<label class="col-md-3 control-label"><h4>Upload Images</h4></label>-->
                                            <div class="col-sm-12">
                                                <div id="images">
                                                    <ul id="sortable">
                                                        <?php
                                                        if (isset($product_image[0])) {
                                                            foreach ($product_image as $image) {
                                                                ?>
                                                                <li id="item_<?php echo $image['ProductImage']['id']; ?>">
                                                                    <div class="card_image">
                                                                        <div class="x_img_outer">
                                                                            <div class="x_img" style="" onclick="delImage('<?php echo $image['ProductImage']['id']; ?>')"></div>
                                                                        </div>
                                                                        <?php echo $this->Image->resize('admin_uploads/' . $image['ProductImage']['product_image'], 150, 100); ?>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <div style="clear:both"></div>
                                                <!--                                        <div onclick="$('#newImage').click();"  class="goyal btn btn-success btn-md btn-block">Upload Images</div>-->

                                            </div>

                                        </div> 


                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <div onclick="$('#newImage').click();"  class="btn btn-info pull-right">Upload Images</div>
                                        <?php
//                                echo $this->Form->submit('Update', array(
//                                    'class' => 'btn btn-info pull-right',
//                                ));
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
                            <div class="tab-pane" id="tab_4">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Manage Product Parts</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <div class="row">
                                        <?php
                                        echo $this->Form->create('ProductParts', array(
                                            'role' => 'form',
                                            'div' => false,
                                            'class' => 'form-horizontal',
                                            'url' => array('admin' => true, 'controller' => 'products', 'action' => 'add_product_parts')
                                        ));
                                        ?>
                                        <div class="col-xs-4">

                                            <?php
                                            echo $this->Form->input('product_id', array('value' => $productId, 'hidden', 'label' => false, 'type' => 'text'));
                                            echo $this->Form->input('id', array('value' => '', 'hidden', 'label' => false));

                                            echo $this->Form->input('part_title', array(
                                                'label' => false,
                                                'class' => 'form-control',
                                                'type' => 'text',
                                                'placeholder' => 'Part Title',
                                                'data-validation' => 'required',
                                            ));
                                            ?>

                                        </div>
                                        <div class="col-xs-4">

                                            <?php
                                            echo $this->Form->input('part_type', array(
                                                'label' => false,
                                                'class' => 'form-control',
                                                'placeholder' => 'Part Type',
                                                'data-validation' => 'required',
                                            ));
                                            ?>

                                        </div>
                                        <div class="col-xs-2">

                                            <?php
                                            echo $this->Form->input('part_qty', array(
                                                'label' => false,
                                                'class' => 'form-control',
                                                'type' => 'text',
                                                'placeholder' => 'Quantity',
                                                'data-validation' => "required number",
                                                'data-validation-error-msg-required' => "This field is required",
                                                'data-validation-error-msg-number' => "It must be a number"
                                            ));
                                            ?>

                                        </div>
                                        <div class="col-xs-2">

                                            <?php
                                            echo $this->Form->submit('Update', array(
                                                'label' => false,
                                                'class' => 'btn bg-orange btn-flat',
                                                'value' => 'Validate',
                                            ));
                                            ?>

                                        </div>
                                        <?php
                                        echo $this->Form->end();
                                        ?>
                                    </div>

                                    <!-- /.box-body -->

                                    <hr>
                                    <!-- /.box-header -->
                                    <div>
                                        <table class="table table-bordered fixed-table">
                                            <tbody>
                                            <col width="10px" />
                                            <col width="35px" />
                                            <col width="35px" />
                                            <col width="10px" />
                                            <col width="10px" />
                                            <tr>
                                                <th>Sn.</th>
                                                <th>Part Title</th>
                                                <th>Part Type</th>
                                                <th>Quantity</th>
                                                <th></th>
                                            </tr>
                                            <?php
                                            $i = 1;

                                            foreach ($productData['ProductPart'] as $productParts) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td ><?php echo $productParts['part_title']; ?></td>
                                                    <td><?php echo $productParts['part_type']; ?></td>
                                                    <td><?php echo $productParts['part_qty']; ?></td>
                                                    <td>
                                                        <div style="padding: 5px; float: left;">
                                                            <a onclick="fillPartsData(<?php echo $productParts['id']; ?>)"><i class="fa fa-pencil fa-lg"></i></a>    
                                                        </div>
                                                        <div style="padding: 5px; float: left;">
                                                            <a onclick="delete_part(<?php echo $productParts['id']; ?>)"> <i class="fa fa-trash fa-lg"></i></a>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table> 
                                    </div>

                                </div>
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
                        'name' => 'uploadfile[   ]',
                        ' id' => 'newImage',
                        'type' => 'file',
                        'label' => false,
                        'onchange' => "$('#imageTempStep1Form').submit();",
                        'class' => '',
                        'multiple'));
                    ?>
                </label>
                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.row -->
            <!-- END CUSTOM TABS -->
        </section>
        <!-- /.content -->

        <script>
            $.validate({
                modules: 'file',
            });
        </script>
        <script>
            jQuery(document).ready(function($) {
                var pheight = $('#ProductHeight').val();
                var pwidth = $('#ProductWidth').val();
                var plength = $('#ProductLength').val();
                var pcbm = pheight * pwidth * plength;
                $('#ProductCbm').val(pcbm);
            });
            function newupload() {
                //alert("I am in");
                var bar = $('.progress-bar');
                var percent = $('.progress-bar');
                var status = $('#status');
                var options = {
                    url: '<?php echo $this->Html->url(array("admin" => true, "controller" => "products", "action" => "image_multi_upload")); ?>', data: ({product_id: $('#ProductId').val()}),
                    error: function(data) {
                        // alert(data);
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
                        console.log(response);
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

        //set set preview
            function image_preview(res) {
                $("#busy-indicator").fadeOut();
                var obj = res; //JSON.parse(res);
                x_image_content = '<li id="item_' + obj.img_id + '"><div class="card_image"><div class="x_img_outer"><div class="x_img" style="display:;" onclick="delImage(' + obj.img_id + ')"></div></div><img src="' + obj.img_name + '"/></div></li>';
                $('#sortable').prepend(x_image_content);
                $('#ProductId').val(obj.product_id);
                product_id = obj.product_id;
                newupload();
                coverPhoto();
                sortable_image();
                $('.percent').html('0%');
                $('.bar').width('0%');
            }

            $(function() {
                newupload();
                sortable_image();
            });
            function sortable_image() {
                $("#sortable").sortable({
                    start: function(event, ui) {
                        is_dragging = true;
                    },
                    stop: function(event, ui) {
                        is_dragging = false;
                    },
                    opacity: 0.8,
                    cursor: 'move',
                    update: function() {

                        var order = $(this).sortable("serialize");
                        $.post("<?php echo $this->Html->url(array("admin" => true, "controller" => "products", "action" => "updateorder")); ?>", order, function(theResponse) {
                            coverPhoto();
                        });
                    }
                });
            }
            ;
            function delImage(Photo_id) {
                bootbox.confirm('Are you sure you want to delete this image?', function(r) {
                    if (r == true) {
                        URL = '<?php echo $this->Html->url(array('admin' => true, "controller" => "products", "action" => "deletePhoto")); ?>';
                        //    alert(Photo_id);
                        $.ajax({
                            url: URL,
                            method: 'POST',
                            data: ({Photo_id: Photo_id}),
                            success: function(data) {
                                // console.log(data);
                                $("#item_" + Photo_id).remove();
                                sortable_image();
                            }
                        });
                    }
                });
            }
            ;
            var cover_photo = '<div class="cover_photo" title="To change cover photo drag desire image at first position.">First Photo</div>';
            function coverPhoto() {
                $(".cover_photo").remove();
                $("#sortable li:eq(0)").append(cover_photo);
            }

            function delete_part(Part_id) {
                bootbox.confirm('Are you sure you want to delete?', function(r) {
                    if (r == true) {
                        URL = '<?php echo $this->Html->url(array('admin' => true, "controller" => "products", "action" => "product_part_delete")); ?>';
                        //    alert(Photo_id);
                        $.ajax({
                            url: URL,
                            method: 'POST',
                            data: ({Part_id: Part_id}),
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                });
            }

            function fillPartsData(partId) {
                var url = '<?php echo $this->Html->url(array('controller' => 'products', 'action' => 'get_parts_data')); ?>';
        $.ajax({
            type: 'POST',
            url: url,
            data: ({partId: partId}),
            beforeSend: function(XMLHttpRequest) {
                $.blockUI.defaults.overlayCSS.opacity = .2;
                $('.box-body').block({
                    message: '<h3>Processing...</h3>',
                    css: {border: '3px solid #fff'}
                });
            },
            success: function(opt) {
                $('.box-body').unblock();
                myResult = JSON.parse(opt);
                //    console.log(myResult.ProductPart.part_title);
                $('#ProductPartsId').val(myResult.ProductPart.id);
                $('#ProductPartsId').val(myResult.ProductPart.id);
                $('#ProductPartsPartTitle').val(myResult.ProductPart.part_title);
                $('#ProductPartsPartType').val(myResult.ProductPart.part_type);
                $('#ProductPartsPartQty').val(myResult.ProductPart.part_qty);
            },
        });
    }


</script>



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
        <li class="active">Add</li>
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
                    <li class="active"><a href="#tab_1" data-toggle="tab">Basic Information (1)</a></li>
                    <li><a href="#" >Basic Information (2)</a></li>
                    <li><a href="#" >Product Images (3)</a></li>
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
                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Net Size</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('net_size', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                            'placeholder' => 'Only Number allowed',
                                            'required' => true
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

                                <div class="form-group">
                                    <label  class="col-sm-2 control-label">Keywords</label>
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('keywords', array(
                                            'label' => false,
                                            'class' => 'form-control',
                                            'placeholder' => "Keywords if any for SEO purpose."
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
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->


    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->
</section>
<!-- /.content -->

ss
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
                    <li class="active"><a href="#tab_1" data-toggle="tab">Part 1</a></li>
                    <?php
                    if (isset($productId) && !empty($productId)) {
                        ?>
                        <li><a href="#tab_2" data-toggle="tab">Part 2</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="#" >Part 2</a></li>
                        <?php
                    }
                    ?>
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
                                'class' => 'form-horizontal',
                                'url' => array('action' => 'add')));
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
                                <!--                                    <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"> Remember me
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!--                                    <button type="submit" class="btn btn-default">Cancel</button>-->
                                <?php
                                echo $this->Form->submit('Save', array(
                                    'class' => 'btn btn-info pull-right',
                                ));
                                ?>
                                <!--<button type="submit" class="btn btn-info pull-right">Save</button>-->
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
                            <!-- /.box-header -->
                            <!-- form start -->
                            <?php
                            echo $this->Form->create('Product', array(
                                'role' => 'form',
                                'div' => false,
                                'class' => 'form-horizontal',
                                'url' => array('admin' => true, 'action' => 'add')));
                            echo $this->Form->input('id', array('value' => $productId, 'hidden'))
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
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('assembly_instruction_file', array(
                                            'class' => 'form-control',
                                            'div' => false,
                                            'label' => false
                                        ));
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
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('width', array(
                                            'class' => 'form-control',
                                            'label' => false,
                                        ));
                                        ?>
                                    </div>
                                </div>
                             
                                <!--                                    <div class="form-group">
                                                                        <div class="col-sm-offset-2 col-sm-10">
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"> Remember me
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!--                                    <button type="submit" class="btn btn-default">Cancel</button>-->
                                <?php
                                echo $this->Form->submit('Save', array(
                                    'class' => 'btn btn-info pull-right',
                                ));
                                ?>
                                <!--<button type="submit" class="btn btn-info pull-right">Save</button>-->
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
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
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
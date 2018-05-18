<section class="content-header">
    <h1>
        Suppliers
        <small><!--Preview of UI elements --></small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>">
                <i class="fa fa-dashboard"></i>Home</a>
        </li>
        <li>
            <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'buyers', 'action' => 'index')); ?>">Client Master</a>
        </li>
        <li class="active">Add</li>
    </ol>
</section>
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Supplier</h3>
        </div>

        <div class="box-body">
            <div class="form-horizontal" >
                <?php
                echo $this->Form->create('Supplier', array(
                    "role" => "form",
                ));
                ?>  
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-7">
                        <?php
                        echo $this->Form->input('name', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Name',
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Contact</label>
                    <div class="col-sm-7">
                        <?php
                        echo $this->Form->input('contact', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Contact',
                            'required' => true,
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-7">
                        <?php
                        echo $this->Form->input('email', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Email address',
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-7">
                        <?php
                        echo $this->Form->input('address', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Address',
                        ));
                        ?>
                    </div>
                </div>



                <div class="box-footer">
                    <?php
                    echo $this->Form->button(__('Save'), array(
                        'class' => 'btn btn-info pull-right',
                        'type' => 'submit'
                    ));

                    echo $this->Form->button(__('Cancel'), array(
                        'class' => 'btn btn-default',
                        'type' => 'button',
                        'onclick' => 'goBack()',
                    ));
                    ?>

                </div>


                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>

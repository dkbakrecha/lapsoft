<section class="content-header">
    <h1>
        Buyers
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
            <h3 class="box-title">Edit Buyer Information</h3>
        </div>

        <div class="box-body">
            <div class="form-horizontal" >
                <?php
                echo $this->Form->create('Buyer', array("role" => "form"));
                echo $this->Form->hidden('id');
                ?>  
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-7">
                        <?php
                        echo $this->Form->input('name', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Name'
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

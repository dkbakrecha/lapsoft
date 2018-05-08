<div class="warper container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Post
            <a class='btn btn-purple btn-sm pull-right' href='<?php
echo $this->Html->url(array('controller' => 'suppliers', 'action' => 'index',
    'admin' => true));
?>'>Back</a>
        </div>
        <div class="panel-body">
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


                <div class="form-group">
                    <div class="col-md-2 col-sm-4 col-xs-12 control-label">
                        <span></span>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <?=
                        $this->Form->button(__('Save'), array(
                        'class' => 'btn btn-primary btn-flat',
                        'type' => 'submit'
                        ));
                        ?>
                        &nbsp;
                        <?=
                        $this->Form->button(__('Cancel'), array(
                        'class' => 'btn btn-default btn-flat',
                        'type' => 'button',
                        'onclick' => 'goBack()',
                        ));
                        ?>
                    </div>
                </div>


                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>

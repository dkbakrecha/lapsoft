<div class="warper container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Post
            <a class='btn btn-purple btn-sm pull-right' href='<?php
echo $this->Html->url(array('controller' => 'purchase_orders', 'action' => 'index',
    'admin' => true));
?>'>Back</a>
        </div>
        <div class="panel-body">
            <div class="form-horizontal" >
                <?php 
                echo $this->Form->create('PurchaseOrder', array("role" => "form")); 
                    ?>  
                <div class="form-group">
                    <label class="col-sm-2 control-label">Order ID</label>
                    <div class="col-sm-3">
                        <?php
                        echo $this->Form->input('po_id', array(
                            'type' => 'textbox',
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Order Number'
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Order Date</label>
                    <div class="col-sm-3">
                        <?php
                        echo $this->Form->input('create_date', array(
                            'type' => 'textbox',
                            'class' => 'form-control calendar',
                            'label' => false,
                            'placeholder' => 'Order Date'
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Delivery Date</label>
                    <div class="col-sm-3">
                        <?php
                        echo $this->Form->input('delivery_date', array(
                            'type' => 'textbox',
                            'class' => 'form-control calendar',
                            'label' => false,
                            'placeholder' => 'Delivery Date',
                        ));
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Buyer</label>
                    <div class="col-sm-3">
                        <?php
                        echo $this->Form->input('buyer_id', array(
                            'class' => 'form-control',
                            'label' => false,
                            'placeholder' => 'Buyers',
                            'options' => $buyerList
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
                        $this->Form->button(__('Create'), array(
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
</div>

<script>
    $('.calendar').datepicker({
        setDate: new Date(),
        autoclose: true
    });
</script>
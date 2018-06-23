<style>
    .ui-autocomplete {
        z-index: 100;
    }

    .ui-autocomplete {
        position: absolute;
        z-index: 1000;
        cursor: default;
        padding: 0;
        margin-top: 2px;
        list-style: none;
        background-color: #ffffff;
        border: 1px solid #ccc
            -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .ui-autocomplete > li {
        padding: 3px 20px;
    }
    .ui-autocomplete > li.ui-state-focus {
        background-color: #DDD;
    }
    .ui-helper-hidden-accessible {
        display: none;
    }
</style>
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
                    <div class="row">
                        <div class="col-lg-6">

                            <label class="col-sm-3 control-label">Buyer</label>
                            <div class="col-sm-7">
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
                        <div class="col-lg-6">
                            <label class="col-sm-4 control-label">Order Date</label>
                            <div class="col-sm-7">
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
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="col-sm-3 control-label">Order ID</label>
                            <div class="col-sm-7">
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
                        <div class="col-lg-6">
                            <label class="col-sm-4 control-label">Delivery Date</label>
                            <div class="col-sm-7">
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
                    </div>

                </div>


                <div class="row " id="poProducts">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="tab_logic">
                            <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> Product </th>
                                    <th class="text-center"> Qty </th>
                                    <th class="text-center"> Price </th>
                                    <th class="text-center"> Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id='addr0'>
                                    <td>1</td>
                                    <td><input id="autoComplete" type="text" name='product[]'  placeholder='Enter Product Name' class="form-control product_name autocomplete"/></td>
                                    <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                    <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                    <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                </tr>
                                <tr id='addr1'></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <button id="add_row" class="btn btn-default pull-left">Add Row</button>
                        <button id='delete_row' class="pull-right btn btn-default">Delete Row</button>
                    </div>
                </div>
                <div class="row clearfix" style="margin-top:20px">
                    <div class="pull-right col-md-4">
                        <table class="table table-bordered table-hover" id="tab_logic_total">
                            <tbody>
                                <tr>
                                    <th class="text-center">Sub Total</th>
                                    <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Tax</th>
                                    <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                            <input type="number" class="form-control" id="tax" placeholder="0">
                                            <div class="input-group-addon">%</div>
                                        </div></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Tax Amount</th>
                                    <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
                                </tr>
                                <tr>
                                    <th class="text-center">Grand Total</th>
                                    <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-2 col-sm-4 col-xs-12 control-label">
                        <span></span>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <?php
                        echo $this->Form->button(__('Create'), array(
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
        autoclose: true,
        dateFormat: "yyyy-mm-dd"
    });


    $(document).ready(function () {
        var i = 1;
        $("#add_row").click(function (e) {
            e.preventDefault();
            b = i - 1;
            $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
            $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
            i++;
        });
        $("#delete_row").click(function (e) {
            e.preventDefault();
            if (i > 1) {
                $("#addr" + (i - 1)).html('');
                i--;
            }
            calc();
        });

        $('#tab_logic tbody').on('keyup change', function () {
            calc();
        });
        $('#tax').on('keyup change', function () {
            calc_total();
        });


    });

    function calc()
    {
        $('#tab_logic tbody tr').each(function (i, element) {
            var html = $(this).html();
            if (html != '')
            {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                $(this).find('.total').val(qty * price);

                calc_total();
            }
        });
    }

    function calc_total()
    {
        total = 0;
        $('.total').each(function () {
            total += parseInt($(this).val());
        });
        $('#sub_total').val(total.toFixed(2));
        tax_sum = total / 100 * $('#tax').val();
        $('#tax_amount').val(tax_sum.toFixed(2));
        $('#total_amount').val((tax_sum + total).toFixed(2));
    }

    (function ($) {
        $('#autoComplete').autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'products', 'action' => 'productlist', 'admin' => true), true) ?>"
        });
    })(jQuery);

    //Edit Product model
    /*        $("#poProducts").on("change", ".product_name", function () {
     var _qId = $(this).data('question');
     
     $.ajax({
     url: '<?php //echo $this->Html->url(array("controller" => "practices", "action" => "add_question", "admin" => true));       ?>',
     type: "POST",
     data: {_question_id: _qId},
     success: function (data) {
     $("#siteModal").html(data);
     $("#siteModal").modal('show');
     },
     error: function (xhr) {
     //ajaxErrorCallback(xhr);
     }
     });
     });*/
</script>
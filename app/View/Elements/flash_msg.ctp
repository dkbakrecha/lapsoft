<?php
$fdata = $this->Session->read('Message');
//pr($fdata);
if (isset($fdata['flash']) && !empty($fdata['flash'])) {
    if ($fdata['flash']['params']['id'] == 'success') {
        $mc = 'alert-success';
        $icon = 'fa fa-check';
    } elseif ($fdata['flash']['params']['id'] == 'danger') {
        $mc = 'alert-danger';
        $icon = 'fa fa-times';
    } elseif ($fdata['flash']['params']['id'] == 'info') {
        $mc = 'alert-info';
        $icon = 'fa fa-info-circle';
    } elseif ($fdata['flash']['params']['id'] == 'warning') {
        $mc = 'alert-warning';
        $icon = 'fa fa-warning';
    }
    ?>

    <div class="box-body">
        <div class="alert <?php echo $mc; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <!--            <h4><i class="icon fa fa-ban"></i> Alert!</h4>-->
            <div class="update-text"><?php echo $this->Session->flash(); ?></div>
        </div>
    </div>

    <!--  
    Need to removed if not useful...
    <div class=" ">
            <div class="col-md-12  ">
                <div class="update-nag">
                    <div class="update-close">X</div>
                    <div class="update-split <?php //echo $mc;   ?>"><i class="<?php //echo $icon ;  ?>"></i></div>
                    <div class="update-text"><?php //echo $this->Session->flash();   ?></div>
                </div>
            </div>
        </div>
    Ends here
    -->

<?php } ?>
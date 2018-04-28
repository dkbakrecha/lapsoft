<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version());

$websiteTitle = ('Lariya Art Palace');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <?php //echo $this->Html->charset(); ?>
        <title>
            <?php echo $websiteTitle ?> :
            <?php echo $title_for_layout; ?>
        </title>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->        
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array(
            '/bower_components/bootstrap/dist/css/bootstrap.min.css', // Bootstrap 3.3.7
            '/bower_components/font-awesome/css/font-awesome.min.css', //Font Awesome
            '/bower_components/Ionicons/css/ionicons.min.css', //Ionicons
            'webcss/css/AdminLTE.min.css', // Theme styles
            'webcss/css/skins/_all-skins.min.css',
            '/bower_components/morris.js/morris.css', //Morris chart
            '/bower_components/jvectormap/jquery-jvectormap.css', //jvectormap 
            '/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', //Date Pickers
            '/bower_components/bootstrap-daterangepicker/daterangepicker.css', //Daterange picker
            '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css', //bootstrap wysihtml5 - text editor
        ));
        echo $this->fetch('meta');
        ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php echo $this->Element('header') ?>
            <?php echo $this->Element('main_slider') ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php echo $this->Element('flash_msg'); ?>
                <?php echo $this->fetch('content'); ?>
                <?php // echo $this->Element('main_container') ?>
            </div>
            <
            <?php echo $this->Element('footer') ?>
            <?php echo $this->Element('control_slider') ?>

        </div>
        <?php //echo $this->element('sql_dump');  ?>

        <?php
        echo $this->Html->script(array(
            '/bower_components/jquery/dist/jquery.min.js', // jQuery 3
            '/bower_components/jquery-ui/jquery-ui.min.js', // jQuery UI 1.11.4
            '/bower_components/bootstrap/dist/js/bootstrap.min.js', // Bootstrap 3.3.7
            '/bower_components/raphael/raphael.min.js', //Morris.js charts
            '/bower_components/morris.js/morris.min.js', //Morris.js charts
            '/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js', //Sparkline
            '/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', //jvectormap
            '/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', //jvectormap
            '/bower_components/jquery-knob/dist/jquery.knob.min.js', //jQuery Knob Chart
            '/bower_components/moment/min/moment.min.js', //daterangepicker
            '/bower_components/bootstrap-daterangepicker/daterangepicker.js', //daterangepicker
            '/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', //datepicker
            '/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', //Bootstrap WYSIHTML5
            '/bower_components/jquery-slimscroll/jquery.slimscroll.min.js', //Slimscroll
            '/bower_components/fastclick/lib/fastclick.js', //FastClick
            'webjs/js/adminlte.min.js', //AdminLTE App
            'webjs/js/pages/dashboard.js', //AdminLTE dashboard demo (This is only for demo purposes)
            'webjs/js/demo.js', //AdminLTE for demo purposes
        ));
        ?>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
    </body>
</html>

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
            '/plugins/iCheck/square/blue.css', //bootstrap wysihtml5 - text editor
        ));
        echo $this->fetch('meta');
        ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <?php $this->Element('flash_msg'); ?>
            <?php echo $this->fetch('content'); ?>

        </div>
        <?php
        echo $this->Html->script(array(
            '/bower_components/jquery/dist/jquery.min.js', // jQuery 3
            '/bower_components/bootstrap/dist/js/bootstrap.min.js', // Bootstrap 3.3.7
            '/plugins/iCheck/icheck.min.js', //Morris.js charts
        ));
        ?>

        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' /* optional */
                });
            });
        </script>
    </body>
</html>

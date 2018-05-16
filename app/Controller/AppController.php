<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeTime', 'Utility');
//App::uses('CakeNumber', 'Utility');
App::uses('Sanitize', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Auth',
        'Session',
        'Cookie',
        'RequestHandler',
    );
    public $helpers = array(
        'Html',
        'Form',
        'Js',
        'Image',
        'Session',
        'Text',
        'Time',
            //'General'
    );

    public function beforeFilter() {
        parent::beforeFilter();
        // prd($this->request);

        AuthComponent::$sessionKey = 'Auth.User';
        $this->Auth->loginAction = array('admin' => FALSE, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('admin' => FALSE, 'controller' => 'users', 'action' => 'dashboard');
        $this->Auth->logoutRedirect = array('admin' => FALSE, 'controller' => 'users', 'action' => 'login');


        $controller = $this->params['controller'];
        $action = $this->params['action'];
        $this->set("controller", $controller);
        $this->set("action", $action);

        if (isset($this->request->params['admin'])) {
            // to check session key if we not define this here then is will check with 'Auth.User' so dont remove it
            AuthComponent::$sessionKey = 'Auth.Admin';

            $this->Auth->loginAction = array('admin' => TRUE, 'controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('admin' => TRUE, 'controller' => 'users', 'action' => 'dashboard');
            $this->Auth->logoutRedirect = array('admin' => TRUE, 'controller' => 'users', 'action' => 'login');
            //$this->Auth->authError = "You can't access the page";
            //$this->Auth->authorize = array('controller');
        }
    }

    public function isAuthorized() {
        return true;
    }

    public function fileUpload($file_info, $allowedExt, $fileSavePath, $Size) {
        /*
         * Function for file upload
         * supply all four parameters $file_info , $allowedExt, $fileSavePath, $size
         * used in Pages controller eshop_support()
         */

        if (isset($file_info) && !empty($file_info)) {
            $fileSize = $file_info['size'];
            if ($fileSize > $Size) {
                echo "<script>"
                . "alert('File size more then 1mb.');"
                . "</script>";
                return false;
            } else {
                if (!empty($file_info['name'])) {
                    $ext = $this->get_extension($file_info['name']);
                    if (in_array($ext, $allowedExt)) {
                        $newFileName = date("mY") . "_" . rand(1000, 9999) . '.' . $ext;
                        $destination = $fileSavePath . $newFileName;
                        $moved = move_uploaded_file($file_info['tmp_name'], $destination);
                        if ($moved) {
                            Configure::write('newFileName', $newFileName);
                            return true;
                            // prd('File moved');
                        } else {
                            return false;
                            // prd('File not moved.');
                        }
                    } else {
                        echo "<script>alert('This file type not allowed.');</script>";
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function new_image_compress($file, $destination, $quality, $w, $h, $crop = FALSE) {

        //file = source file location path
        //destination = saving location
        //quailty = compressation level

        $info = getimagesize($file);
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        // Resample
        $image_p = imagecreatetruecolor($newwidth, $newheight);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($file);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($file);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($file);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        // Output
        imagejpeg($image_p, $destination, $quality);
        return $destination;
    }

    protected function resize_url($path, $width, $height, $aspect = true, $htmlAttributes = array(), $return = false) {

        $types = array(1 => "gif", "jpeg", "png", "swf", "psd", "wbmp"); // used to determine image type
        if (empty($htmlAttributes['alt']))
            $htmlAttributes['alt'] = 'thumb';  // Ponemos alt default

        $uploadsDir = 'img';

        $fullpath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . $uploadsDir . DS;

        //$tempPath=realpath(dirname(dirname(dirname(__FILE__)))).'/webroot/img/';
        $tempPath = $uploadsDir . '/';

        if (file_exists($tempPath . $path) and $path != 'admin_uploads/')
            $url = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . IMAGES_URL . $path;
        else
            $url = $tempPath . "no_image.png";

        if (!($size = getimagesize($url)))
            return; // image doesn't exist

        if ($aspect) { // adjust to aspect.
            if ($height == 0) {
                $height = ceil($width / ($size[0] / $size[1]));
            } else if ($width == 0) {
                $width = ceil(($size[0] / $size[1]) * $height);
            } else if (($size[1] / $height) > ($size[0] / $width))  // $size[0]:width, [1]:height, [2]:type
                $width = ceil(($size[0] / $size[1]) * $height);
            else
                $height = ceil($width / ($size[0] / $size[1]));
        }

        $relfile = $this->webroot . $uploadsDir . '/resized/' . $width . 'x' . $height . '_' . basename($path); // relative file
        $cachefile = $fullpath . 'resized' . DS . $width . 'x' . $height . '_' . basename($path);  // location on server

        if (file_exists($cachefile)) {
            $csize = getimagesize($cachefile);
            $cached = ($csize[0] == $width && $csize[1] == $height); // image is cached
            if (@filemtime($cachefile) < @filemtime($url)) // check if up to date
                $cached = false;
        } else {
            $cached = false;
        }

        if (!$cached) {
            $resize = ($size[0] > $width || $size[1] > $height) || ($size[0] < $width || $size[1] < $height);
        } else {
            $resize = false;
        }

        if ($resize) {
            $image = call_user_func('imagecreatefrom' . $types[$size[2]], $url);
            if (function_exists("imagecreatetruecolor") && ($temp = imagecreatetruecolor($width, $height))) {
                imagealphablending($temp, false);
                imagesavealpha($temp, true);
                $transparent = imagecolorallocatealpha($temp, 255, 255, 255, 127);
                imagefilledrectangle($temp, 0, 0, $width, $height, $transparent);
                imagecopyresampled($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
            } else {

                $temp = imagecreate($width, $height);

                imagealphablending($temp, false);
                imagesavealpha($temp, true);
                $transparent = imagecolorallocatealpha($temp, 255, 255, 255, 127);
                imagefilledrectangle($temp, 0, 0, $width, $height, $transparent);

                imagecopyresized($temp, $image, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
            }
            call_user_func("image" . $types[$size[2]], $temp, $cachefile);
            imagedestroy($image);
            imagedestroy($temp);
        } else {
            if (!$cached) {
                return ($path);
            }
        }

        return $relfile;
        return $this->output(sprintf($this->Html->_tags['image'], $relfile, $this->Html->_parseAttributes($htmlAttributes, null, '', ' ')), $return);
    }

    public function get_extension($file_name) {
        $ext = explode('.', $file_name);
        $ext = array_pop($ext);
        return strtolower($ext);
    }

    public function flash_msg($msg, $flag = 1) {
        if ($flag == 1) {
            $this->Session->setFlash($msg, 'default', array('id' => 'success'));
        } elseif ($flag == 2) {
            $this->Session->setFlash($msg, 'default', array('id' => 'danger'));
        } elseif ($flag == 3) {
            $this->Session->setFlash($msg, 'default', array('id' => 'info'));
        } elseif ($flag == 4) {
            $this->Session->setFlash($msg, 'default', array('id' => 'warning'));
        }
    }

}

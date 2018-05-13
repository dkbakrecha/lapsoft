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
        // 'Image',
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

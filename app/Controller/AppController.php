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
        'Session',
        'Auth',
    );

    public function beforeFilter() {
        parent::beforeFilter();
         // prd($this->request);
        if (isset($this->request->params['admin'])) {
            // to check session key if we not define this here then is will check with 'Auth.User' so dont remove it
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->loginAction = array('admin' => true, 'controller' => 'users', 'action' => 'admin_login');
            $this->Auth->loginRedirect = array('admin' => true, 'controller' => 'users', 'action' => 'admin_dashboard');
            $this->Auth->logoutRedirect = array('admin' => true, 'controller' => 'users', 'action' => 'admin_login');
        }
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

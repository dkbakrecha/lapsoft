<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('admin_login', 'register', 'add');
    }

    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            // prd($this->request->data);
            $this->request->data['User']['role'] = 'member';
            // exit;
            if ($this->User->save($this->request->data)) {
                $this->flash_msg("The user has been saved", 1);
                $this->redirect(array('action' => 'register'));
                // return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(
                    __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function index() {
        
    }

    public function view() {
        
    }

    public function login() {
        $this->layout = 'login';
        $this->set('title_for_layout', 'Admin');
        $user = $this->Session->read('Auth.Admin');
        //prd($this->request);
        if (isset($user['id']) && !empty($user['id'])) {
            $this->redirect($this->Auth->loginRedirect);
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->loginRedirect);
            } else {
                $this->Session->setFlash(__('Incorrect Username or Password'));
            }
        }
    }

    public function admin_dashboard() {
        
    }

    public function admin_index() {
        $this->set('title_for_layout', 'Lariya Art Palace - Admin Panel');
        

        //prd($totData);
    }

    public function admin_login() {
        $this->layout = 'login';
        $this->set('title_for_layout', 'Admin');
        $user = $this->Session->read('Auth.Admin');
        
        $ddd = AuthComponent::password("123456");
        
        //prd($ddd);
        if (isset($user['id']) && !empty($user['id'])) {
            $this->redirect($this->Auth->loginRedirect);
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->loginRedirect);
            } else {
                $this->Session->setFlash(__('Incorrect Username or Password'));
            }
        }
    }

    function admin_logout() {
        $this->Session->delete('Auth.Admin');
        $this->redirect(array('controller' => 'Users', 'action' => 'admin_login', 'admin' => true));
    }

    public function admin_settings() {
        $this->loadModel('Sitesetting');
        //prd($this->request);
        if (!empty($this->request->data)) {
            if ($this->Sitesetting->saveAll($this->request->data['Sitesetting'])) {
                $this->flash_msg(1, 'Websetting have been edited.');

                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            } else {
                $this->flash_msg(2, 'Websetting could not be edited. Please, try again.');
            }
        }

        $allSettings = $this->Sitesetting->find('all', array(
            'conditions' => array('Sitesetting.status' => 1)
                ));
        $this->set('allSettings', $allSettings);
        //prd($allSettings);
    }

    public function admin_slider() {
        $this->loadModel('HomeSlider');
        $this->set('title_for_layout', 'Home Slider');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (isset($data['imageTemp']['uploadfile']) && !empty($data['imageTemp']['uploadfile'])) {
                $file = $data['imageTemp']['uploadfile'];
                if (!empty($file['name'])) {
                    $ext = $this->get_extension($file['name']);
                    $file_extension = array('png', 'gif', 'jpeg', 'jpg', 'bmp');

                    if (in_array($ext, $file_extension)) {
                        $newFileName = "Home_" . uniqid() . '.' . $ext;
                        $destination = 'img/Home_files/' . $newFileName;
                        $moved = move_uploaded_file($file['tmp_name'], $destination);
                        if ($moved) {

                            $saveImgData['HomeSlider']['image'] = $newFileName;
                            $this->HomeSlider->save($saveImgData);
                        }
                    }
                }
            }
        }

        $gData = $this->HomeSlider->find('all', array('conditions' => array('HomeSlider.status' => 1)));
        $this->request->data = $gData;
    }

    public function admin_makeMainbg($imgid) {
        if (!empty($imgid)) {
            $this->loadModel('HomeSlider');
            $this->HomeSlider->updateAll(
                    array('HomeSlider.is_main' => 0), array('1')
            );
            $this->HomeSlider->updateAll(
                    array('HomeSlider.is_main' => 1), array('HomeSlider.id' => $imgid)
            );
            $this->redirect(array('action' => 'admin_slider'));
        } else {
            
        }
    }

    public function admin_deleteSlideImage($imgid) {
        if (!empty($imgid)) {
            $this->loadModel('HomeSlider');
            $data = array();
            $data['HomeSlider']['status'] = 2;
            $data['HomeSlider']['id'] = $imgid;
            $this->HomeSlider->save($data);
            $this->redirect(array('action' => 'admin_slider'));
        } else {
            
        }
    }

    public function admin_profile() {
        $this->set('title_for_layout', 'Edit Profile');
        $request = $this->request;

        $currUserId = $this->Session->read('Auth.Admin.id');
        $currUserRecord = $this->User->findById($currUserId);

        if (($request->isPost() || $request->isPut())) {
            $data = $request['data'];
            $data['User']['id'] = $currUserRecord['User']['id'];

            if (!isset($data['User']['password']) || empty($data['User']['password'])) {
                unset($data['User']['password']);
                unset($data['User']['confirm_password']);
            }

            if ($this->User->save($data)) {

                $this->flash_msg(1, "User profile changed successfully.");
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        }

        if (isset($currUserRecord) && !empty($currUserRecord)) {
            $this->request->data = $currUserRecord;
        } else {
            $this->Session->setFlash(__("Invalid User Request"), 'flash_error');
            $this->redirect(array('controller' => 'index', 'action' => 'index'));
        }
    }

    public function admin_music() {
        $this->loadModel('Sitesetting');

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            //pr($data['Music']['file']);
            //prd($this->request->data);

            if (isset($data['Music']['file']) && !empty($data['Music']['file'])) {
                $file = $data['Music']['file'];
                if (!empty($file['name'])) {
                    $ext = $this->get_extension($file['name']);
                    $file_extension = array('mp3');

                    if (in_array($ext, $file_extension)) {
                        $fname = rand(1000, 9999);
                        $newFileName = $fname . '.' . $ext;
                        $destination = 'files/' . $newFileName;
                        $moved = move_uploaded_file($file['tmp_name'], $destination);
                        if ($moved) {
                            $this->Sitesetting->updateAll(
                                    array('Sitesetting.value' => $fname), array('Sitesetting.key' => 'Site.musicfile')
                            );
                        }
                    }
                }
            }

            $this->Sitesetting->updateAll(
                    array('Sitesetting.value' => $data['Music']['play']), array('Sitesetting.key' => 'Site.play')
            );
        }
    }

    public function get_extension($file_name) {
        $ext = explode('.', $file_name);
        $ext = array_pop($ext);
        return strtolower($ext);
    }

    public function admin_seostatus() {
        
    }

    public function admin_prostatus() {
        
    }

    public function admin_support() {
        
    }

}

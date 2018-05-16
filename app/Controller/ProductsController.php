<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductsController
 *
 * @author Jay Soni
 */
App::uses('AppController', 'Controller');

class ProductsController extends AppController {

    public $uses = array();

    //Admin Add Product 

    public function admin_index() {
        $this->set('title_for_layout', 'All Product');
    }

    public function admin_add() {
        $this->set('title_for_layout', 'Add Product');
        //$this->loadModel("Category");
        $this->loadModel('ProductImage');

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            if ($this->Product->save($data)) {
                $productId = $this->Product->getLastInsertId();
                $productImageData = array();
                $productImageData['ProductImage']['product_id'] = $productId;
                $productImageData['ProductImage']['status'] = 0;
                $this->ProductImage->save($productImageData);
                $this->flash_msg('Part 1 Saved.', 1);
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $productId));
            } else {
                $this->flash_msg(2, 'Data Not Saved');
            }
        }
    }

    public function admin_edit($id = 0) {
        $this->set('title_for_layout', 'Edit Product');


        // Start of checking URL valid accessibility
        if (!is_numeric($id)) {
            $this->flash_msg('Invalid access.', 4);
            $this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
        }

        if (empty($id)) {
            $this->flash_msg('Invalid access.', 4);
            $this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
        }
        // End of checking URL valid accessibility

        $this->loadModel('ProductImage');
        if (!empty($id)) {
            $product_image = $this->ProductImage->find('all', array('conditions' => array('product_id' => $id), 'order' => array('order' => 'asc')));
            $this->set('product_image', $product_image);
        }

        $condition = array();
        $condition['Product.status !='] = 2;
        $condition['Product.id'] = $id;

        $productData = $this->Product->find('first', array(
            'conditions' => array($condition),
        ));
        // prd($productData);
        $postData = $this->request->data;
        if (isset($postData) && !empty($postData)) {
            //prd($postData);

            if (isset($postData['Product']['assembly_instruction_file']['name']) && !empty($postData['Product']['assembly_instruction_file']['name'])) {
                $file_data = $postData['Product']['assembly_instruction_file'];
                $allowedExt = array('pdf');
                $SavePath = FILE_UPLOAD;
                $fileSize = 1048576;  // 1 MB = 1048576 bytes 

                if ($this->fileUpload($file_data, $allowedExt, $SavePath, $fileSize)) {
                    $postData['Product']['assembly_instruction_file'] = Configure::read('newFileName');
                } else {
                    $this->flash_msg('Some error occured while uploading ASSEMBLY INSTRUCTION FILE. Please try again.', 2);
                    $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $id));
                }
            } else {
                $postData['Product']['assembly_instruction_file'] = $productData['Product']['assembly_instruction_file'];
            }

            if (isset($postData['Product']['special_instruction_file']['name']) && !empty($postData['Product']['special_instruction_file']['name'])) {
                $file_data = $postData['Product']['special_instruction_file'];
                $allowedExt = array('pdf');
                $SavePath = FILE_UPLOAD;
                $fileSize = 1048576;  // 1 MB = 1048576 bytes 

                if ($this->fileUpload($file_data, $allowedExt, $SavePath, $fileSize)) {
                    $postData['Product']['special_instruction_file'] = Configure::read('newFileName');
                } else {
                    $this->flash_msg('Some error occured while uploading SPECIAL INSTRUCTION FILE. Please try again.', 2);
                    $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $id));
                }
            } else {
                $postData['Product']['special_instruction_file'] = $productData['Product']['special_instruction_file'];
            }

            // pr($postData);
            if ($this->Product->save($postData)) {
                $this->flash_msg('Information Updated', 1);
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $id));
            }
        }



        // pr($productData);
        $this->request->data = $productData;
    }

    public function admin_image_multi_upload() {
        // prd($this->request->data);
        if (isset($_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'][0])) {
            $product_id = 0;
            if (isset($this->request->data['product_id'])) {
                $product_id = $this->request->data ['product_id'];
            }
            $data = $_FILES;
            $i = -1;
            $responseArray = array();
            $proData = array();

            if (empty($product_id)) {
                unset($product_id);
                $last_url = explode("/", $_SERVER['HTTP_REFERER']);
            } else {
                $lastInsertID = $proData['Product']['id'] = $product_id;
            }

            $proData['Product']['created'] = date('Y-m-d');
            $proSave = $this->Product->save($proData);

            if (isset($proSave['Product']['id'])) {
                $lastInsertID = $proSave['Product']['id'];
            }

            foreach ($data['uploadfile']['name'] as $image) {
                $i++;
                $responseArray[$i]['error'] = 0;
                $ext = $this->get_extension($image);
                $file_extension = array('png', 'gif', 'jpeg', 'jpg');

                if (!in_array($ext, $file_extension)) {
                    $responseArray[$i]['error'] = 1;
                    $responseArray[$i]['error_type'] = 'TYPE_ERROR';
                    continue;
                }

                $size = getimagesize($data['uploadfile']['tmp_name'][$i]);
                if ($size[0] < 190 || $size[1] < 120) {
                    $responseArray[$i]['error'] = 1;
                    $responseArray[$i]['error_type'] = 'SIZE_RATIO_ERROR';
                    continue;
                }

                $imageSize = round($data['uploadfile']['size'][$i] / 1024);  /// IN KB

                $maximumImageSize = 10000;  ////  IN KB  ///// 10 MB

                if ($imageSize > $maximumImageSize) {
                    $responseArray[$i]['error'] = 1;
                    $responseArray[$i]['error_type'] = 'SIZE_ERROR';
                    continue;
                }

                // Image quality compress according to size.
                if ($imageSize <= 1024) {
                    $quality = 90;
                } else {
                    $quality = 80;
                }

                $ext = $this->get_extension($image);
                $file_extension = array('png', 'gif', 'jpeg', 'jpg');

                if (in_array($ext, $file_extension)) {
                    $unique = uniqid();
                    $date = date("YmdHis");
                    $newFileName = $date . '_' . $unique . '.' . $ext;
                    $destination = '';
                    $destination = 'img/admin_uploads/' . $newFileName;

                    $moved = $this->new_image_compress($data['uploadfile']['tmp_name'][$i], $destination, $quality, 1024, 786, Null);

                    //  $moved = $this->image_compress($data['uploadfile']['tmp_name'] [$i], $destination, 50);

                    if ($moved) {
                        $orderValue = 0;
                        $this->loadModel('ProductImage');
                        $maxOrderValue = $this->ProductImage->find('first', array(
                            'conditions' => array('ProductImage.product_id' => $lastInsertID),
                            'fields' => array('MAX(ProductImage.order) as maxnum')
                        ));
                        if (empty($maxOrderValue)) {
                            $orderValue = 1;
                        } else {
                            $orderValue = $maxOrderValue[0]['maxnum'] + 1;
                        }

                        $PhotoData = array();
                        $PhotoData['ProductImage']['product_id'] = $lastInsertID;
                        $PhotoData['ProductImage']['order'] = $orderValue;
                        $PhotoData['ProductImage']['product_image'] = $newFileName;

                        $this->ProductImage->Create();
                        $imageData = $this->ProductImage->save($PhotoData);

                        $imagePath = $this->resize_url("admin_uploads/" . $newFileName, 150, 100);
                        $responseArray[$i]['img_id'] = $imageData['ProductImage']['id'];
                        $responseArray[$i]['img_name'] = $imagePath;
                        $responseArray[$i]['product_id'] = $lastInsertID;
                    }
                }
            }
            //prd($responseArray);
            $respone = json_encode($responseArray);
            echo $respone;
        }
        exit;
    }

    public function admin_deletePhoto() {
        if ($this->request->is('ajax')) {

            $this->loadModel('ProductImage');
            $prdId = $this->request->data['Photo_id'];
            $this->ProductImage->id = $prdId;
            $imageName = $this->ProductImage->find('first', array('conditions' =>
                array('ProductImage.id' => $prdId),
                'fields' => 'ProductImage.product_image'));
          //  prd($imageName);
            if (file_exists(WWW_ROOT . 'img/admin_uploads/' . $imageName['ProductImage']['product_image'])) {
                unlink('img/admin_uploads/' . $imageName['ProductImage']['product_image']);
            }
            if ($this->ProductImage->delete()) {
                echo '1';
            } else {
                echo '0';
            }
            exit;
        } else {
            $this->siteMessage("INVALID_REQUEST_DATA", array("[['data']]" => 'location'));
            $this->redirect(array('eshop' => false, 'controller' => 'products', 'action' => 'add'));
        }
    }

    public function admin_support() {
        $this->set('title_for_layout', 'Support Page');
        $this->loadModel('Support');
        $this->loadModel('EmailContent');
        $data = $this->request->data;
        if (isset($data) && !empty($data)) {
//  prd($data);
            $file_data = $data['Support']['image_name'];
            $allowedExt = array('png', 'gif', 'jpeg', 'jpg', 'bmp');
            $SavePath = FILE_UPLOAD;
            $fileSize = 1048576;  // 1 MB = 1048576 bytes

            if ($this->fileUpload($file_data, $allowedExt, $SavePath, $fileSize)) {
                $fileName = Configure::read('newFileName');
                $data['Support']['user_id'] = $this->eshop_userId;
                $data['Support']['image_name'] = $fileName;
                $data['Support']['status'] = 1;
                //     prd($data);
                if ($this->Support->save($data)) {

                    $name = $this->eshop_userInfo['fname'];
                    $email = $this->eshop_userInfo['email'];
                    $title = $data['Support']['title'];
                    $issueType = $data['Support']['issue_type'];
                    $message = $data['Support']['message'];
                    $link = $data['Support']['link'];
                    $file = $fileName;
                    // Initializing Email Model.
                    $emailObj = new EmailContent;
                    $emailObj->eshopSupportMail($name, $email, $message, $link, $title, $issueType, $file);

                    $this->flash_msg('We will contact you back soon.', 1);
                    $this->redirect(array('eshop' => true, 'controller' => 'pages', 'action' => 'support'));
                } else {
                    $this->flash_msg('Some error, Please try again.', 2);
                    $this->redirect(array('eshop' => true, 'controller' => 'pages', 'action' => 'support'));
                }
            } else {
//pr('Some error occured while File Upload');
//              /  exit;
            }
        }
    }

}

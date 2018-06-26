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
    public $components = array('RequestHandler');

    //Admin Add Product 

    public function admin_index() {
        $this->set('title_for_layout', 'All Product');

        $request = $this->request;

        if ($request->is('ajax')) {
            $this->layout = 'ajax';

            $page = $request->query('draw');
            $limit = $request->query('length');
            $start = $request->query('start');

            //for order
            $colName = $this->request->query['order'][0]['column'];
            $orderby[$this->request->query['columns'][$colName]['name']] = $this->request->query['order'][0]['dir'];
            //prd($this->request);          
            $condition = array();
            $condition ['Product.status !='] = 2;

            foreach ($this->request->query['columns'] as $column) {
                if (isset($column['searchable']) && $column['searchable'] == 'true') {
                    //pr($column);
                    if ($column['name'] == 'User.date_added' && !empty($column['search']['value'])) {
                        $condition['User.date_added LIKE '] = '%' . Sanitize::clean(date('Y-m-d', strtotime($column['search']['value']))) . '%';
                    } elseif (isset($column['name']) && $column['search']['value'] != '') {
                        $condition[$column['name'] . ' LIKE '] = '%' . Sanitize::clean($column['search']['value']) . '%';
                    }
                }
            }

            //prd($condition);
            $total_records = $this->Product->find('count', array('conditions' => $condition));

            $fields = array('Product.id', 'Product.product_code', 'Product.product_title', 'Product.finishing_type', 'Product.image', 'Product.created', 'Product.status');
            $userData = $this->Product->find('all', array(
                'conditions' => $condition,
                'fields' => $fields,
                'order' => $orderby,
                'limit' => $limit,
                'offset' => $start
            ));

            $return_result['draw'] = $page;
            $return_result['recordsTotal'] = $total_records;
            $return_result['recordsFiltered'] = $total_records;


            $return_result['data'] = array();
            if (isset($userData[0])) {
                $i = $start + 1;
                foreach ($userData as $row) {

                    $action = '';
                    $status = '';

                    if ($row['Product']['status'] == 0) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-red" onclick="changeUserStatus(' . $row['Product']['id'] . ',0)" title="Change Status"></i>';
                    } else if ($row['Product']['status'] == 1) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-green" onclick="changeUserStatus(' . $row['Product']['id'] . ',1)" title="Change Status"></i>';
                    } else if ($row['Product']['status'] == 3) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-orange" onclick="changeUserStatus(' . $row['Product']['id'] . ',0)" title="Change Status"></i>';
                    }

                    //$action .= '&nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-eye fa-lg"></i></a> ';
                    // $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'suppliers/view/' . $row['Buyer']['title_slug'] . '" title="View Post" target="_BLANK"><i class="fa fa-eye fa-lg"></i></a> ';
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/products/edit/' . $row['Product']['id'] . '" title="Edit Buyer"><i class="fa fa-pencil fa-lg"></i></a> ';

                    $action .= '&nbsp;&nbsp;&nbsp; <a href="#" onclick="delete_user(' . $row['Product']['id'] . ')" title="Delete User"><i class="fa fa-trash fa-lg"></i></a>';

                    //$chk = '<td><input type="checkbox" name="selected[]" class="chkBox" value="' . $row['Post']['id'] . '"/></td>';

                    $return_result['data'][] = array(
                        $row['Product']['id'],
                        $row['Product']['product_code'],
                        $row['Product']['product_title'],
                        $row['Product']['finishing_type'],
                        '--',
                        $status,
                        $action
                    );
                    $i++;
                }
            }
            // pr($return_result);
            echo json_encode($return_result);
            exit;
        }
    }

    public function admin_add() {
        $this->set('title_for_layout', 'Add Product');
        //$this->loadModel("Category");
        $this->loadModel('ProductImage');

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            // prd($data);
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
       // $condition['ProductPart.status'] = 1;

        $productData = $this->Product->find('first', array(
            'conditions' => array($condition),
        ));
        //  prd($productData);
        $postData = $this->request->data;

        if (isset($postData) && !empty($postData)) {
            if (isset($postData['Product']['assembly_instruction_file']['name']) && !empty($postData['Product']['assembly_instruction_file']['name'])) {
                $file_data = $postData['Product']['assembly_instruction_file'];
                $allowedExt = array('pdf');
                $SavePath = FILE_UPLOAD;
                $fileSize = 2097152;  // 2 MB = 2097152 bytes 

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
                $fileSize = 2097152;  // 2 MB = 2097152 bytes 

                if ($this->fileUpload($file_data, $allowedExt, $SavePath, $fileSize)) {
                    $postData['Product']['special_instruction_file'] = Configure::read('newFileName');
                } else {
                    $this->flash_msg('Some error occured while uploading SPECIAL INSTRUCTION FILE. Please try again.', 2);
                    $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $id));
                }
            } else {
                $postData['Product']['special_instruction_file'] = $productData['Product']['special_instruction_file'];
            }

            // prd($postData);
            if ($this->Product->save($postData)) {
                $this->flash_msg('Information Updated', 1);
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $id));
            }
        }



        //pr($productData);
        $this->set('productData', $productData);
        $this->request->data = $productData;
    }

    public function admin_add_product_parts() {
        $this->loadModel('ProductParts');
        $postData = $this->request->data;

        if (isset($postData) && !empty($postData)) {

            $postData['ProductParts']['product_id'] = $postData['ProductParts']['productId'];

            if ($this->ProductParts->save($postData)) {
                $this->flash_msg('Product Part Updated', 1);
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $postData['ProductParts']['productId']));
            }
        }
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
            $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'add'));
        }
    }

    public function admin_product_part_delete() {
        if ($this->request->is('ajax')) {

            $this->loadModel('ProductPart');
            $partId = $this->request->data['Part_id'];
            $data = array();
            $data['ProductPart']['id'] = $partId;
            $data['ProductPart']['status'] = 0;

            if ($this->ProductPart->save($data)) {
                echo '1';
            } else {
                echo '0';
            }
            exit;
        } else {
            $this->siteMessage("INVALID_REQUEST_DATA", array("[['data']]" => 'location'));
            $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'index'));
        }
    }

    public function admin_updateorder() {
        if (isset($this->request['data']['item']) && !empty($this->request['data']['item'])) {
            $count = 1;
            $this->loadModel('ProductImage');
            foreach ($this->request['data']['item'] as $val) {
                //to update product table
                $data = array();
                $data['ProductImage']['id'] = $val;
                $data['ProductImage']['order'] = $count;
                $this->ProductImage->save($data);
                if ($count == 1)
                    $this->updateCardImage(0, $val);
                $count++;
            }
            exit;
        }
    }

    //to update product image in card photo table
    protected function updateCardImage($card_id = 0, $image_id = 0) {
        if (!empty($image_id)) {
            $this->loadModel('Product');
            $this->loadModel('ProductImage');
            $image_name = $this->ProductImage->findById($image_id);
            if (isset($image_name['ProductImage']) && !empty($image_name['ProductImage']['product_image'])) {
                $card_array['id'] = $image_name['ProductImage']['product_id'];
                $card_array['main_photo'] = $image_name['ProductImage']['product_image'];
                $this->ProductImage->save($card_array);
            }
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

    public function admin_productlist() {
        if ($this->request->is('ajax')) {
            $term = $this->request->query('term');
            $proNames = $this->Product->find('list', array(
                'fields' => array('id', 'product_title'),
                'conditions' => array(
                    'product_title LIKE' => trim($term) . '%'
                )
            ));
           // prd($proNames);
            echo json_encode($proNames);
            exit;
            //$this->set(compact('proNames'));
            //$this->set('_serialize', 'proNames');
        }
    }

}

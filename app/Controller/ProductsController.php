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
    public function admin_add() {
        $this->set('title_for_layout', 'Add Product');
        //$this->loadModel("Category");
        $this->loadModel('ProductImage');

        if (!empty($this->request->data)) {
            $data = $this->request->data;
            if ($this->Product->save($data)) {
                $productId = $this->Product->getLastInsertId();
                $this->flash_msg('Part 1 Saved.', 1);
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'edit', $productId));
            } else {
                $this->flash_msg(2, 'Data Not Saved');
            }
        }

//        $imageList = $this->Image->find('all', array('conditions' => array(
//                'Image.status' => 1,
//                'Image.product_id' => 0,
//        )));
//        $this->set('imageList', $imageList);
//        $cateList = $this->Category->find('all');
//
//        $this->set('cateList', $cateList);
//
//        $lastItem = $this->Product->find('first', array(
//            'order' => array('Product.id DESC'),
//            'recursive' => -1,
//            'fields' => array('id', 'product_code'),
//        ));
//
//        $itemSplite = explode('-', $lastItem['Product']['product_code']);
//        if ($itemSplite[2] == 0) {
//            $itemSplite[2] = 1000;
//        }
//        $newCode = $itemSplite[2] + 1;
//        //prd($newCode);\
//        $this->set('newCode', $newCode);
    }

    public function admin_edit($id = 0) {
        $this->set('title_for_layout', 'Edit Product');
        if (empty($id)) {
            $this->flash_msg('Invalid access.', 4);
            $this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
        }
    }

}

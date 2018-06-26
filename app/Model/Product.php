<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class Product extends AppModel {

    public $name = 'Product';
    
    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => ' This field is required.'
            ),
            'maxlimit' => array(
                'rule' => array('maxLength', 40),
                'message' => 'Maximum length of 40 characters'
            )
        ),
    );
//    public $belongsTo = array(
//        'category' => array(
//            'className' => 'Category',
//        ),
//    );
    public $hasMany = array(
        'ProductParts' => array(
            'className' => 'ProductParts',
            'foreignKey' => 'product_id',
        ),
    );

    public function getProductNames($term = null) {
        if (!empty($term)) {
            $products = $this->find('all', array(
                'conditions' => array(
                    'product_title LIKE' => trim($term) . '%'
                )
            ));
            return $products;
        }
        return false;
    }

}

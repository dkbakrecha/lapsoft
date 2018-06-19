<?php

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
        'ProductPart' => array(
            'className' => 'ProductPart',
            'foreignKey' => 'product_id',
        ),
    );

}

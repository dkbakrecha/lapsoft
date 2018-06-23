<?php

App::uses('AppModel', 'Model');

class Product extends AppModel {

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

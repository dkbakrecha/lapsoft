<?php

App::uses('AppModel', 'Model');

class PurchaseOrder extends AppModel {
    public $validate = array(
        'po_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Order id is required'
            )
        ),
        'create_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Order create date is required'
            )
        ),
        'delivery_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Order delivery date is required'
            )
        ),
       
    );
	
}



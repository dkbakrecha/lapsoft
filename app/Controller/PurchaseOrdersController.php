<?php

App::uses('AppController', 'Controller');

class PurchaseOrdersController extends AppController {

    public $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        //$this->Auth->allow('admin_login', 'register');
    }

    public function admin_index() {
        $this->set('title_for_layout', 'Buyers');

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
            $condition ['Buyer.status !='] = 2;

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
            $total_records = $this->Buyer->find('count', array('conditions' => $condition));

            $fields = array('Buyer.id', 'Buyer.name', 'Buyer.contact', 'Buyer.email', 'Buyer.created', 'Buyer.status');
            $userData = $this->Buyer->find('all', array(
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

                    if ($row['Buyer']['status'] == 0) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-red" onclick="changeUserStatus(' . $row['Buyer']['id'] . ',0)" title="Change Status"></i>';
                    } else if ($row['Buyer']['status'] == 1) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-green" onclick="changeUserStatus(' . $row['Buyer']['id'] . ',1)" title="Change Status"></i>';
                    } else if ($row['Buyer']['status'] == 3) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-orange" onclick="changeUserStatus(' . $row['Buyer']['id'] . ',0)" title="Change Status"></i>';
                    }

                    //$action .= '&nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-eye fa-lg"></i></a> ';
                    // $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'suppliers/view/' . $row['Buyer']['title_slug'] . '" title="View Post" target="_BLANK"><i class="fa fa-eye fa-lg"></i></a> ';
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/suppliers/edit/' . $row['Buyer']['id'] . '" title="Edit Buyer"><i class="fa fa-pencil fa-lg"></i></a> ';

                    $action .= '&nbsp;&nbsp;&nbsp; <a href="#" onclick="delete_user(' . $row['Buyer']['id'] . ')" title="Delete User"><i class="fa fa-trash fa-lg"></i></a>';

                    //$chk = '<td><input type="checkbox" name="selected[]" class="chkBox" value="' . $row['Post']['id'] . '"/></td>';

                    $return_result['data'][] = array(
                        $row['Buyer']['id'],
                        $row['Buyer']['name'],
                        $row['Buyer']['contact'],
                        $row['Buyer']['email'],
                        date('d M Y', strtotime($row['Buyer']['created'])),
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
        if ($this->request->is('post')) {
            $postData = $this->request->data;

            $this->Buyer->create();
            if ($this->Buyer->save($postData)) {
                $this->Session->setFlash(__('The Buyer has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                    __('The Buyer could not be saved. Please, try again.')
            );
        }
    }

    public function admin_edit($id) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $postData = $this->request->data;

            if ($this->Buyer->save($postData)) {
                $this->Session->setFlash(__('The Buyer has been Updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                    __('The Buyer could not be saved. Please, try again.')
            );
        }

        $this->request->data = $this->Buyer->find('first', array('conditions' => array('Buyer.id' => $id)));
    }

    public function admin_add_edit($id = null) {
        $request = $this->request;
        $this->loadModel('Buyer');
        $buyerList = $this->Buyer->find('list');
        
        if(!empty($id)){
            $PODetail = $this->PurchaseOrder->find('first',array(
                'conditions' => array(
                    'id' => $id
                )
            ));
            
            $request->data = $PODetail;
        }

        if ($request->is('post')) {
            $data = $request->data;
            $data['PurchaseOrder']['create_date'] = date("Y-m-d", strtotime($data['PurchaseOrder']['create_date']));
            $data['PurchaseOrder']['delivery_date'] = date("Y-m-d", strtotime($data['PurchaseOrder']['delivery_date']));
            $data['PurchaseOrder']['po_id'] = "PO" . time();

            //prd($data);
            if ($res = $this->PurchaseOrder->save($data)) {
                return $this->redirect(array('action' => 'add_edit', $res['PurchaseOrder']['id']));
            }
        }
        $this->set("buyerList", $buyerList);
    }

}

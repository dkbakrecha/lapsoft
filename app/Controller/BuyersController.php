<?php

App::uses('AppController', 'Controller');

class BuyersController extends AppController {

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
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/buyers/edit/' . $row['Buyer']['id'] . '" title="Edit Buyer"><i class="fa fa-pencil fa-lg"></i></a> ';

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
                $this->flash_msg('The Buyer details has been saved.', 1);
                return $this->redirect(array('action' => 'index'));
            }
            $this->flash_msg('The Buyer could not be saved. Please, try again.', 2);
        }
    }

    public function admin_edit($id) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $postData = $this->request->data;

            if ($this->Buyer->save($postData)) {
                $this->flash_msg('The buyer details has been updated.', 1);
                return $this->redirect(array('action' => 'index'));
            }
            $this->flash_msg('The buyer could not be saved. Please, try again.', 2);
        }

        $this->request->data = $this->Buyer->find('first', array('conditions' => array('Buyer.id' => $id)));
    }

}

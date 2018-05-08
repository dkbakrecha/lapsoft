<?php

App::uses('AppController', 'Controller');

class SuppliersController extends AppController {

    public $uses = array();

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        //$this->Auth->allow('admin_login', 'register');
    }

    public function admin_index() {
        $this->set('title_for_layout', 'Suppliers');

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
            $condition ['Supplier.status !='] = 2;

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
            $total_records = $this->Supplier->find('count', array('conditions' => $condition));

            $fields = array('Supplier.id', 'Supplier.name', 'Supplier.contact', 'Supplier.email',  'Supplier.created', 'Supplier.status');
            $userData = $this->Supplier->find('all', array(
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

                    if ($row['Supplier']['status'] == 0) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-red" onclick="changeUserStatus(' . $row['Supplier']['id'] . ',0)" title="Change Status"></i>';
                    } else if ($row['Supplier']['status'] == 1) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-green" onclick="changeUserStatus(' . $row['Supplier']['id'] . ',1)" title="Change Status"></i>';
                    } else if ($row['Supplier']['status'] == 3) {
                        $status .= '<i class="fa fa-dot-circle-o fa-lg clr-orange" onclick="changeUserStatus(' . $row['Supplier']['id'] . ',0)" title="Change Status"></i>';
                    }

                    //$action .= '&nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-eye fa-lg"></i></a> ';

                   // $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'suppliers/view/' . $row['Supplier']['title_slug'] . '" title="View Post" target="_BLANK"><i class="fa fa-eye fa-lg"></i></a> ';
                    $action .= '&nbsp;&nbsp;&nbsp;<a href="' . $this->webroot . 'admin/suppliers/edit/' . $row['Supplier']['id'] . '" title="Edit Supplier"><i class="fa fa-pencil fa-lg"></i></a> ';

                    $action .= '&nbsp;&nbsp;&nbsp; <a href="#" onclick="delete_user(' . $row['Supplier']['id'] . ')" title="Delete User"><i class="fa fa-trash fa-lg"></i></a>';

                    //$chk = '<td><input type="checkbox" name="selected[]" class="chkBox" value="' . $row['Post']['id'] . '"/></td>';

                    $return_result['data'][] = array(
                        $row['Supplier']['id'],
                        $row['Supplier']['name'],
                        $row['Supplier']['contact'],
                        $row['Supplier']['email'],
                        date('d M Y', strtotime($row['Supplier']['created'])),
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

            $this->Supplier->create();
            if ($this->Supplier->save($postData)) {
                $this->Session->setFlash(__('The Supplier has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                    __('The Supplier could not be saved. Please, try again.')
            );
        }
    }

    public function admin_edit($id) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $postData = $this->request->data;

            if ($this->Supplier->save($postData)) {
                $this->Session->setFlash(__('The Supplier has been Updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                    __('The Supplier could not be saved. Please, try again.')
            );
        }

        $this->request->data = $this->Supplier->find('first', array('conditions' => array('Supplier.id' => $id)));
    }

}

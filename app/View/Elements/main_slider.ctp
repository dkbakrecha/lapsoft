<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li> 
                <li class=" treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Client</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo $this->Html->url(array('controller' => 'buyers', 'action' => 'index')); ?>"><i class="fa fa-circle-o"></i> Buyers</a></li>
                    <li><a href="<?php echo $this->Html->url(array('controller' => 'suppliers', 'action' => 'index')); ?>"><i class="fa fa-circle-o"></i> Suppliers</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Products Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'products', 'action' => 'add')); ?>">
                            <i class="fa fa-circle-o"></i>Add Product
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->Html->url(array('admin' => true, 'controller' => 'products', 'action' => 'index')); ?>">
                            <i class="fa fa-circle-o"></i>Product List
                        </a>
                    </li>
                    
                </ul>
            </li>
                <li class=" treeview">
                <a href="#">
                    <i class="fa fa-file"></i> <span>PO Buyer</span>
                </a>
                
            </li>
          
            
           
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

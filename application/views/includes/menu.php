<?php
  $current_session = $this->session->userdata('store_sess');
  switch($current_session->user_privilege){
    case 'Administrator':
      $menus = array(
        array("menu_text" => "Home","menu_uri" => "home", "menu_icon"=>"fas fa-home"),
        array("menu_text" => "Categor&iacute;as/Productos","menu_uri" => "categories", "menu_icon"=>"fas fa-list-ul",'active'=> @$categories_selected ? TRUE : FALSE ), 
        array("menu_text" => "Productos","menu_uri" => "products", "menu_icon"=>"fas fa-shopping-basket",'active'=> @$products_selected ? TRUE : FALSE ), 
        array("menu_text" => "Inventario","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Proveedores","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Reportes","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Usuarios","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Clientes","menu_uri" => "home", "menu_icon"=>"fas fa-home")
      );
    break;
    case 'Salesman':
      $menus = array(
        array("menu_text" => "Home","menu_uri" => "home", "menu_icon"=>"fas fa-home"),
        array("menu_text" => "Punto de venta","menu_uri" => "home", "menu_icon"=>"fas fa-home"),
        array("menu_text" => "Catalogos","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Inventario","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Proveedores","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Reportes","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Usuarios","menu_uri" => "home", "menu_icon"=>"fas fa-home"), 
        array("menu_text" => "Clientes","menu_uri" => "home", "menu_icon"=>"fas fa-home")
      );
    break;
  }

?>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:;">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">StoreShop</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->

      <?php foreach($menus as $iMenu){ ?>
      <li class="nav-item <?=@$iMenu['active'] ? 'active' : '';?>">
        <a class="nav-link" href="<?=base_url($iMenu['menu_uri']);?>">
          <i class="<?=$iMenu['menu_icon'];?>"></i>
          <span><?=$iMenu['menu_text'];?></span></a>
      </li>
      <?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
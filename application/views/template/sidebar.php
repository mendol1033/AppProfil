  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p id="namaPT"><?php echo $namaPT;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $fasilitas;?></a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if (isset($menu)){
          foreach ($menu as $key => $value) {
            if (isset($value['subMenu'])){?>
              <li class="treeview">
                <a href="#">
                  <i class="<?php echo $value['icon'];?>"></i>
                  <span><?php echo strtoupper($value['menu']);?></span>
                  <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                  <?php foreach ($value['subMenu'] as $key => $value) {?>
                    <?php if (array_key_exists('jumlah', $value)){?>
                      <?php if ($value['jumlah'] > 0){?>
                        <li>
                          <a href="javascript:void({})" onclick="load_page(<?php for ($i = 0; $i < count($value['url']); $i++) {
                            echo $value['url'][$i];
                            if ($i != (count($value['url'])-1)) {
                              echo ",";
                            }
                          } ;?>)">
                          <i class="fa fa-circle-o"></i>
                          <span><?php echo $value['menu'];?></span>
                          <span class="pull-right-container">
                            <span class="label label-primary pull-right"><?php echo $value['jumlah']?></span>
                          </span>
                        </a>
                      </li>
                    <?php }?>
                  <?php } else {?>
                    <li>
                      <a href="javascript:void({})" onclick="load_page(<?php for ($i = 0; $i < count($value['url']); $i++) {
                        echo $value['url'][$i];
                        if ($i != (count($value['url'])-1)) {
                          echo ",";
                        }
                      } ;?>)">
                      <i class="fa fa-circle-o"></i>
                      <span><?php echo $value['menu'];?></span>
                    </a>
                  </li>
                <?php }?>
              <?php } ?>
            </ul>
          </li> 
        <?php } else {?>
          <li>
            <a href="javascript:void({})" onclick="load_page(<?php for ($i = 0; $i < count($value['url']); $i++) {
              echo $value['url'][$i];
              if ($i != (count($value['url'])-1)) {
                echo ",";
              }
            } ;?>)">
            <i class="<?php echo $value['icon'];?>"></i>
            <span><?php echo strtoupper($value['menu']);?></span>
          </a>
        </li> 
      <?php }
    }
  } ?>
  <!-- ADMIN MENU -->
  <?php if (isset($adminMenu)){?>
   <li class="header">ADMIN NAVIGATION</li>
   <?php foreach ($adminMenu as $key => $value) {
    if (isset($value['subMenu'])){?>
      <li class="treeview">
        <a href="#">
          <i class="<?php echo $value['icon'];?>"></i>
          <span><?php echo strtoupper($value['menu']);?></span>
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <?php foreach ($value['subMenu'] as $key => $value) {?>
            <li>
              <a href="javascript:void({})" onclick="load_page('<?php echo $value["url"];?>')"><?php echo $value['menu'];?></a>
            </li>
          <?php } ?>
        </ul>
      </li> 
    <?php } else {?>
      <li>
        <a href="javascript:void({})" onclick="load_page('<?php echo $value["url"];?>')">
         <i class="<?php echo $value['icon'];?>"></i>
         <span><?php echo strtoupper($value['menu']);?></span>
       </a>
     </li> 
   <?php }
 }
} ?>
</ul>
</section>
<!-- /.sidebar -->
</aside>

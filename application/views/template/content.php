    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $app; ?>
          <small class="active breadcrumb_item">Index</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-monument"></i>&nbsp;<?php echo $app; ?></a></li>
          <li class="active breadcrumb_item">Index</li>
        </ol>
      </section>
      <!-- Main content -->
      <section id="main-content" class="content">
        <?php $this->load->view('index'); ?>
      </section>
      <!-- /.content -->
    </div>
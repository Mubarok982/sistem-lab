<?php $this->load->view('templates/header', $this->data); ?>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Sidebar (muncul SEKALI di sini saja) -->
    <?php if (isset($sidebar)) echo $sidebar; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            
            <?php $this->load->view($content_view, $this->data); ?>
        
        </div>

        <?php $this->load->view('templates/footer', $this->data); ?>
    </div>
</div>

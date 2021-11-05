<?php
$session = \Config\Services::session();
$flashError = $session->getFlashdata('error');
$flashSuccess = $session->getFlashdata('success');

if (!empty($flashError)):
    ?>
    <div class="alert alert-danger my-3"><?php echo $flashError; ?></div>
    <?php
endif;
if (!empty($flashSuccess)):
    ?>
    <div class="alert alert-success my-3"><?php echo $flashSuccess; ?></div>
<?php endif; ?>
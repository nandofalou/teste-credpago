<?php
$session = \Config\Services::session();
$flashError = $session->getFlashdata('error');
$flashSuccess = $session->getFlashdata('success');

if (!empty($flashError)):
    foreach ($flashError as $field => $error) :
        ?>
        <div class="alert alert-danger my-3"><?php echo $error; ?></div>
        <?php
    endforeach;
endif;

if (!empty($flashSuccess)):
    foreach ($flashSuccess as $field => $suss) :
        ?>
        <div class="alert alert-success my-3"><?php echo $suss; ?></div>
        <?php
    endforeach;
endif;

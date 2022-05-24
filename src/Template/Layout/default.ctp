<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->css(['../vendor/fontawesome-free/css/all.min.css', 'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i', 'sb-admin-2.min.css']) ?>
    <?= $this->Html->script('../vendor/jquery/jquery.min.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body> 
    <?php if(isset($logout) && $logout): ?>   
    <div class="text-right p-3">
        <?= $this->Html->link('Salir', '/salir', ['class' => 'btn btn-warning']);?>
    </div>
    <?php endif; ?>
    <div class="container clearfix">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->Html->script('../vendor/bootstrap/js/bootstrap.bundle.min.js') ?>
    <?= $this->Html->script('../vendor/jquery-easing/jquery.easing.min.js') ?>
    <?= $this->Html->script('sb-admin-2.min.js') ?>
</body>
</html>

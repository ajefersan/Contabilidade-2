<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('jquery.js'); ?>
    <?= $this->Html->script('mask.js'); ?>
    <?= $this->Html->script('money.js'); ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#addMovimentacao').each(function(){
                var campoDinheiro = $(this).find('[name="valor"]');
                campoDinheiro.maskMoney({
                    prefix:'R$ ',
                    showSymbol:true,
                    thousands:'.',
                    decimal:',',
                    affixesStay: true
                });

                    var form = $(this);

                    form.on('submit', function(e){
                        var field = form.find('[name="valor"]');
                        var value = field.maskMoney('unmasked')[0];
                        field.val(value);
                    });
            });

            $('#periodos').each(function(e){
                var periodos = $(this);

                $(periodos).on('change', function(p){
                    location.href = "/Contabilidade/contas/all/" + this.value;
                });
            });
        });
    </script>
</body>
</html>

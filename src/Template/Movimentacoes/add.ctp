<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Contas'), ['controller' => 'Contas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Conta'), ['controller' => 'Contas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historicos'), ['controller' => 'Historicos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historico'), ['controller' => 'Historicos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movimentacoes form large-9 medium-8 columns content">
    <?= $this->Form->create($movimentaco, ["id" => "addMovimentacao"]) ?>
    <fieldset>
        <legend><?= __('Add Movimentaco') ?></legend>
        <?php
            echo $this->Form->input('conta_id', ['options' => $contas]);
            echo $this->Form->input('historico_id', ['options' => $historicos]);
            echo $this->Form->input('valor', ["type" => "text"]);
            echo $this->Form->input('tipo');
            echo $this->Form->input('data');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

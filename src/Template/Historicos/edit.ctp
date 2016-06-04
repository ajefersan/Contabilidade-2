<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $historico->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $historico->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Historicos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['controller' => 'Movimentacoes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['controller' => 'Movimentacoes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="historicos form large-9 medium-8 columns content">
    <?= $this->Form->create($historico) ?>
    <fieldset>
        <legend><?= __('Edit Historico') ?></legend>
        <?php
            echo $this->Form->input('codigo');
            echo $this->Form->input('nome');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

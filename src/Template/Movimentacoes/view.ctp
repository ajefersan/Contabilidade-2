<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Movimentaco'), ['action' => 'edit', $movimentaco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Movimentaco'), ['action' => 'delete', $movimentaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movimentaco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contas'), ['controller' => 'Contas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conta'), ['controller' => 'Contas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Historicos'), ['controller' => 'Historicos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historico'), ['controller' => 'Historicos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="movimentacoes view large-9 medium-8 columns content">
    <h3><?= h($movimentaco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= $movimentaco->has('conta') ? $this->Html->link($movimentaco->conta->id, ['controller' => 'Contas', 'action' => 'view', $movimentaco->conta->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Historico') ?></th>
            <td><?= $movimentaco->has('historico') ? $this->Html->link($movimentaco->historico->id, ['controller' => 'Historicos', 'action' => 'view', $movimentaco->historico->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($movimentaco->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($movimentaco->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($movimentaco->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Data') ?></th>
            <td><?= h($movimentaco->data) ?></td>
        </tr>
    </table>
</div>

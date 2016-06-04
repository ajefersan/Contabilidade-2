<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Contas'), ['controller' => 'Contas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Conta'), ['controller' => 'Contas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Historicos'), ['controller' => 'Historicos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Historico'), ['controller' => 'Historicos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="movimentacoes index large-9 medium-8 columns content">
    <h3><?= __('Movimentacoes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('conta_id') ?></th>
                <th><?= $this->Paginator->sort('historico_id') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
                <th><?= $this->Paginator->sort('tipo') ?></th>
                <th><?= $this->Paginator->sort('data') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movimentacoes as $movimentaco): ?>
            <tr>
                <td><?= $this->Number->format($movimentaco->id) ?></td>
                <td><?= $movimentaco->has('conta') ? $this->Html->link($movimentaco->conta->id, ['controller' => 'Contas', 'action' => 'view', $movimentaco->conta->id]) : '' ?></td>
                <td><?= $movimentaco->has('historico') ? $this->Html->link($movimentaco->historico->id, ['controller' => 'Historicos', 'action' => 'view', $movimentaco->historico->id]) : '' ?></td>
                <td><?= $this->Number->format($movimentaco->valor) ?></td>
                <td><?= h($movimentaco->tipo) ?></td>
                <td><?= h($movimentaco->data) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $movimentaco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $movimentaco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $movimentaco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movimentaco->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

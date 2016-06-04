<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Conta'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['controller' => 'Movimentacoes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['controller' => 'Movimentacoes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contas index large-9 medium-8 columns content">
    <h3><?= __('Contas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('codigo') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('users_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contas as $conta): ?>
            <tr>
                <td><?= $this->Number->format($conta->id) ?></td>
                <td><?= h($conta->codigo) ?></td>
                <td><?= h($conta->nome) ?></td>
                <td><?= $conta->has('user') ? $this->Html->link($conta->user->id, ['controller' => 'Users', 'action' => 'view', $conta->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $conta->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $conta->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $conta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conta->id)]) ?>
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

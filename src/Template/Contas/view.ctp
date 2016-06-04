<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Conta'), ['action' => 'edit', $conta->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Conta'), ['action' => 'delete', $conta->id], ['confirm' => __('Are you sure you want to delete # {0}?', $conta->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Conta'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['controller' => 'Movimentacoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['controller' => 'Movimentacoes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contas view large-9 medium-8 columns content">
    <h3><?= h($conta->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Codigo') ?></th>
            <td><?= h($conta->codigo) ?></td>
        </tr>
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($conta->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $conta->has('user') ? $this->Html->link($conta->user->id, ['controller' => 'Users', 'action' => 'view', $conta->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($conta->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Movimentacoes') ?></h4>
        <?php if (!empty($conta->movimentacoes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Conta Id') ?></th>
                <th><?= __('Historico Id') ?></th>
                <th><?= __('Valor') ?></th>
                <th><?= __('Tipo') ?></th>
                <th><?= __('Data') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($conta->movimentacoes as $movimentacoes): ?>
            <tr>
                <td><?= h($movimentacoes->id) ?></td>
                <td><?= h($movimentacoes->conta_id) ?></td>
                <td><?= h($movimentacoes->historico_id) ?></td>
                <td><?= h($movimentacoes->valor) ?></td>
                <td><?= h($movimentacoes->tipo) ?></td>
                <td><?= h($movimentacoes->data) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Movimentacoes', 'action' => 'view', $movimentacoes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Movimentacoes', 'action' => 'edit', $movimentacoes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Movimentacoes', 'action' => 'delete', $movimentacoes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movimentacoes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

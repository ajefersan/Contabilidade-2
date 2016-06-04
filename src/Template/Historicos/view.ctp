<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Historico'), ['action' => 'edit', $historico->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Historico'), ['action' => 'delete', $historico->id], ['confirm' => __('Are you sure you want to delete # {0}?', $historico->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Historicos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Historico'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Movimentacoes'), ['controller' => 'Movimentacoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movimentaco'), ['controller' => 'Movimentacoes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="historicos view large-9 medium-8 columns content">
    <h3><?= h($historico->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Codigo') ?></th>
            <td><?= h($historico->codigo) ?></td>
        </tr>
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($historico->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $historico->has('user') ? $this->Html->link($historico->user->id, ['controller' => 'Users', 'action' => 'view', $historico->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($historico->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Movimentacoes') ?></h4>
        <?php if (!empty($historico->movimentacoes)): ?>
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
            <?php foreach ($historico->movimentacoes as $movimentacoes): ?>
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

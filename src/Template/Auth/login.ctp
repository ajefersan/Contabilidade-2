<?= $this->Form->create(); ?>
    <?= $this->Form->input('username'); ?>
    <?= $this->Form->input('password', array('type' => 'password')); ?>
    <?= $this->Form->button('Login'); ?>
<?= $this->Form->end(); ?>
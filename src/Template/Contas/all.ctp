<div class="contas all large-12 medium-12 columns content">

    <select id="periodos">
        <option>Selecione o período</option>
        <?php foreach($periodos as $p) :  $fdata = new Cake\I18n\Date($p->data); ?>
        <option value="<?= $fdata->format('Y-m-d'); ?>"  <?= ($fdata->format('Y-m-d') == $matchDate) ? 'selected':'' ?>><?= $fdata->format('d.m.Y'); ?></option>
        <?php endforeach; ?>
    </select>


<h1 class="hideonprint">Diário</h1>
 <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <td>Nome da Conta</td>
            <td>Código da Conta</td>
            <td>Data</td>
             <td>Histórico</td>
            <td>Débito</td>
            <td>Crédito</td>
         </tr>
    </thead>
    <tbody>

<?php foreach ($diario as $diario): ?>
    <tr>
        <td><?= $diario->conta->nome; ?></td>
        <td><?= $diario->conta->codigo; ?></td>
        <td><?php $fdata = new Cake\I18n\Date($diario->data); echo $fdata->format('d.m.Y'); ?></td>
        <td><?= $diario->historico->nome; ?></td>
        <td><?= ($diario->tipo == 'D') ? number_format($diario->valor,0,",",".") : '' ?></td>
        <td><?= ($diario->tipo == 'C') ? number_format($diario->valor,0,",",".") : '' ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<div class="break-page">
                break-page
            </div>

<h1 class="hideonprint">Razão</h1>

    <?php foreach ($contas as $conta): ?>
        <?php if($conta->movimentacoes): ?>
            <h3><?= h($conta->nome) ?> <span class="codigo"><?= h($conta->codigo) ?></span></h3>
            <div class="related">
                <?php if (!empty($conta->movimentacoes)): ?>
                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Data</td>
                            <td>Histórico</td>
                            <td>Débito</td>
                            <td>Crédito</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <?php
                        $count = count($conta->movimentacoes);
                        $index = 1;
                        foreach ($conta->movimentacoes as $movimentacoes): ?>
                    <tr>
                        <td width="10%"><?php
                            $fdata = new Cake\I18n\Date($movimentacoes->data);
                            echo $fdata->format('d.m.Y');
                        ?></td>
                        <td><?= h($historicos[$movimentacoes->historico_id]) ?></td>
                        <td><?= ($movimentacoes->tipo == 'D') ? h(number_format($movimentacoes->valor,0,",",".")) : '' ?></td>
                        <td><?= ($movimentacoes->tipo == 'C') ? h(number_format($movimentacoes->valor,0,",",".")) : '' ?></td>
                        <td><?php
                            if($index == $count) {
                                echo number_format(abs($total[$conta->id]['saldo']),0,",",".");
                                echo ($total[$conta->id]['saldo'] < 0) ? ' D' : ' C';
                            }
                        ?></td>
                    </tr>
                    <?php
                        $index++;
                        endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
            <div class="break-page">
                break-page
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


<div class="contas all large-12 medium-12 columns content">
            <h1>Balancete</h1>
            <div class="related">

                <table cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <td>Conta</td>
                            <td>Devedor</td>
                            <td>Credor</td>
                        </tr>
                    </thead>
                    <?php
                        $credor = 0;
                        $devedor = 0;
                        foreach ($total as $t):

                            if($t['saldo'] > 0) {
                                $credor += $t['saldo'];
                            } else {
                                $devedor += $t['saldo'];
                            }
                        ?>
                    <tr>
                        <td><?= $t['nome'] ?></td>
                        <td><?= ($t['saldo'] < 0) ? h(number_format(abs($t['saldo']),0,",",".")) : '' ?></td>
                        <td><?= ($t['saldo'] > 0) ? h(number_format($t['saldo'],0,",",".")) : '' ?></td>
                    </tr>
                    <?php
                        endforeach; ?>
                    <tfoot>
                        <td>Soma</td>
                        <td><?= number_format(abs($devedor),0,",","."); ?></td>
                        <td><?= number_format($credor,0,",","."); ?></td>
                    </tfoot>
            </div>
</div>

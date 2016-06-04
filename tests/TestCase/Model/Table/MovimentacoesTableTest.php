<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MovimentacoesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MovimentacoesTable Test Case
 */
class MovimentacoesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MovimentacoesTable
     */
    public $Movimentacoes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.movimentacoes',
        'app.contas',
        'app.users',
        'app.historicos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Movimentacoes') ? [] : ['className' => 'App\Model\Table\MovimentacoesTable'];
        $this->Movimentacoes = TableRegistry::get('Movimentacoes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Movimentacoes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

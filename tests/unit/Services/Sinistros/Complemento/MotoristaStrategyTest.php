<?php

use Illuminate\Container\Container;
use Prophecy\Argument;

class MotoristaStrategyTest extends TestCase
{

    /** @var \Entities\Sinistros\ClassificacaoMotoristaEntity */
    private ClassificacaoMotoristaEntity $entidade;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $repositorio;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $mapper;


    protected function setUp(): void
    {
        $this->entidade = new ClassificacaoMotoristaEntity();
        $this->repositorio = $this->prophesize(ClassificacaoMotoristaRepository::class);
        $this->mapper = $this->prophesize(ClassificacaoMotoristaMapper::class);

        parent::setUp();
    }

    /**
     * Instancia e retorna o service
     * @return \Services\Sinistros\ResponsabilidadeService
     */
    private function getClassificacaoMotoristaStrategy()
    {
        $containerContract = $this->prophesize(Container::class);
        $containerContract->make(ClassificacaoMotoristaEntity::class, Argument::any())
            ->willReturn($this->entidade);
        $containerContract->make(Argument::any(), Argument::any())
            ->willReturn($this->repositorio->reveal());
        Container::setInstance($containerContract->reveal());

        return new MotoristaStrategy();
    }

    public function testExecutarInserir()
    {
        $classificacaoId = 1;
        $itemId = 2;

        $this->repositorio->obterPorClassificacaoId(Argument::any())
            ->willReturn(null);

        $this->repositorio->inserir(Argument::any(), Argument::any())
            ->willReturn($this->entidade);

        $classeConcreta = $this->getClassificacaoMotoristaStrategy();
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertEquals($this->entidade->getId(), $retorno->getId());
    }

    public function testExecutarAlterar()
    {
        $classificacaoId = 1;
        $itemId = 2;

        $this->repositorio->obterPorClassificacaoId(Argument::any())
            ->willReturn($this->entidade);

        $this->repositorio->alterar(Argument::any(), Argument::any())
            ->willReturn(true);

        $classeConcreta = $this->getClassificacaoMotoristaStrategy();
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertTrue($retorno);
    }
}

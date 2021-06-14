<?php

use Illuminate\Container\Container;
use Prophecy\Argument;

class TransportadoraStrategyTest extends TestCase
{

    /** @var \\Entities\Sinistros\ClassificacaoTransportadoraEntity */
    private ClassificacaoTransportadoraEntity $entidade;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $repositorio;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $mapper;


    protected function setUp(): void
    {
        $this->entidade = new ClassificacaoTransportadoraEntity();
        $this->repositorio = $this->prophesize(ClassificacaoTransportadoraRepository::class);
        $this->mapper = $this->prophesize(ClassificacaoTransportadoraMapper::class);

        parent::setUp();
    }

    /**
     * Instancia e retorna o service
     * @return \\Services\Sinistros\ResponsabilidadeService
     */
    private function getClassificacaoTransportadoraStrategy()
    {
        $containerContract = $this->prophesize(Container::class);
        $containerContract->make(ClassificacaoTransportadoraEntity::class, Argument::any())
            ->willReturn($this->entidade);
        $containerContract->make(Argument::any(), Argument::any())
            ->willReturn($this->repositorio->reveal());
        Container::setInstance($containerContract->reveal());

        return new TransportadoraStrategy();
    }

    public function testExecutarInserir()
    {
        $classificacaoId = 1;
        $itemId = 2;

        $this->repositorio->obterPorClassificacaoId(Argument::any())
            ->willReturn(null);

        $this->repositorio->inserir(Argument::any(), Argument::any())
            ->willReturn($this->entidade);

        $classeConcreta = $this->getClassificacaoTransportadoraStrategy();
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

        $classeConcreta = $this->getClassificacaoTransportadoraStrategy();
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertTrue($retorno);
    }
}

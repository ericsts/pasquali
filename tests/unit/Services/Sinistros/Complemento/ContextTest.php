<?php


use Illuminate\Container\Container;
use Prophecy\Argument;

class ContextTest extends TestCase
{
    public function testSetEstrategiaTransportadora()
    {
        $transportadoraEstrategia = TransportadoraStrategy::class;

        $classeConcreta = new Context();
        $retorno = $classeConcreta->setEstrategia($transportadoraEstrategia);

        $this->assertNull($retorno);
    }

    public function testExecutarTransportadora()
    {
        $classificacaoId = $itemId = 1;

        $transportadoraEstrategia = $this->prophesize(TransportadoraStrategy::class);

        $transportadoraEstrategia->executar(Argument::any(), Argument::any())->willReturn(1);

        $containerContract = $this->prophesize(Container::class);
        $containerContract->make(Argument::any(), Argument::any())->willReturn($transportadoraEstrategia);
        Container::setInstance($containerContract->reveal());

        $classeConcreta = new Context();
        $classeConcreta->setEstrategia(TransportadoraStrategy::class);
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertEquals(1, $retorno);
    }

    public function testSetEstrategiaMotorista()
    {
        $motoristaEstrategia = MotoristaStrategy::class;

        $classeConcreta = new Context();
        $retorno = $classeConcreta->setEstrategia($motoristaEstrategia);

        $this->assertNull($retorno);
    }

    public function testExecutarMotorista()
    {
        $classificacaoId = $itemId = 1;

        $motoristaEstrategia = $this->prophesize(MotoristaStrategy::class);

        $motoristaEstrategia->executar(Argument::any(), Argument::any())->willReturn(1);

        $containerContract = $this->prophesize(Container::class);
        $containerContract->make(Argument::any(), Argument::any())->willReturn($motoristaEstrategia);
        Container::setInstance($containerContract->reveal());

        $classeConcreta = new Context();
        $classeConcreta->setEstrategia(MotoristaStrategy::class);
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertEquals(1, $retorno);
    }

    public function testSetEstrategiaAgente()
    {
        $agenteEstrategia = AgenteStrategy::class;

        $classeConcreta = new Context();
        $retorno = $classeConcreta->setEstrategia($agenteEstrategia);

        $this->assertNull($retorno);
    }

    public function testExecutarAgente()
    {
        $classificacaoId = $itemId = 1;

        $agenteEstrategia = $this->prophesize(AgenteStrategy::class);

        $agenteEstrategia->executar(Argument::any(), Argument::any())->willReturn(1);

        $containerContract = $this->prophesize(Container::class);
        $containerContract->make(Argument::any(), Argument::any())->willReturn($agenteEstrategia);
        Container::setInstance($containerContract->reveal());

        $classeConcreta = new Context();
        $classeConcreta->setEstrategia(AgenteStrategy::class);
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertEquals(1, $retorno);
    }

    public function testExecutarErro()
    {
        $classificacaoId = $itemId = 1;

        $classeConcreta = new Context();
        $retorno = $classeConcreta->executar($classificacaoId, $itemId);

        $this->assertFalse($retorno);
    }
}

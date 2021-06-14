<?php

use Illuminate\Support\Collection;
use Prophecy\Argument;


class ClassificacaoAgenteRepositoryTest extends TestCase
{
    /** @var ClassificacaoAgenteEntity */
    protected $entidade;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $adapter;


    protected function setUp(): void
    {
        $this->entidade = new ClassificacaoAgenteEntity();
        $this->validarInterface();
        $this->adapter = $this->prophesize(ClassificacaoAgenteRepositoryAdapter::class);

        parent::setUp();
    }

    public function validarInterface()
    {
        $entidade = clone $this->entidade;
        $entidade->getId();
        $entidade->getAgenteId();
    }

    public function testObterPorClassificacaoId()
    {
        $this->entidade->setId(1)
            ->setAgenteId(1)
            ->setClassificacaoId(1);

        $this->adapter->obterPorClassificacaoId(Argument::any())
            ->willReturn(
                new Collection([$this->entidade])
            );

        $classeConcreta = new ClassificacaoAgenteRepository($this->adapter->reveal());

        $colecao = $classeConcreta->obterPorClassificacaoId(1);
        $this->assertEquals($this->entidade->getClassificacaoId(), $colecao->get(0)->getClassificacaoId());
    }

    public function testObterPorClassificacaoIdNaoEncontrou()
    {
        $this->adapter->obterPorClassificacaoId(Argument::any())
            ->willReturn(
                null
            );

        $classeConcreta = new ClassificacaoAgenteRepository($this->adapter->reveal());

        $colecao = $classeConcreta->obterPorClassificacaoId(1);
        $this->assertEquals($colecao, null);
    }
}

<?php


class ClassificacaoAgenteRepositoryAdapterTest extends TestCase
{
    use MockModelBuilder;

    /** @var \Entities\Sinistros\ClassificacaoItemEntity */
    private ClassificacaoItemEntity $entidade;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    private \Prophecy\Prophecy\ObjectProphecy $mapper;

    protected function setUp(): void
    {
        $this->entidade = new ClassificacaoItemEntity();
        $this->entidade->setId(1)
            ->setSinistroId(1);

        $this->setQueryBuilder();
        $this->mapper = $this->prophesize(ClassificacaoAgenteMapper::class);
    }

    /**
     * @return \Repositories\Sinistros\Adapters\ClassificacaoAgenteRepositoryAdapter
     */
    private function getClassificacaoAgenteRepositoryAdapter()
    {
        return new ClassificacaoAgenteRepositoryAdapter(
            $this->getModelMock(ClassificacaoAgente::class),
            $this->mapper->reveal(),
            $this->entidade
        );
    }

    public function testObterPorClassificacaoId()
    {
        $id = 1;

        $this->mapper->mapear(Argument::any(), Argument::any())
            ->willReturn($this->entidade);

        $this->mockWhere($this->databaseBuilderMock)
            ->mockFirst($this->entidade);

        $classeConcreta = $this->getClassificacaoAgenteRepositoryAdapter();
        $retorno = $classeConcreta->obterPorClassificacaoId($id);

        $this->assertEquals($this->entidade->getId(), $retorno->getId());
    }

    public function testObterPorClassificacaoIdSemClassificacao()
    {
        $id = 1;

        $this->mockWhere($this->databaseBuilderMock)
            ->mockFirst(null);

        $classeConcreta = $this->getClassificacaoAgenteRepositoryAdapter();
        $retorno = $classeConcreta->obterPorClassificacaoId($id);

        $this->assertEmpty($retorno);
    }
}

<?php

use Illuminate\Support\Collection;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;


trait MockModelBuilder
{
    /** @var ObjectProphecy */
    protected $eloquentBuilderMock;

    /** @var ObjectProphecy */
    protected $databaseBuilderMock;

    /**
     * Inicializa classes para mock do Eloquent e Database
     * @param bool $retornarBuilderEloquent
     * @return $this
     */
    protected function setQueryBuilder($retornarBuilderEloquent = false)
    {
        $this->eloquentBuilderMock = $this->prophesize(\Illuminate\Database\Eloquent\Builder::class);
        $this->databaseBuilderMock = $this->prophesize(\Illuminate\Database\Query\Builder::class);
        $retorno = $retornarBuilderEloquent ? $this->eloquentBuilderMock : $this->databaseBuilderMock;
        $this->eloquentBuilderMock->getQuery()->willReturn($retorno->reveal());
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockWhere($retorno, $parametros = [])
    {
        $parametros = $parametros
            ? $parametros
            : [
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            ];

        $this->eloquentBuilderMock->where(...$parametros)
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockOrderBy($retorno, $parametros = [])
    {
        $parametros = $parametros
            ? $parametros
            : [
                Argument::any(),
                Argument::any(),
            ];
        $this->databaseBuilderMock->orderBy(...$parametros)
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockLeftJoin($retorno, $parametros = [])
    {
        $parametros = $parametros
            ? $parametros
            : [
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            ];

        $this->databaseBuilderMock->leftJoin(
            ...$parametros
        )->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockWith($retorno)
    {
        $this->eloquentBuilderMock->with(Argument::any())
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockFindOrFail($retorno)
    {
        $this->eloquentBuilderMock->findOrFail(Argument::any())
            ->willReturn($retorno);
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockFirst($retorno)
    {
        $this->databaseBuilderMock->first(Argument::any())
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockTake($retorno)
    {
        $this->databaseBuilderMock->take(Argument::any())
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockGet($retorno)
    {
        $this->eloquentBuilderMock->get(Argument::any())
            ->willReturn($retorno);
        return $this;
    }

    /**
     * @param mixed $retorno
     * @return $this
     */
    protected function mockDelete($retorno)
    {
        $this->eloquentBuilderMock->delete()
            ->willReturn($retorno);
        return $this;
    }

    /**
     * Model
     * @param string $modelClasse
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getModelMock(string $modelClasse)
    {
        $modelMock = $this->createMock($modelClasse);
        $modelMock->method('newQuery')->willReturn($this->eloquentBuilderMock->reveal());
        return $modelMock;
    }
}

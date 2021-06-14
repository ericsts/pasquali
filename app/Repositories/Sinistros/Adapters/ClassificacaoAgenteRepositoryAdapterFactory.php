<?php


class ClassificacaoAgenteRepositoryAdapterFactory
{
    public function __invoke()
    {
        return new ClassificacaoAgenteRepositoryAdapter(
            app(ClassificacaoAgente::class),
            app(ClassificacaoAgenteMapperInterface::class),
            app(ClassificacaoAgenteEntity::class)
        );
    }
}

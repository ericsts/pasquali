<?php


class ClassificacaoAgenteRepositoryFactory
{
    public function __invoke()
    {
        return new ClassificacaoAgenteRepository(
            (new ClassificacaoAgenteRepositoryAdapterFactory())()
        );
    }
}

<?php

class ClassificacaoAgenteMapperFactory
{

    public function __invoke()
    {
        return new ClassificacaoAgenteMapper(
            new ClassificacaoAgenteMapperAdapter()
        );
    }
}

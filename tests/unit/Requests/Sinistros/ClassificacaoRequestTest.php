<?php

use Illuminate\Container\Container;

class ClassificacaoRequestTest extends TestCase
{
    public function testGetClassificacaoService()
    {
        $dadosValidar = [
            'encomendaId' => 1,
            'funcionarioId' => 1,
            'classificacaoId' => 1
        ];
        $container = Container::getInstance();
        $classeConcreta = new ClassificacaoRequest();
        $classeConcreta->setContainer($container);
        $classeConcreta->merge($dadosValidar);
        $retorno = $classeConcreta->validateResolved();
        $this->assertNull($retorno);
    }
}

<?php

class ClassificacaoServiceFactoryTest extends TestCase
{
    public function testFabrica()
    {
        $fabrica = new ClassificacaoServiceFactory();
        $this->assertInstanceOf(ClassificacaoServiceFactory::class, $fabrica);

        $servico = $fabrica();
        $this->assertInstanceOf(ClassificacaoService::class, $servico);
    }
}

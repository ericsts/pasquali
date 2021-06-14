<?php


class ClassificarItemMapperFactoryTest extends TestCase
{
    public function testFabrica()
    {
        $fabrica = new ClassificacaoItemMapperFactory();
        $this->assertInstanceOf(ClassificacaoItemMapperFactory::class, $fabrica);

        $classificarItemMapper = $fabrica();
        $this->assertInstanceOf(ClassificacaoItemMapper::class, $classificarItemMapper);
    }
}

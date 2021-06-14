<?php


class ClassificacaoAgenteRepositoryFactoryTest extends TestCase
{
    public function testFabrica()
    {
        $factory = new ClassificacaoAgenteRepositoryFactory();
        $this->assertInstanceOf(ClassificacaoAgenteRepositoryFactory::class, $factory);

        $classificacaoAgenteRepository = $factory();
        $this->assertInstanceOf(ClassificacaoAgenteRepository::class, $classificacaoAgenteRepository);
    }
}

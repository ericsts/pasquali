<?php


class SinistroControllerTest extends TestCase
{

    public function testDeletarSinistroPorEncomendaId()
    {
        $sinistroServiceMock = $this->prophesize(SinistroServiceInterface::class);

        $sinistroServiceMock->obterSinistroPorEncomendaId(Argument::any())
            ->willReturn((new SinistroEntity())->setSinistroId(1));

        $sinistroServiceMock->deletar(Argument::any())->willReturn(true);

        $classeConcreta = new SinistroController($sinistroServiceMock->reveal());
        $resultado = $classeConcreta->deletar(1);

        $this->assertEquals(Response::HTTP_OK, $resultado->getStatusCode());
    }

    public function testDeletarSinistroPorEncomendaIdComErro()
    {
        $sinistroServiceMock = $this->prophesize(SinistroServiceInterface::class);

        $sinistroServiceMock->obterSinistroPorEncomendaId(Argument::any())
            ->willReturn((new SinistroEntity())->setSinistroId(1));

        $sinistroServiceMock->deletar(Argument::any())
            ->willThrow(new Exception('Erro de requisição'));

        $classeConcreta = new SinistroController($sinistroServiceMock->reveal());
        $resultado = $classeConcreta->deletar(1);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $resultado->getStatusCode());
    }

    public function testDeletarSinistroPorEncomendaIdComErroSinistroNaoExcluido()
    {
        $sinistroServiceMock = $this->prophesize(SinistroServiceInterface::class);

        $sinistroServiceMock->obterSinistroPorEncomendaId(Argument::any())
            ->willReturn((new SinistroEntity())->setSinistroId(1));
        $sinistroServiceMock->deletar(Argument::any())->willReturn(false);

        $classeConcreta = new SinistroController($sinistroServiceMock->reveal());
        $resultado = $classeConcreta->deletar(1);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $resultado->getStatusCode());
    }

    public function testDeletarSinistroPorEncomendaIdComErroSinistroNaoExiste()
    {
        $sinistroServiceMock = $this->prophesize(SinistroServiceInterface::class);

        $sinistroServiceMock->obterSinistroPorEncomendaId(Argument::any())
            ->willReturn(null);

        $classeConcreta = new SinistroController($sinistroServiceMock->reveal());
        $resultado = $classeConcreta->deletar(1);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $resultado->getStatusCode());
    }
}

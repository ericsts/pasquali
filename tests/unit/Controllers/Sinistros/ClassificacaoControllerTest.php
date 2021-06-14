<?php

class ClassificacaoControllerTest extends TestCase
{
    /** @var  \\Services\Sinistros\ClassificacaoService */
    protected $classificarItemServiceMock;

    /** @var Request */
    protected $request;

    /** @var array */
    private $dadosTeste;

    /** @var \\Entities\Sinistros\ClassificacaoItemEntity */
    private ClassificacaoItemEntity $classificacaoEntidade;

    protected function setUp(): void
    {
        $this->classificarItemServiceMock = $this->prophesize(ClassificacaoServiceInterface::class);

        $this->dadosTeste = [
            'id' => 1
        ];

        $this->classificacaoEntidade = new ClassificacaoItemEntity();
        $this->classificacaoEntidade->setId(1);

        parent::setUp();
    }

    public function testClassificarSinistro()
    {
        $this->classificarItemServiceMock->classificarSinistros(Argument::any())
            ->willReturn(1);

        $request = $this->prophesize(ClassificacaoRequest::class);

        $request->post()->willReturn([
            'sinistroId' => 1,
            'etapaId' => 1,
            'responsabilidadeId' => 1,
            'funcionarioId' => 1
        ]);

        $classeConcreta = new ClassificacaoController($this->classificarItemServiceMock->reveal());

        $response = $classeConcreta->classificar($request->reveal());
        $this->assertEquals('Sinistros Classificado', $response->getData()->result);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testClassificarSinistroComErro()
    {
        $this->classificarItemServiceMock->classificarSinistros(Argument::any())
            ->willThrow(new RuntimeException());

        $request = $this->prophesize(ClassificacaoRequest::class);

        $request->post()->willReturn([]);

        $classeConcreta = new ClassificacaoController($this->classificarItemServiceMock->reveal());

        $response = $classeConcreta->classificar($request->reveal());
        $this->assertEquals('Erro ao classificar sinistro', $response->getData()->result);
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testObterPorEncomendaIdRetornaJson()
    {
        $encomendaId = 1;
        $request = $this->prophesize(Request::class);
        $request->route(Argument::any())->willReturn($encomendaId);

        $classificacaoServiceMock = $this->prophesize(ClassificacaoServiceInterface::class);
        $classificacaoServiceMock->obterPorEncomendaId($encomendaId)->willReturn($this->classificacaoEntidade);

        $classeConcreta = new ClassificacaoController($classificacaoServiceMock->reveal());

        $resultado = $classeConcreta->obterPorEncomendaId($request->reveal());

        $this->assertInstanceOf(JsonResponse::class, $resultado);

        $this->assertEquals($this->dadosTeste['id'], $resultado->getData()->id);

        $this->assertEquals(Response::HTTP_OK, $resultado->getStatusCode());
    }

    public function testObterPorEncomendaIdComErro()
    {
        $encomendaId = 1;
        $request = $this->prophesize(Request::class);
        $request->route(Argument::any())->willReturn($encomendaId);

        $classificacaoServiceMock = $this->prophesize(ClassificacaoServiceInterface::class);
        $classificacaoServiceMock->obterPorEncomendaId($encomendaId)->willThrow(new Exception('Erro de requisição'));

        $classeConcreta = new ClassificacaoController($classificacaoServiceMock->reveal());

        $resultado = $classeConcreta->obterPorEncomendaId($request->reveal());

        $this->assertEquals('Erro ao consultar sinistro', $resultado->getData()->result);
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $resultado->getStatusCode());
    }
}

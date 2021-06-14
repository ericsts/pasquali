<?php


class ClassificacaoController implements ClassificacaoControllerInterface
{
    /** @var \Services\Sinistros\ClassificacaoServiceInterface */
    protected ClassificacaoServiceInterface $classificacaoServico;

    public function __construct(ClassificacaoServiceInterface $servico)
    {
        $this->classificacaoServico = $servico;
    }

    /** @inheritDoc */
    public function classificar(ClassificacaoRequest $request)
    {
        try {
            /** @var array $post */
            $post = $request->post();
            $id = $this->classificacaoServico->classificarSinistros($post);

            return response()->json(['result' => 'Sinistros Classificado', 'id' => $id], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'result' => 'Erro ao classificar sinistro',
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @inheritDoc
     */
    public function obterPorEncomendaId(Request $request)
    {
        try {
            $encomendaId = (int)$request->route('encomendaId');
            $classificacaoEntidade = $this->classificacaoServico->obterPorEncomendaId($encomendaId);
            return response()->json($classificacaoEntidade->toArray(), Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'result' => 'Erro ao consultar sinistro',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

<?php


interface ClassificacaoControllerInterface
{
    /**
     * Action para classificação de sinistros existentes
     * @param ClassificacaoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function classificar(ClassificacaoRequest $request);

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function obterPorEncomendaId(Request $request);
}

<?php

interface ClassificacaoServiceInterface
{

    /**
     * Classifica um array de sinistros ou encomendas
     * @param array $dados
     * @throws \RuntimeException
     * @return integer|boolean
     */
    public function classificarSinistros(array $dados);

    /**
     * Obter a classificação do sinistro por sinistroId
     * @param integer $sinistroId
     * @return \Entities\Sinistros\ClassificacaoItemEntity
     */
    public function obterPorSinistroId(int $sinistroId);

    /**
     * Excluir classificação do sinistro
     * @param integer $id
     * @return boolean
     */
    public function deletar(int $id);

    /**
     * Obter a classificação do sinistro por encomendaId
     * @param integer $encomendaId
     * @return \Entities\Sinistros\ClassificacaoItemEntity
     */
    public function obterPorEncomendaId(int $encomendaId);

    /**
     * Retorna o ID do sinistro encontrado por ID da Encomenda
     *
     * @param int $encomendaId
     * @return int|void|null
     */
    public function obterSinistroIdPorEncomendaId($encomendaId);

    /**
     * Retorna a quantidade de registros utizados pelo campo X
     * @param int    $id
     * @param string $campo
     * @return object
     */
    public function permitirExclusao(int $id, string $campo);
}

<?php


interface ClassificacaoAgenteRepositoryAdapterInterface extends DefaultRepositoryInterface
{
    public function obterPorClassificacaoId(int $classificacaoId);
}

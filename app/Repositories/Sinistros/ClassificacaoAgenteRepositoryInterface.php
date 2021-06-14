<?php


interface ClassificacaoAgenteRepositoryInterface extends DefaultRepositoryInterface
{

    public function obterPorClassificacaoId($classificacaoId);
}

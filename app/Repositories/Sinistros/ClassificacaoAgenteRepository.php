<?php

class ClassificacaoAgenteRepository extends Repository implements ClassificacaoAgenteRepositoryInterface
{
    protected DefaultRepositoryInterface $repositoryAdapter;

    /** @inheritDoc */
    public function obterPorClassificacaoId($classificacaoId)
    {
        return $this->repositoryAdapter->obterPorClassificacaoId($classificacaoId);
    }
}

<?php


class AgenteStrategy extends AbstractStrategy
{
    /** @var string $repositorioClasse */
    protected $repositorioClasse = ClassificacaoAgenteRepositoryInterface::class;

    /** @var string $mapperClasse */
    protected $mapperClasse = ClassificacaoAgenteMapperInterface::class;

    /** @var string $entidadeClasse */
    protected $entidadeClasse = ClassificacaoAgenteEntity::class;

    /**
     * @inheritDoc
     */
    public function popularEntidade(DefaultEntityInterface $entidade, int $classificacaoId, int $itemId)
    {
        /** @var ClassificacaoAgenteEntity $entidade */
        $entidade->setClassificacaoId($classificacaoId);
        $entidade->setAgenteId($itemId);
    }
}

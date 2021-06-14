<?php


class ClassificacaoAgenteRepositoryAdapter extends EloquentRepositoryAdapter implements
    ClassificacaoAgenteRepositoryAdapterInterface
{
    use ComplementoClassificacaoAdapterTrait;

    public function __construct(
        Model $model,
        DefaultMapperInterface $mapper,
        DefaultEntityInterface $entidade
    ) {
        $this->model = $model;
        $this->mapper = $mapper;
        $this->entidade = $entidade;
        parent::__construct();
    }
}

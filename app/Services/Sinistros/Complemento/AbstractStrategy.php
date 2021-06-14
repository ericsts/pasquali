<?php


abstract class AbstractStrategy
{
    /** @var string $repositorioClasse */
    protected $repositorioClasse;

    /** @var string $mapperClasse */
    protected $mapperClasse;

    /** @var string $entidadeClasse */
    protected $entidadeClasse;

    /** @var \Entities\DefaultEntityInterface */
    protected $entidade;

    /** @var \Mappers\DefaultMapper */
    protected $mapper;

    /** @var \Illuminate\Contracts\Foundation\Application|mixed  */
    protected $repositorio;

    public function __construct()
    {
        $this->entidade = app($this->entidadeClasse);
        $this->mapper = app($this->mapperClasse);
        $this->repositorio = app($this->repositorioClasse);
    }

    private function obterPorClassificacaoId($classificacaoId)
    {
        return $this->repositorio->obterPorClassificacaoId($classificacaoId);
    }

    private function alterarClassificacao($entidade)
    {
        /** @var integer $id */
        $id = $entidade->getId();

        return $this->repositorio->alterar($id, $entidade);
    }

    private function inserir(DefaultEntityInterface $entidade)
    {
        return $this->repositorio->inserir($entidade);
    }

    public function executar(int $classificacaoId, int $itemId)
    {

        $classificacao = $this->obterPorClassificacaoId($classificacaoId);
        if (!empty($classificacao)) {
            $this->popularEntidade($classificacao, $classificacaoId, $itemId);
            return $this->alterarClassificacao($classificacao);
        }

        /** @var DefaultEntityInterface $entidade */
        $entidade = clone $this->entidade;
        $this->popularEntidade($entidade, $classificacaoId, $itemId);

        return $this->inserir($entidade);
    }


    abstract public function popularEntidade(DefaultEntityInterface $entidade, int $classificacaoId, int $itemId);
}

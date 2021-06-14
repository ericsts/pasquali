<?php


class ClassificacaoService implements ClassificacaoServiceInterface
{
    /** @var \Repositories\Sinistros\ClassificacaoItemRepository */
    protected $classificarItemRepositorio;

    /** @var \Mappers\Sinistros\ClassificacaoItemMapperInterface */
    protected $classificarItemMapper;

    /** @var ClassificacaoItemEntity */
    protected $classificacaoItemEntidade;

    /** @var \Services\Sinistros\SinistroService */
    protected $sinistroServico;

    /** @var \Entities\Sinistros\SinistroEntity  */
    protected $sinistroEntidade;

    /** @var \Services\Sinistros\ComplementoService  */
    protected $complementoServico;


    public function __construct(
        ClassificacaoItemRepository $classificarItemRepositorio,
        ClassificacaoItemEntity $classificacaoItemEntidade,
        SinistroService $sinistroServico,
        ClassificacaoItemMapperInterface $classificarItemMapper,
        ComplementoService $complementoServico,
        SinistroEntity $sinistroEntidade
    ) {
        $this->classificarItemRepositorio = $classificarItemRepositorio;
        $this->classificacaoItemEntidade = $classificacaoItemEntidade;
        $this->sinistroServico = $sinistroServico;
        $this->sinistroEntidade = $sinistroEntidade;
        $this->classificarItemMapper = $classificarItemMapper;
        $this->complementoServico = $complementoServico;
    }

    /**
     * @inheritDoc
     * @return int|bool
     * @throws RuntimeException
     */
    public function classificarSinistros(array $dados)
    {

        if (empty($dados['sinistroId']) === false) {
            $classificacao = $this->obterPorSinistroId($dados['sinistroId']);
            if (!empty($classificacao)) {
                return $this->alterarClassificacao($dados, $classificacao);
            }
        }

        return $this->classificar($dados);
    }

    /**
     * Persistência de dados para classificar sinistro
     * @param array $item
     * @return int
     * @throws \RuntimeException
     */
    private function classificar(array $item)
    {
        if (empty($item['encomendaId']) === false) {
            $item['sinistroId'] =  $this->obterSinistroIdPorEncomendaId($item['encomendaId']);
        }

        if (empty($item['sinistroId'])) {
            $item['sinistroId'] = $this->inserirSinistro($item);
        }

        $entidadeClassificarItem = clone $this->classificacaoItemEntidade;
        $entidadeClassificarItem->setData(date('Y-m-d H:i:s'));

        $entidade = $this->classificarItemMapper->mapear($item, $entidadeClassificarItem);

        $id = $this->classificarItemRepositorio->inserir($entidade);

        if (!$id) {
            throw new RuntimeException("Erro ao classificar o sinistro_id {$entidade->getId()}");
        }

        $this->definirComplemento($id, $item);
        return $id;
    }

    /**
     * Realiza a alteração da classificação
     * @param array                                                 $dados
     * @param \Entities\Sinistros\ClassificacaoItemEntity $entidade
     * @throws \RuntimeException
     * @return boolean|integer
     */
    private function alterarClassificacao(array $dados, ClassificacaoItemEntity $entidade)
    {
        $entidade = $this->classificarItemMapper->mapear($dados, $entidade);
        $result = $this->classificarItemRepositorio->alterar($entidade->getId(), $entidade);
        if (!$result) {
            throw new RuntimeException('Ocorreu um erro ao alterar a classificação');
        }

        $this->definirComplemento($entidade->getId(), $dados);
        return $entidade->getId();
    }

    /**
     * Define e realização inserção ou alteração
     * @param int   $classificacaoId
     * @param array $item
     * @return boolean|void
     */
    private function definirComplemento(int $classificacaoId, array $item)
    {
        if (empty($item['complementoId']) || empty($item['complementoRelId'])) {
            return false;
        }

        return $this->complementoServico->definir($item['complementoId'], $classificacaoId, $item['complementoRelId']);
    }

    /** @inheritDoc */
    public function obterPorSinistroId(int $sinistroId)
    {
        return $this->classificarItemRepositorio->obterPorSinistroId($sinistroId);
    }

    /** @inheritDoc */
    public function deletar(int $id)
    {
        return $this->classificarItemRepositorio->deletar($id);
    }

    /**
     * Insere uma encomenda no status de sinistro
     * @param array $dados
     * @return integer $id
     * @throws \RuntimeException
     */
    private function inserirSinistro(array $dados)
    {

        $sinistroEntidade = clone $this->sinistroEntidade;
        $sinistroEntidade->setEncomendaId($dados['encomendaId'])
            ->setData(date('Y-m-d'))
            ->setStatus(SinistroRepositoryInterface::EM_ANDAMENTO);

        $id = $this->sinistroServico->inserir($sinistroEntidade);

        if (!$id) {
            throw new RuntimeException("Erro ao criar o sinistro com a encomenda: {$dados['encomendaId']}");
        }

        return $id;
    }

    /**
     * @inheritDoc
     */
    public function obterPorEncomendaId(int $encomendaId)
    {
        return $this->classificarItemRepositorio->obterPorEncomendaId($encomendaId);
    }

    /**
     * @inheritDoc
     */
    public function obterSinistroIdPorEncomendaId($encomendaId)
    {
        /** @var SinistroEntity $sinistroEntidade */
        $sinistroEntidade = $this->sinistroServico->obterSinistroPorEncomendaId($encomendaId);

        if (!($sinistroEntidade instanceof SinistroEntity)) {
            return null;
        }

        return $sinistroEntidade->getSinistroId();
    }

    /**
     * @inheritDoc
     */
    public function permitirExclusao(int $id, string $campo)
    {
        return $this->classificarItemRepositorio->permitirExclusao($id, $campo);
    }
}

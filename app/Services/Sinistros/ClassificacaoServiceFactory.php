<?php

class ClassificacaoServiceFactory
{
    /**
     * @return \Services\Sinistros\ClassificacaoService
     */
    public function __invoke()
    {
        /** @var ClassificacaoItemRepository $classificarItemRepository */
        $classificarItemRepository = app(ClassificacaoItemRepositoryInterface::class);

        /** @var \Services\Sinistros\SinistroService $sinistroServico */
        $sinistroServico = app(SinistroServiceInterface::class);

        $sinistroEntidade = app(SinistroEntity::class);

        /** @var ClassificacaoItemMapperInterface $classificarItemMapper */
        $classificarItemMapper = app(ClassificacaoItemMapperInterface::class);

        /** @var \Services\Sinistros\ComplementoService $complementoServico */
        $complementoServico = app(ComplementoServiceInterface::class);

        /** @var ClassificacaoItemEntity $classificarItemEntidade */
        $classificarItemEntidade = app(ClassificacaoItemEntity::class);

        return new ClassificacaoService(
            $classificarItemRepository,
            $classificarItemEntidade,
            $sinistroServico,
            $classificarItemMapper,
            $complementoServico,
            $sinistroEntidade
        );
    }
}

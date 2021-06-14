<?php

class ClassificacaoMapperAdapter extends EloquentMapperAdapter
{
    /**
     * @var array
     * {@example} ['chaveOriginal'  => 'chaveMaepada'];
     */
    protected array $mapa = [
        'classificacao_id' => 'classificacaoId',
        'responsabilidade_id' => 'responsabilidadeId',
        'sub_responsabilidade_id' => 'subResponsabilidadeId',
        'complemento_id' => 'complementoId',
        'etapa_id' => 'etapaId',
        'funcid' => 'funcionarioId',
        'sinistro_id' => 'sinistroId',
        'observacao' => 'observacao',
        'data' => 'data',
    ];
}

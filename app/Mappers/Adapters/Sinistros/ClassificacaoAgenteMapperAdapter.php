<?php


class ClassificacaoAgenteMapperAdapter extends EloquentMapperAdapter
{
    /**
     * @var array
     * {@example} ['chaveOriginal'  => 'chaveMaepada'];
     */
    protected array $mapa = [
        'agid' => 'agenteId',
        'classificacao_id' => 'classificacaoId'
    ];
}

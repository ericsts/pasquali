<?php

class ClassificacaoAgente extends Model
{
    /** @var string */
    protected $table = 'sinistros_classificacoes_agentes';

    /** @var array */
    protected $fillable = [
        'agid',
        'classificacao_id'
    ];
}

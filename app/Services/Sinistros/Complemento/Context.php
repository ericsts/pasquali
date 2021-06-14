<?php

class Context
{
    protected $estrategia;

    /**
     * Define Estratégia
     * @param string $estrategia
     * @return void
     */
    public function setEstrategia($estrategia)
    {
        $this->estrategia = app($estrategia);
    }

    /**
     * Excutar a estratégia
     * @param int $classificacaoId
     * @param int $itemId
     * @return boolean|integer
     */
    public function executar(int $classificacaoId, int $itemId)
    {
        if (empty($this->estrategia)) {
            return false;
        }

        return $this->estrategia->executar($classificacaoId, $itemId);
    }
}

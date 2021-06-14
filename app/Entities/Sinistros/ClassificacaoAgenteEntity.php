<?php


class ClassificacaoAgenteEntity extends DefaultEntity implements DefaultEntityInterface
{
    /** @var integer */
    private $id;

    /** @var integer */
    private $agenteId;

    /** @var integer */
    private $classificacaoId;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return ClassificacaoAgenteEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAgenteId()
    {
        return $this->agenteId;
    }

    /**
     * @param integer $agenteId
     * @return ClassificacaoAgenteEntity
     */
    public function setAgenteId($agenteId)
    {
        $this->agenteId = $agenteId;
        return $this;
    }

    /**
     * @return integer
     */
    public function getClassificacaoId()
    {
        return $this->classificacaoId;
    }

    /**
     * @param integer $classificacaoId
     * @return ClassificacaoAgenteEntity
     */
    public function setClassificacaoId($classificacaoId)
    {
        $this->classificacaoId = $classificacaoId;
        return $this;
    }
}

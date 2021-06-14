<?php


class ClassificacaoRequest extends DefaultRequest
{
    /** @var array */
    protected array $regras = [
        'sinistroId' => 'integer',
        'encomendaId' => 'integer',
        'etapaId' => 'integer|nullable',
        'responsabilidadeId' => 'integer|nullable',
        'subResponsabilidadeId' => 'integer|nullable',
        'complementoId' => 'integer|nullable',
        'classificacaoId' => 'integer|required',
        'funcionarioId' => 'integer|required',
    ];

    /** @var array */
    protected array $mensagens = [
        'sinistroId.required' => 'Campo sinistroId é obrigatório',
        'encomendaId.required' => 'Campo encomendaId ou sinistros é obrigatório',
        'sinistroId.integer' => 'Campo sinistroId deve ser um número inteiro',
        'encomendaId.integer' => 'Campo encomendaId deve ser um número inteiro',
        'etapaId.integer' => 'Campo etapaId deve ser um número inteiro',
        'responsabilidadeId.integer' => 'Campo responsabilidadeId deve ser um número inteiro',
        'subResponsabilidadeId.integer' => 'Campo subResponsabilidadeId deve ser um número inteiro',
        'complementoId.integer' => 'Campo complementoId deve ser um número inteiro',
        'funcionarioId.integer' => 'Campo funcionarioId deve ser um número inteiro',
        'funcionarioId.required' => 'Campo funcionarioId é obrigatório',
        'classificacaoId.integer' => 'Campo classificacaoId deve ser um número inteiro',
        'classificacaoId.required' => 'Campo classificacaoId é obrigatório',
    ];

    /**
     * Realiza validação lógica
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('encomendaId', 'required', function ($input) {
            return empty($input->sinistroId);
        });

        return $validator;
    }
}

<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleSupport\Contracts\Schemas\DocumentType as ContractsDocumentType;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentTypeData;

class DocumentType extends Unicode implements ContractsDocumentType
{
    protected string $__entity = 'DocumentType';
    public static $document_type_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'document_type',
            'tags'     => ['document_type', 'document_type-index'],
            'forever'  => true
        ]
    ];

    public function prepareStoreDocumentType(DocumentTypeData $document_type_dto): Model{
        $model = $this->prepareStoreUnicode($document_type_dto);
        return static::$document_type_model = $model;
    }

    public function documentType(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}
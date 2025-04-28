<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleSupport\{
    Supports\BaseModuleSupport
};
use Hanafalah\ModuleSupport\Contracts\Schemas\DocumentType as ContractsDocumentType;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentTypeData;
use Illuminate\Support\Str;

class DocumentType extends BaseModuleSupport implements ContractsDocumentType
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
        $model = $this->DocumentTypeModel()->updateOrCreate([
                        'id' => $document_type_dto->id ?? null
                    ], [
                        'name' => Str::upper($document_type_dto->name)
                    ]);
        return static::$document_type_model = $model;
    }

    public function storeDocumentType(?DocumentTypeData $document_type_dto = null): array{
        return $this->transaction(function() use ($document_type_dto){
            return $this->showDocumentType($this->prepareStoreDocumentType($document_type_dto ?? $this->requestDTO(DocumentTypeData::class)));
        });
    }

    public function documentType(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->DocumentTypeModel()->withParameters()
                    ->conditionals($this->mergeCondition($conditionals ?? []))
                    ->orderBy('name', 'asc');
    }
}
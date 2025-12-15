<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleSupport\{
    Supports\BaseModuleSupport
};
use Hanafalah\ModuleSupport\Contracts\Schemas\DocumentReference as ContractsDocumentReference;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentReferenceData;

class DocumentReference extends BaseModuleSupport implements ContractsDocumentReference
{
    protected string $__entity = 'DocumentReference';
    public $document_reference_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'document_reference',
            'tags'     => ['document_reference', 'document_reference-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreDocumentReference(DocumentReferenceData $document_reference_dto): Model{
        $add = [
            'name' => $document_reference_dto->name
        ];
        $guard  = ['id' => $document_reference_dto->id];
        $create = [$guard, $add];
        // if (isset($document_reference_dto->id)){
        //     $guard  = ['id' => $document_reference_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $document_reference = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($document_reference,$document_reference_dto->props);
        $document_reference->save();
        return $this->document_reference_model = $document_reference;
    }
}
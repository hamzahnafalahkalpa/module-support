<?php

namespace Hanafalah\ModuleSupport\Contracts\Schemas;

use Hanafalah\ModuleSupport\Contracts\Data\DocumentReferenceData;
//use Hanafalah\ModuleSupport\Contracts\Data\DocumentReferenceUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleSupport\Schemas\DocumentReference
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateDocumentReference(?DocumentReferenceData $document_reference_dto = null)
 * @method Model prepareUpdateDocumentReference(DocumentReferenceData $document_reference_dto)
 * @method bool deleteDocumentReference()
 * @method bool prepareDeleteDocumentReference(? array $attributes = null)
 * @method mixed getDocumentReference()
 * @method ?Model prepareShowDocumentReference(?Model $model = null, ?array $attributes = null)
 * @method array showDocumentReference(?Model $model = null)
 * @method Collection prepareViewDocumentReferenceList()
 * @method array viewDocumentReferenceList()
 * @method LengthAwarePaginator prepareViewDocumentReferencePaginate(PaginateData $paginate_dto)
 * @method array viewDocumentReferencePaginate(?PaginateData $paginate_dto = null)
 * @method array storeDocumentReference(?DocumentReferenceData $document_reference_dto = null)
 * @method Collection prepareStoreMultipleDocumentReference(array $datas)
 * @method array storeMultipleDocumentReference(array $datas)
 */

interface DocumentReference extends DataManagement
{
    public function prepareStoreDocumentReference(DocumentReferenceData $document_reference_dto): Model;
}
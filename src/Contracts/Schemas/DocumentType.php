<?php

namespace Hanafalah\ModuleSupport\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Contracts\Schemas\Unicode;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentTypeData;

/**
 * @see \Hanafalah\ModuleSupport\Schemas\DocumentType
 * @method bool deleteDocumentType()
 * @method bool prepareDeleteDocumentType(? array $attributes = null)
 * @method mixed getDocumentType()
 * @method ?Model prepareShowDocumentType(?Model $model = null, ?array $attributes = null)
 * @method array showDocumentType(?Model $model = null)
 * @method Collection prepareViewDocumentTypeList()
 * @method array viewDocumentTypeList()
 * @method array storeDocumentType(?DocumentTypeData $document_type_dto = null)
 * @method LengthAwarePaginator prepareViewDocumentTypePaginate(PaginateData $paginate_dto)
 * @method array viewDocumentTypePaginate(?PaginateData $paginate_dto = null)
 */

interface DocumentType extends Unicode
{
    public function prepareStoreDocumentType(DocumentTypeData $document_type_dto): Model;
    public function documentType(mixed $conditionals = null): Builder;
}

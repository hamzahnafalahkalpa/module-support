<?php

namespace Hanafalah\ModuleSupport\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleSupport\Contracts\Data\SupportData;

/**
 * @see \Hanafalah\ModuleSupport\Schemas\Support
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method bool deleteSupport()
 * @method bool prepareDeleteSupport(? array $attributes = null)
 * @method mixed getSupport()
 * @method ?Model prepareShowSupport(?Model $model = null, ?array $attributes = null)
 * @method array showSupport(?Model $model = null)
 * @method Collection prepareViewSupportList()
 * @method array viewSupportList()
 * @method LengthAwarePaginator prepareViewSupportPaginate(PaginateData $paginate_dto)
 * @method array viewSupportPaginate(?PaginateData $paginate_dto = null)
 * @method array storeSupport(?SupportData $support_dto = null)
 * @method Builder support(mixed $conditionals = null)
 */
interface Support extends DataManagement
{
    public function prepareStoreSupport(SupportData $support_dto): Model;
}

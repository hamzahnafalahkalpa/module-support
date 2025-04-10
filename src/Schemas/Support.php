<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Hanafalah\LaravelSupport\Concerns\Support\HasFileUpload;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Hanafalah\ModuleSupport\Contracts\Schemas\Support as ContractsSupport;
use Hanafalah\ModuleSupport\Contracts\Data\SupportData;

class Support extends PackageManagement implements ContractsSupport
{
    use HasFileUpload;

    protected string $__entity = 'Support';
    public static $support_model;
    public mixed $current_file;

    protected array $__cache = [
        'index' => [
            'name'     => 'support',
            'tags'     => ['support', 'support-index'],
            'forever'  => true
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getSupport(): mixed{
        return static::$support_model;
    }

    protected function getFile(){
        return static::$digital_model->sign ?? null;
    }

    public function prepareShowSupport(?Model $model = null, ?array $attributes = null): ?Model{
        $attributes ??= request()->all();
        $model      ??= $this->getSupport();
        if (!isset($model)) {
            $id = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('No id provided', 422);
            $model = $this->support()->with($this->showUsingRelation())->findOrFail($id);
        }else{
            $model->load($this->showUsingRelation());
        }
        return static::$support_model = $model;
    }

    public function showSupport(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowSupport($model);
        });
    }

    protected function getFileNameAttribute(): string{
        return 'current_file';
    }

    protected function pushFiles(array $paths): array{
        return $this->setupFiles($paths);
    }

    public function getCurrentFiles(): array{
        return static::$support_model->paths ?? [];
    }

    public function prepareStoreSupport(SupportData $support_dto): Model{
        $support = $this->support()->updateOrCreate([
                        'id'             => $support_dto->id ?? null,
                        'reference_type' => $support_dto->reference_type,
                        'reference_id'   => $support_dto->reference_id
                    ], [
                        'name' => $support_dto->name
                    ]);
        $this->fillingProps($support,$support_dto->props);

        if (isset($support_dto->paths) && count($support_dto->paths) > 0) {
            static::$support_model = $support;
            $support->paths = $this->pushFiles($support_dto->paths);
        }

        $support->save();   
        static::$support_model = $support;
        return $support;
    }

    public function storeSupport(?SupportData $support_dto = null): array{
        return $this->transaction(function() use ($support_dto){
            return $this->showSupport($this->prepareStoreSupport($support_dto ?? $this->requestDTO(SupportData::class)));
        });
    }

    public function prepareViewSupportList(): Collection{
        return static::$support_model = $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () {
            return $this->support()->orderBy('name', 'asc')->get();
        });
    }

    public function viewSupportList(): array{
        return $this->viewEntityResource(function() {
            return $this->prepareViewSupportList();
        });
    }

    public function prepareViewSupportPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        $this->addSuffixCache($this->__cache['index'], "support-index", 'paginate');
        return $this->cacheWhen(!$this->isSearch(), $this->__cache['index'], function () use ($paginate_dto) {
            return $this->support()->paginate(...$paginate_dto->toArray())
                        ->appends(request()->all());
        });
    }

    public function viewSupportPaginate(?PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){
            return $this->prepareViewSupportPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        }, ['rows_per_page' => [50]]);
    }

    public function prepareDeleteSupport(? array $attributes = null): bool{
        $attributes ??= \request()->all();
        if (!$attributes['id']) throw new \Exception('No id provided', 422);
        $result = $this->support()->findOrFail($attributes['id'])->delete();
        $this->flushTagsFrom('index');
        return $result;
    }

    public function deleteSupport(): bool{
        return $this->transaction(function () {
            return $this->prepareDeleteSupport();
        });
    }

    public function support(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->SupportModel()->withParameters()
                    ->conditionals($this->mergeCondition($conditionals ?? []))->orderBy('name', 'asc');
    }
}

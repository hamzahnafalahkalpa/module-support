<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Hanafalah\LaravelSupport\Concerns\Support\HasFileUpload;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleSupport\Contracts\Schemas\Support as ContractsSupport;
use Hanafalah\ModuleSupport\Contracts\Data\SupportData;

class Support extends PackageManagement implements ContractsSupport
{
    use HasFileUpload;

    protected string $__entity = 'Support';
    protected mixed $__order_by_created_at = false; //asc, desc, false
    public static $support_model;
    public mixed $current_file;

    protected array $__cache = [
        'index' => [
            'name'     => 'support',
            'tags'     => ['support', 'support-index'],
            'duration' => 24 * 60
        ]
    ];

    protected function pushFiles(array $paths): array{
        return $this->setupFiles($paths);
    }

    public function getCurrentFiles(): array{
        return static::$support_model->paths ?? [];
    }

    public function prepareStoreSupport(SupportData $support_dto): Model{
        $support = $this->SupportModel()->updateOrCreate([
                        'id'             => $support_dto->id ?? null,
                    ], [
                        'reference_type' => $support_dto->reference_type,
                        'reference_id'   => $support_dto->reference_id,
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
}

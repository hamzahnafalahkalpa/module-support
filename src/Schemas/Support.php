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
    public $support_model;
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
        return $this->support_model->paths ?? [];
    }

    public function prepareStoreSupport(SupportData $support_dto): Model{
        $support = $this->SupportModel()->updateOrCreate([
                        'id'             => $support_dto->id ?? null,
                    ], [
                        'reference_type' => $support_dto->reference_type,
                        'reference_id'   => $support_dto->reference_id,
                        'name' => $support_dto->name
                    ]);

        $attributes['files'] = $this->mustArray($attributes['files']);
        $attributes['paths'] ??= [];
        $driver = config('filesystems.default','public');
        foreach ($attributes['files'] as $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $filename = $file->getClientOriginalName();
                $data     = [$target_path, $file, $filename];
                $attributes['paths'][] = Storage::disk($driver)->putFileAs(...$data);
            } else {
                if (isset($attributes['id'])) {
                    $file = Str::replace(medical_support_url(''),'',$file);
                    $attributes['paths'][] = $file;
                }
            }
        }
        $paths = $this->assessment_model->paths ?? [];
        if (count($paths) > 0) {
            $diff  = array_diff($paths, $attributes['files']);
            if (isset($diff) && count($diff) > 0) {
                foreach ($diff as $path) if (Storage::disk($driver)->exists($path)) Storage::disk($driver)->delete($path);
            }
        }
        $attributes['files'] = [];
        return $attributes;

        $this->fillingProps($support,$support_dto->props);
        if (isset($support_dto->paths) && count($support_dto->paths) > 0) {
            $this->support_model = $support;
            $support->paths = $this->pushFiles($support_dto->paths);
        }

        $support->save();   
        $this->support_model = $support;
        return $support;
    }
}

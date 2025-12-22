<?php

namespace Hanafalah\ModuleSupport\Schemas;

use Hanafalah\LaravelSupport\Concerns\Support\HasFileUpload;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleSupport\Contracts\Schemas\Support as ContractsSupport;
use Hanafalah\ModuleSupport\Contracts\Data\SupportData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SupportBackup extends PackageManagement implements ContractsSupport
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
        if (isset($support_dto->props['files']) || isset($support_dto->props['paths']) ){
            $support_dto->props['paths'] ??= [];
            $support_dto->props['target_path'] ?? '/support';
            $driver = config('filesystems.default','public');
            if (isset($support_dto->props['files'])){
                $support_dto->props['files'] = $this->mustArray($support_dto->props['files']);
                $paths = $this->pushFiles($support_dto->props['files']);
                $support_dto->props['paths'] = $paths;
                unset($support_dto->props['files']);
                // $driver = config('filesystems.default','public');
                // $target_path = $support_dto->props['target_path'] ?? '/support';
                // foreach ($support_dto->props['files'] as $file) {
                //     if ($file instanceof \Illuminate\Http\UploadedFile) {
                //         $filename = $file->getClientOriginalName();
                //         $data     = [$target_path, $file, $filename];
                //         $support_dto->props['paths'][] = Storage::disk($driver)->putFileAs(...$data);
                //     } else {
                //         if (isset($support_dto->id)) {
                //             $file = Str::replace($target_path,'',$file);
                //             $support_dto->props['paths'][] = $file;
                //         }
                //     }
                // }
            }
            $paths = $support->paths ?? [];
            if (count($paths) > 0) {
                $diff  = array_diff($paths, $support_dto->props['paths']);
                if (isset($diff) && count($diff) > 0) {
                    foreach ($diff as $path) if (Storage::disk($driver)->exists($path)) Storage::disk($driver)->delete($path);
                }
            }
            $support_dto->props['files'] = [];
        }
        $this->fillingProps($support, $support_dto->props);
        $support->save();
        $this->support_model = $support;
        return $support;
    }
}

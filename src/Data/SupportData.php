<?php

namespace Hanafalah\ModuleSupport\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleSupport\Contracts\Data\SupportData as DataSupportData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Illuminate\Support\Str;

class SupportData extends Data implements DataSupportData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('author_type')]
    #[MapName('author_type')]
    public ?string $author_type = null;

    #[MapInputName('author_id')]
    #[MapName('author_id')]
    public mixed $author_id = null;

    #[MapInputName('paths')]
    #[MapName('paths')]
    public ?array $paths = [];

    #[MapInputName('is_chunk')]
    #[MapName('is_chunk')]
    public ?bool $is_chunk = false;

    #[MapInputName('props')]
    #[MapName('props')]
    public mixed $props = [];

    public static function before(?array &$attributes){
        if (isset($attributes['is_chunk']) && $attributes['is_chunk']){
            $attributes['progress'] ??= 0;
            if ($attributes['progress'] == 0){
                $total_size = $attributes['total_size'] ??= 0;
                if ($total_size == 0) throw new \Exception('Total size is required for chunked upload');
                if (!isset($attributes['mimetype'])) throw new \Exception('Mimetype is required for chunked upload');
                $attributes['chunk_size'] ??= 1048576;
                $attributes['total_chunks'] = ceil($total_size / $attributes['chunk_size']);
                $attributes['status'] = 'PENDING';
                $attributes['total_size'] = intval($total_size);
                $attributes['upload_id'] ??= Str::orderedUuid()->toString();
            }
        }
    }

    public static function after(SupportData $data): SupportData{
        $data->props['prop_author'] = [
            'id'   => null,
            'name' => null
        ];
        if (isset($data->author_type,$data->author_id)){
            $reference = static::new()->{$data->author_type.'Model'}()::findOrFail($data->author_id);
            $data->props['prop_author'] = [
                'id'   => $reference->getKey(),
                'name' => $reference->name ?? null
            ];
        }
        return $data;
    }
}

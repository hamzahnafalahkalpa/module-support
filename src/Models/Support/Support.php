<?php

namespace Hanafalah\ModuleSupport\Models\Support;

use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Concerns\Support\HasFileUpload;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleSupport\Resources\Support\{
    ViewSupport,
    ShowSupport
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Support extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes, HasFileUpload;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $list = ['id', 'name', 'reference_type' , 'reference_id', 'props'];
    protected $casts = [
        'name' => 'string'
    ];

    public function getViewResource()
    {
        return ViewSupport::class;
    }

    public function getShowResource()
    {
        return ShowSupport::class;
    }

    public function reference(){return $this->morphTo();}
}

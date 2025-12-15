<?php

namespace Hanafalah\ModuleSupport\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleSupport\Resources\DocumentReference\{
    ViewDocumentReference,
    ShowDocumentReference
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class DocumentReference extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'name',
        'reference_type',
        'reference_id',
        'document_type_id',
        'props',
    ];

    protected $casts = [
        'name' => 'string',
        'reference_type' => 'string',
        'reference_id' => 'string',
        'document_type_id' => 'string'
    ];

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return ['reference','documentType'];
    }

    public function getViewResource(){
        return ViewDocumentReference::class;
    }

    public function getShowResource(){
        return ShowDocumentReference::class;
    }

    public function reference(){return $this->morphTo();}
    public function documentType(){return $this->belongsTo('DocumentType');}
}

<?php

namespace Hanafalah\ModuleSupport\Models;

use Hanafalah\LaravelSupport\Models\Unicode\Unicode;
use Hanafalah\ModuleSupport\Resources\DocumentType\{
    ViewDocumentType,
    ShowDocumentType
};

class DocumentType extends Unicode
{
    protected $table = 'unicodes';

    public function getViewResource(){return ViewDocumentType::class;}
    public function getShowResource(){return ShowDocumentType::class;}
}

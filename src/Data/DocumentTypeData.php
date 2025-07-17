<?php

namespace Hanafalah\ModuleSupport\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentTypeData as DataDocumentTypeData;

class DocumentTypeData extends UnicodeData implements DataDocumentTypeData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'DocumentType';
        parent::before($attributes);
    }
}
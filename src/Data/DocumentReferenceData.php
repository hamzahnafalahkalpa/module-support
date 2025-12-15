<?php

namespace Hanafalah\ModuleSupport\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleSupport\Contracts\Data\DocumentReferenceData as DataDocumentReferenceData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class DocumentReferenceData extends Data implements DataDocumentReferenceData
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

    #[MapInputName('document_type_id')]
    #[MapName('document_type_id')]
    public mixed $document_type_id = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
}
<?php

namespace Hanafalah\ModuleSupport\Controllers\API\DocumentType;

use Hanafalah\ModuleSupport\Contracts\Schemas\DocumentType;
use Hanafalah\ModuleSupport\Controllers\API\ApiController;
use Hanafalah\ModuleSupport\Requests\API\DocumentType\{
    ViewRequest, StoreRequest, DeleteRequest
};

class DocumentTypeController extends ApiController{
    public function __construct(
        protected DocumentType $__documenttype_schema
    ){
        parent::__construct();
    }

    public function index(ViewRequest $request){
        return $this->__documenttype_schema->viewDocumentTypeList();
    }

    public function store(StoreRequest $request){
        return $this->__documenttype_schema->storeDocumentType();
    }

    public function destroy(DeleteRequest $request){
        return $this->__documenttype_schema->deleteDocumentType();
    }
}
<?php

namespace Hanafalah\ModuleSupport\Resources\DocumentReference;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewDocumentReference extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'id'                => $this->id, 
      'name'              => $this->name, 
      'reference_type'    => $this->reference_type, 
      'reference_id'      => $this->reference_id,
      'reference'         => $this->relationValidation('reference',function(){
        return $this->reference->toViewApi()->resolve();
      },$this->prop_reference),
      'document_type_id'  => $this->document_type_id, 
      'document_type'     => $this->relationValidation('documentType',function(){
        return $this->documentType->toViewApi()->resolve();
      },$this->prop_document_type)
    ];
    return $arr;
  }
}

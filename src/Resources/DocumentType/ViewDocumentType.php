<?php

namespace Hanafalah\ModuleSupport\Resources\DocumentType;

use Hanafalah\LaravelSupport\Resources\Unicode\ViewUnicode;

class ViewDocumentType extends ViewUnicode
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
      'dynamic_forms' => $this->dynamic_forms,
    ];
    $arr = $this->mergeArray(parent::toArray($request),$arr);
    return $arr;
  }
}

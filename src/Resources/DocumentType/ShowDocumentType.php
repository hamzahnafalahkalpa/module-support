<?php

namespace Hanafalah\ModuleSupport\Resources\DocumentType;

use Hanafalah\LaravelSupport\Resources\Unicode\ShowUnicode;

class ShowDocumentType extends ViewDocumentType
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
    ];
    $show = $this->resolveNow(new ShowUnicode($this));
    $arr = $this->mergeArray(parent::toArray($request),$show,$arr);
    return $arr;
  }
}

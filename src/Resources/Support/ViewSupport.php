<?php

namespace Hanafalah\ModuleSupport\Resources\Support;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewSupport extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $paths = $this->paths;
    $paths ??= [];
    foreach ($paths as &$path) {
      $path = support_asset($path);
    }
    $arr = [
      'id'          => $this->id,
      'name'        => $this->name,
      'paths'       => $this->paths,
      'author'      => $this->prop_author,
      'paths'       => $paths,
      'created_at'  => $this->created_at,
      'updated_at'  => $this->updated_at
    ];
    
    // $arr = $this->mergeArray(parent::toArray($request),$arr);
    // $paths_urls = [];
    // if (isset($this->paths)){
    //   foreach ($this->paths as $path) $paths_urls[] = $this->getFullUrl($path);
    // }
    // $arr['url_paths'] = $paths_urls;
    return $arr;
  }
}

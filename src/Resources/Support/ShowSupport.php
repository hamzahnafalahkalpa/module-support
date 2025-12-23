<?php

namespace Hanafalah\ModuleSupport\Resources\Support;

class ShowSupport extends ViewSupport
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    if (isset($this->is_presigned) && $this->is_presigned){
      $arr = [
        'import_setup' => [
          'upload_id'    => $this->upload_id,
          'filename'     => $this->filename,
          'chunk_size'   => $this->chunk_size,
          'total_size'   => $this->total_size,
          'total_chunks' => $this->total_chunks,
          'progress'     => $this->progress,
          'status'       => $this->status,
          'mimetype'     => $this->mimetype,
          'is_presigned'  => $this->is_presigned,
          'target_path'  => $this->target_path,
          'chunk_path'  => $this->chunk_path,
          'chunks'     => $this->chunks,
        ]
      ];
    }else{
      $arr = [
        'import_setup' => null
      ];
    }
    $arr = $this->mergeArray(parent::toArray($request), $arr);
    return $arr;
  }
}

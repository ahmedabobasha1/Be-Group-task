<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $nameAttribute = 'name_' . request()->header('lang');
        return [
            'store_name' =>$this->store->$nameAttribute,
            'category_name' => $this->store->category->$nameAttribute,
            'logo'=>url("/images/store/logo/".$this->logo),
            'branch_name' => $this->$nameAttribute,
        ];
    }
}

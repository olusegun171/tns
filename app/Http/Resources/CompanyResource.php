<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'year_founded' => $this->year_founded,
            'street_address' => $this->street_address,
            'city'  => $this->city,
            'state'  => $this->state,
            'zip_code'   =>  $this->zip_code,
            'country' => $this->country,
            'last_updated' => $this->updated_at,
            'contacts' => $this->contacts
        ];
        
    }
}

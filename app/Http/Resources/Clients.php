<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Clients extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'birthdate' => $this->birthdate,
            'address' => $this->address,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'zipcode' => $this->zipcode,
            'created_at' => $this->created_at,
        ];
    }
}

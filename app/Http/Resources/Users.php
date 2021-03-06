<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Users extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'email' => $this->email,
            'password' => $this->password,
            'nominatedPassword' => $this->nominatedPassword
        ];
    }
}

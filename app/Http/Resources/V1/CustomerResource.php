<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\InvoiceResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // choose that data returned in api/customers/1234
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postal_code,
            // invoices are passed only when queried : &includeInvoices=true
            'invoices' => InvoiceResource::collection($this->whenLoaded(('invoices')))
            // times are not sent
        ];
    }
}

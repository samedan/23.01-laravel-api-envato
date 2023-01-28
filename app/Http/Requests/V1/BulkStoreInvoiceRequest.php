<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // * means an array of data: [ {}, {}, ... {}], not data: [ {}, {}... {}]
        return [
            '*.customerId'=>['required', 'integer'],
            '*.amount'=>['required', 'numeric'],            
            '*.status'=>['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])], // Billed, Paid, Void
            '*.billedDate'=>['required', 'date_format:Y-m-d H:i:s'],
            '*.paidDate'=>[ 'date_format:Y-m-d H:i:s', 'nullable'],
        ];
    }

    // postalCode -> postal_code
    protected function prepareForValidation() {
        // iterate on, the element of array of {}
        $data = [];
        // prepare the data to be later validated
        foreach($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;

            $data[] = $obj;
        }
        $this ->merge($data);

        
    }
}

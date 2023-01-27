<?php 

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter {

    // /api/v1/invoices?status[ne]=P
    protected $safeParms = [
      'customerId' => ['eq'],
      'amount' => ['eq', 'lt', 'gt', 'gte', 'lte'],
      'status' => ['eq', 'ne'], // ne = NotEqual
      'billedDate' => ['eq', 'lt', 'gt', 'gte', 'lte'],
      'paidDate' => ['eq', 'lt', 'gt', 'gte', 'lte']
     
    ];

    // transforms postalCode to postal_code
    protected $columnMap = [
      'customerId' => 'customer_id',
      'billedDate' => 'billed_date',
      'paidDate' => 'paid_date',
    ];

    // Operators use by eloquent
    protected $operatorMap = [
      'eq' =>'=',
      'lt' =>'<',
      'lte' =>'≤',
      'gt' =>'>',
      'gte' =>'≥',
      'ne'=>'!='
    ];

    


}

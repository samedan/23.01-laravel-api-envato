<?php 

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter {
    protected $safeParms = [
      'name' => ['eq'],
      'type' => ['eq'],
      'email' => ['eq'],
      'address' => ['eq'],
      'city' => ['eq'],
      'state' => ['eq'],
      'postalCode' => ['eq', 'gt', 'lt'] // gt=greateeThan, lt=lowerThan
    ];

    // transforms postalCode to postal_code
    protected $columnMap = [
      'postalCode' => 'postal_code'
    ];

    // Operators use by eloquent
    protected $operatorMap = [
      'eq' =>'=',
      'lt' =>'<',
      'lte' =>'≤',
      'gt' =>'>',
      'gte' =>'≥'
    ];

    


}

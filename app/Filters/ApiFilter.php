<?php 

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParms = [];

    // transforms postalCode to postal_code
    protected $columnMap = [];

    // Operators use by eloquent
    protected $operatorMap = [];

    public function transform(Request $request) {
      $eloQuery = [];

      // check the parameters($parms) and operators than are used in search
      foreach($this->safeParms as $parm => $operators) {
        $query=$request->query($parm);

        if(!isset($query)) {
          continue;
        }

        // choose which column to search into
        $column = $this->columnMap[$parm] ?? $parm; // look to see if Renamed Columns
        foreach($operators as $operator) {
          if(isset($query[$operator])) { // if operator is allowed
            // add element=[column, operator, value] to eloQuery
            $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
            // $el = [city, eq, Paris] 
            // url -> /api/v1/customers?postalCode[gt]=30000&type[eq]=I

          }
        }

      }

      return $eloQuery;
    }


}

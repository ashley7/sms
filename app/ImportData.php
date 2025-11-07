<?php

namespace App;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class ImportData implements ToCollection
{
    public function collection(Collection $rows)
    {
    
        foreach ($rows as $row) {

            $saveCustomer = new Customer();

            $saveCustomer->name = $row[0];

            $saveCustomer->phone_number = $row[1];

            $saveCustomer->group = $row[2];

            $saveCustomer->save();

        }
         
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

 /**
     * @return \Illuminate\Support\Collection
     */
class FormExport implements FromCollection, Responsable
{
    use Exportable;
    protected $results;

    function __construct($results)
    {
        $this->results = $results;
    }
    /**
    * Optional headers
    */

    public function collection()
    {
        $data = [];
        $results =  $this->results;
        $i = 0;
        foreach ($results as $res) {
            $data[$i]['form_name'] = ($res->form_name) ? $res->form_name : '';
            $data[$i]['name'] =($res->name) ? $res->name : ''; 
            $data[$i]['email'] = ($res->email) ? $res->email : '';
            $data[$i]['phone'] =($res->phone) ? $res->phone : '';
            $data[$i]['created_at'] = $res->created_at;

            $i++;
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Form',
            'Page',
            'Name',
            'Mobile',
            'Email',
            'Created At',
        ];
    }
}


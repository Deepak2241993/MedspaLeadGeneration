<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class HeaderOnlyExport implements WithHeadings
{
    /**
     * Return the header row as an array.
     */
    public function headings(): array
    {
        return [
            'First Name',  
            'Last Name',
            'Email',
            'Country Code',
            'Phone',
            'Source',
        ];
    }
}

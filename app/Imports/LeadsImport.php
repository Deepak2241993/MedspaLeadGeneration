<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\CommonModel;
use Illuminate\Support\Facades\Log;

class LeadsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        Log::info('Processing CSV file, total rows: ' . $rows->count());

        // Initialize the API model
        $api = new CommonModel();

        // Skip the header row and process each row
        foreach ($rows->skip(1) as $index => $row) {
            Log::info("Processing row #{$index}", $row->toArray());

            // Prepare the data array from the CSV row
            $data_arr = [
                'first_name'   => $row[0] ?? '',
                'last_name'    => $row[1] ?? '',
                'email'        => $row[2] ?? '',
                'country_code' => isset($row[3]) ? '+' . $row[3] : '',
                'phone'        => $row[4] ?? '',
                'source'       => $row[5] ?? 'Unknown',
                'message'      => 'Lead From CSV File',
            ];

            // Convert the data array to JSON for API submission
            $data = json_encode($data_arr);

            try {
                // Post the data to the lead capture API
                $result = $api->postAPI('lead/capture', $data);

                // Log the API response
                if (isset($result['status']) && $result['status'] == 'error') {
                    Log::error('Error importing lead', ['row' => $index, 'message' => $result['responseMessage']]);
                } else {
                    Log::info('Lead imported successfully', ['row' => $index, 'message' => $result['responseMessage'] ?? 'No response message']);
                }
            } catch (\Exception $e) {
                // Log unexpected errors for this row
                Log::error('Exception while importing lead', ['row' => $index, 'error' => $e->getMessage()]);
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportController extends Controller
{
    private string $csvFilePath;
    
    /**
     * @param string $csvFilePath
     */
    public function __construct(string $csvFilePath)
    {
        $this->csvFilePath = $csvFilePath; 
    }

    private function validatePathFile()
    {
        if (!file_exists($this->csvFilePath)) {
            return 'CSV file not found at ' . $this->csvFilePath;
        }
    }

    private function saveCsvData(array $csvRowProperties)
    {
        Hotel::create([
            'hotel_name' => $csvRowProperties['hotel_name'],
            'image_url' => $csvRowProperties['image'],
            'city' => $csvRowProperties['city'],
            'adress' => $csvRowProperties['address'],
            'description' => $csvRowProperties['description'],
            'stars' => $csvRowProperties['stars'],
            'latitude' => $csvRowProperties['latitude'],
            'longitude' => $csvRowProperties['longitude'],
        ]);
    }

    /**
     * Process CSV file
     * 
     * @param array $csvRowProperties
     * @return string|Throwable
     */
    public function processCsvFile()
    {
        $this->validatePathFile();
                        
        try {
            SimpleExcelReader::create($this->csvFilePath)
                ->useDelimiter(';')
                ->headersToSnakeCase()
                ->getRows()
                ->each(function(array $csvRowProperties) {
                    $this->saveCsvData($csvRowProperties);
                }
            );

            return 'CSV Successfull imported';
        } catch (\Throwable $th) {
            return 'An error occurred during CSV import: ' . $th->getMessage();
        }
    }

    
}

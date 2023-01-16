<?php

namespace App\Console\Commands;

use App\Http\Controllers\ImportController;
use Illuminate\Console\Command;

class hotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:hotels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CSV hotels file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //For now it can stay here, but it should be more dinamic
        //like a search on csv folder and show all files there, 
        //giving to the user the option to select the right file
        $csvFilePath = base_path().'/public/csv/hotels.csv';

        $importController = new ImportController($csvFilePath);
        $resultMsg = $importController->processCsvFile();

        $this->info($resultMsg);

        return 0;
    }
}
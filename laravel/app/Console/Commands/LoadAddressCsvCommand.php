<?php

namespace App\Console\Commands;

use App\UseCase\AddressHttp\CsvAction;
use Illuminate\Console\Command;

class LoadAddressCsvCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address-csv:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '住所CSVを読み込む';

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
    public function handle(CsvAction $csv)
    {
        $csv->handle();

        return parent::SUCCESS;
    }
}

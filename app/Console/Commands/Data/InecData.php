<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use App\Jobs\Data\GeneratePuData;
use App\Jobs\Data\GenerateLgasData;
use App\Jobs\Data\GenerateWardsData;
use App\Jobs\Data\GenerateStatesData;

class InecData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inecdata:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command helps convert all the INEC data in /storage/app/data into Database records.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        switch ($name) {
            case 'state':
                GenerateStatesData::dispatch();
                $this->info('States generated!');
                break;
            case 'lga':
                GenerateLgasData::dispatch();
                $this->info('LGAs generated!');
                break;
            case 'ward':
                GenerateWardsData::dispatch();
                $this->info('Wards generated!');
                break;
            case 'polling-unit':
                GeneratePuData::dispatch();
                $this->info('Polling units generated!');
                break;
            
            default:
                $this->error('No data named'.$name.'!');
                return Command::FAILURE;
                break;
        }
        return Command::SUCCESS;
    }
}

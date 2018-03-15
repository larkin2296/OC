<?php

use Illuminate\Database\Seeder;
use App\Repositories\Models\ReportTab;

class ReportTabe extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Truncating ReportTab tables');
        $this->truncateTables();
 
        $config = config('seeder.report.tab');

        $this->createData($config);
    }

    private function createData($config)
    {
    	foreach($config as $key => $value) {
    		ReportTab::create($value);
        }
    }

    private function truncateTables()
    {
    	Schema::disableForeignKeyConstraints();
        ReportTab::truncate();
        Schema::enableForeignKeyConstraints();
    }


}

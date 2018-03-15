<?php

namespace App\Listeners\Report\Value;

use App\Events\Report\Value\SetRedundanceData;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Interfaces\ReportValuesRepository;

class SetRedundanceDataListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $reportValueRepo;

    public function __construct(
        ReportValuesRepository $reportValueRepo
    )
    {
        $this->reportValueRepo = $reportValueRepo;
    }

    /**
     * Handle the event.
     *
     * @param  SetRedundanceData  $event
     * @return void
     */
    public function handle(SetRedundanceData $event)
    {
        $companyId = $event->companyId;
        $reportId = $event->reportId;
        $data = $event->data;

        if( $data ) {
            foreach( $data as $field => $value ) {
                $attributes = [
                    'company_id' => $companyId,
                    'report_id' => $reportId,
                    'report_tab_id' => getReportTabValue('overview'),
                    'col' => 0,
                    'col_name' => '',
                    'is_table' => getCommonCheckValue(false),
                    'table_alias' => 0,
                    'table_row_id' => 0,
                    'name' => $field,
                ];

                $values = [
                    'value' => $value,
                ];
                $this->reportValueRepo->updateOrCreate($attributes, $values);

            }
        }

    }
}

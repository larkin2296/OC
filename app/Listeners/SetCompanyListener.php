<?php

namespace App\Listeners;

use App\Events\SetCompany;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Interfaces\CompanyRepository;

class SetCompanyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SetCompany  $event
     * @return void
     */
    public function handle(SetCompany $event)
    {
        $model = $event->model;
        $companyId = $event->companyId;
        $bool = $event->bool;

        if($bool) {
            $company = app(CompanyRepository::class)->find($companyId);
            $model->company_name = $company->name;
        }
        
        $model->company_id = $companyId;
        $model->save();
    }
}

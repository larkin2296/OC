<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RoleRepository::class, \App\Repositories\Eloquents\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PermissionRepository::class, \App\Repositories\Eloquents\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\MenuRepository::class, \App\Repositories\Eloquents\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CompanyRepository::class, \App\Repositories\Eloquents\CompanyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\DictionariesRepository::class, \App\Repositories\Eloquents\DictionariesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RecursiveRelationRepository::class, \App\Repositories\Eloquents\RecursiveRelationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\MailRepository::class, \App\Repositories\Eloquents\MailRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\Interfaces\SubdictionariesRepository::class, \App\Repositories\Eloquents\SubdictionariesRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\Interfaces\DrugLibraryRepository::class, \App\Repositories\Eloquents\DrugLibraryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\WorkflowRepository::class, \App\Repositories\Eloquents\WorkflowRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\WorkflowNodeRepository::class, \App\Repositories\Eloquents\WorkflowNodeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\WorkflowNodeDetailRepository::class, \App\Repositories\Eloquents\WorkflowNodeDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\RegulationRepository::class, \App\Repositories\Eloquents\RegulationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ReportValuesRepository::class, \App\Repositories\Eloquents\ReportValuesRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\Interfaces\QuestionRepository::class, \App\Repositories\Eloquents\QuestionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\QuestioningRepository::class, \App\Repositories\Eloquents\QuestioningRepositoryEloquent::class);

        $this->app->bind(\App\Repositories\Interfaces\SourceRepository::class, \App\Repositories\Eloquents\SourceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CategoryRepository::class, \App\Repositories\Eloquents\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ReportTabRepository::class, \App\Repositories\Eloquents\ReportTabRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ReportTaskRepository::class, \App\Repositories\Eloquents\ReportTaskRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\DataTraceRepository::class, \App\Repositories\Eloquents\DataTraceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ReportMainpageRepository::class, \App\Repositories\Eloquents\ReportMainpageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\SupervisionRepository::class, \App\Repositories\Eloquents\SupervisionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\AttachmentRepository::class, \App\Repositories\Eloquents\AttachmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\LogisticsRepository::class, \App\Repositories\Eloquents\LogisticsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\AttachmentModelRepository::class, \App\Repositories\Eloquents\AttachmentModelRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\EnterpriseRepository::class, \App\Repositories\Eloquents\EnterpriseRepositoryEloquent::class);
        //:end-bindings:
        /*OC*/
        $this->app->bind(\App\Repositories\Interfaces\OcloginRepository::class, \App\Repositories\Eloquents\OcloginRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ManagementRepository::class, \App\Repositories\Eloquents\ManagementRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PurchaseRepository::class, \App\Repositories\Eloquents\PurchaseRepositoryEloquent::class);
        //$this->app->bind(\App\Repositories\Interfaces\PurchaseRepository::class, \App\Repositories\Eloquents\PurchaseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\OilCardRepository::class, \App\Repositories\Eloquents\OilCardRepositoryEloquent::class);
<<<<<<< HEAD
        $this->app->bind(\App\Repositories\Interfaces\SupplierRepository::class, \App\Repositories\Eloquents\SupplierRepositoryEloquent::class);
=======
        $this->app->bind(\App\Repositories\Interfaces\PlatformConfigRepository::class, \App\Repositories\Eloquents\PlatformConfigRepositoryEloquent::class);
>>>>>>> ccedf1c5ac598a2983494a6810f27a6b6c8fc217
    }
}

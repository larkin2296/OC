<?php 

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\DrugLibraryRepository;
use App\Repositories\Interfaces\LogisticsRepository;
use App\Repositories\Interfaces\RegulationRepository;
use App\Repositories\Interfaces\QuestionRepository;
use App\Repositories\Interfaces\SourceRepository;
//use App\Repositories\Interfaces\SupplierRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Interfaces\RoleRepository;
use App\Repositories\Interfaces\PermissionRepository;
use App\Repositories\Interfaces\MenuRepository;
use App\Repositories\Interfaces\CompanyRepository;
use App\Repositories\Interfaces\DictionariesRepository;
use App\Repositories\Interfaces\SubdictionariesRepository;
use App\Repositories\Interfaces\RecursiveRelationRepository;
use App\Repositories\Interfaces\WorkflowRepository;
use App\Repositories\Interfaces\WorkflowNodeRepository;
use App\Repositories\Interfaces\QuestioningRepository;
use App\Repositories\Interfaces\MailRepository;
use App\Repositories\Interfaces\ReportTabRepository;
use App\Repositories\Interfaces\ReportValuesRepository;
use App\Repositories\Interfaces\ReportTaskRepository;
use App\Repositories\Interfaces\ReportMainpageRepository;
use App\Repositories\Interfaces\AttachmentRepository;
use App\Repositories\Interfaces\DataTraceRepository;
use App\Repositories\Interfaces\EnterpriseRepository;
/*OC*/
use App\Repositories\Interfaces\OcloginRepository;
use App\Repositories\Interfaces\ManagementRepository;
use App\Repositories\Interfaces\PurchaseRepository;
use App\Repositories\Interfaces\PurchasingRepository;
use App\Repositories\Interfaces\OilCardRepository;
<<<<<<< HEAD
use App\Repositories\Interfaces\SupplierRepository;
=======
use App\Repositories\Interfaces\PlatformConfigRepository;
>>>>>>> ccedf1c5ac598a2983494a6810f27a6b6c8fc217


class Service
{
	public $userRepo;
	public $roleRepo;
	public $permissionRepo;
	public $menuRepo;
	public $companyRepo;
	public $dictionariesRepo;
    public $subdictionariesRepo;
	public $recursiveRelationRepo;
	public $drugRepo;
	public $workflowRepo;
	public $workflowNodeRepo;
	public $regulaRepo;
    public $questionRepo;
    public $questioningRepo;
    public $mailRepo;
    public $cateRepo;
    public $reportTabRepo;
    public $reportValueRepo;
    public $sourceRepo;
    public $reportTaskRepo;
    public $reportMainpageRepo;
    public $attachmentRepo;
    public $logisticsRepo;
    public $dataTraceRepo;
    public $enterpriseRepo;
    /*OC*/
    public $ocloginRepo;
    public $managementRepo;
    public $purchaseRepo;
    public $oilcardbindingRepo;
<<<<<<< HEAD
    public $supplierRepo;

=======
    public $platformRepo;
>>>>>>> ccedf1c5ac598a2983494a6810f27a6b6c8fc217
	public function __construct()
	{
		$this->userRepo = app(UserRepository::class);
		$this->roleRepo = app(RoleRepository::class);
		$this->permissionRepo = app(PermissionRepository::class);
		$this->menuRepo = app(MenuRepository::class);
		$this->companyRepo = app(CompanyRepository::class);
		$this->dictionariesRepo = app(DictionariesRepository::class);
		$this->recursiveRelationRepo = app(RecursiveRelationRepository::class);
		$this->subdictionariesRepo = app(SubdictionariesRepository::class);
		$this->drugRepo = app(DrugLibraryRepository::class);
		$this->workflowRepo = app(WorkflowRepository::class);
		$this->workflowNodeRepo = app(WorkflowNodeRepository::class);
		$this->regulaRepo = app(RegulationRepository::class);
		$this->questionRepo = app(QuestionRepository::class);
        $this->questioningRepo = app(QuestioningRepository::class);
        $this->mailRepo = app(MailRepository::class);
        $this->cateRepo = app(CategoryRepository::class);
        $this->reportTabRepo = app(ReportTabRepository::class);
        $this->reportValueRepo = app(ReportValuesRepository::class);
        $this->sourceRepo = app(SourceRepository::class);
        $this->reportTaskRepo = app(ReportTaskRepository::class);
        $this->reportMainpageRepo = app(ReportMainpageRepository::class);
        $this->attachmentRepo = app(AttachmentRepository::class);
        $this->logisticsRepo = app(LogisticsRepository::class);
        $this->dataTraceRepo = app(DataTraceRepository::class);
        $this->enterpriseRepo = app(EnterpriseRepository::class);
        /*OC*/
        $this->ocloginRepo = app(OcloginRepository::class);
        $this->managementRepo = app(ManagementRepository::class);
        $this->purchaseRepo = app(PurchaseRepository::class);
        $this->oilcardbindingRepo = app(OilCardRepository::class);
<<<<<<< HEAD
        $this->supplierRepo = app(SupplierRepository::class);
=======
        $this->platformRepo = app(PlatformConfigRepository::class);
>>>>>>> ccedf1c5ac598a2983494a6810f27a6b6c8fc217
    }
}
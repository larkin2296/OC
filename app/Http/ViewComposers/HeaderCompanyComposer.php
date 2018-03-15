<?php 

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Interfaces\CompanyRepository;

class HeaderCompanyComposer 
{
	public function __construct()
	{
		$this->companyRepo = app(CompanyRepository::class);
	}

	/*输出数据 */
	public function compose(View $view)
	{	
		/*顶部公司*/
		$headerCompanies = $this->companyRepo->all()->keyBy('id');
		$view->with('headerCompanies', $headerCompanies);

		$companyId = getCompanyId();

		$currentCompanyName = isset($headerCompanies[$companyId]) && $headerCompanies[$companyId] ? $headerCompanies[$companyId]->name : '管理员界面';
		$view->with('currentCompanyName', $currentCompanyName);

		// $currentCompanyLogo = isset($headerCompanies[$companyId]) && $headerCompanies[$companyId] ? $headerCompanies[$companyId]->logo : '管理员界面';
		// $view->with('currentCompanyLogo', $currentCompanyLogo);
	}
}
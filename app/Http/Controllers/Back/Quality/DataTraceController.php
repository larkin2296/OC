<?php
/**
 * 稽查管理
 * hsky
 * 2018-1-26
 */

namespace App\Http\Controllers\Back\Quality;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\DataTraceService as Service;
use Illuminate\Validation\Rule;

class DataTraceController extends Controller
{
    use ControllerTrait;

	use EncryptTrait;

	/*模板文件夹*/
    protected $folder = 'back.quality.datatrace';

    protected $routePrefix = 'admin.datatrace';

    protected $encryptConnection = 'datatrace';

    protected $service;

    public function __construct(Service $service)
    {
    	$this->service = $service;

        $this->setEncryptConnection($this->encryptConnection);
    }

    /**
     * 稽查管理
     * @return [type] [description]
     */
    public function index()
    {
        if( request()->ajax() ) {
            return $this->service->datatables();
        } else {
            $results = $this->service->index();

            return view(getThemeTemplate($this->folder . '.index'))->with($results);
        }
    }
}

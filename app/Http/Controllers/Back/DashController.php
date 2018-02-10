<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;

class DashController extends Controller
{
	use ControllerTrait;

	/*模板文件夹*/
    protected $folder = 'back.dash';
    protected $routePrefix = 'admin.dash';

    public function index()
    {
    	return view(getThemeTemplate($this->folder . '.index'));
    }
}

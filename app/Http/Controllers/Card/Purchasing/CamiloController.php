<?php
namespace App\Http\Controllers\Card\Purchasing;

use App\Http\Controllers\Controller;
use App\Traits\ControllerTrait;
use App\Traits\EncryptTrait;
use App\Services\UserService as Service;
use Illuminate\Validation\Rule;


class CamiloController extends Controller
{
    public function index(){
        return view('themes.metronic.ocback.backstage.purchasing.camilo');
    }
}

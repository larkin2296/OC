<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use Validator;

Trait ControllerTrait
{
    public $storeReturn;
    public $updateReturn;
    
    public function setStoreReturnRoute()
    {
        $this->storeReturn = route($this->routePrefix() . '.index');
    }

    public function getStoreReturnRoute()
    {
        return $this->storeReturn;
    }

    public function setUpdateReturnRoute()
    {
        $this->updateReturn = route($this->routePrefix() . '.index');
    }

    public function getUpdateReturnRoute()
    {
        return $this->updateReturn;
    }

    /*获取路由前缀*/
    public function routeHighLightPrefix()
    {
        $this->routeHighLightPrefix = isset($this->routeHighLightPrefix) && $this->routeHighLightPrefix ? $this->routeHighLightPrefix : $this->routePrefix;
        return isset($this->routeHighLightPrefix) && $this->routeHighLightPrefix ? $this->routeHighLightPrefix : '';
    }

    /*获取路由前缀*/
    public function routePrefix()
    {
        return isset($this->routePrefix) && $this->routePrefix ? $this->routePrefix : '';
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->service->index();

        return view(getThemeTemplate($this->folder . '.index'))->with($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $results = $this->service->create();

        return view(getThemeTemplate($this->folder . '.create'))->with($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->requestValidate($request);

        $this->setStoreReturnRoute();

        $results = $this->service->store();
        if($request->ajax()) {
            return response()->json($results);
        } else {
            if($results['result']) {
                return redirect($this->getStoreReturnRoute());
            } else {
                return redirect()->back()->withInput()->withErrors($results['message']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $results = $this->service->show($id);

        return view(getThemeTemplate($this->folder . '.show'))->with($results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = $this->service->edit($id);

        return view(getThemeTemplate($this->folder . '.edit'))->with($results);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->requestValidate($request);

        $this->setUpdateReturnRoute();

        $results = $this->service->update($id);
        if($request->ajax()) {
            return response()->json($results);
        } else {
            if($results['result']) {
                return redirect($this->getUpdateReturnRoute());
            } else {
                return redirect()->back()->withInput()->withErrors($results['message']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results = $this->service->destroy($id);

        return response()->json($results);
    }

    public function requestValidate($request) {
        $rules = $this->checkRules();
        $messages = $this->messages();

        $this->validate($request, $rules, $messages);
    }

    public function checkRules()
    {
        $curRoute = isset(request()->route()->action['as']) && request()->route()->action['as'] ? request()->route()->action['as'] : '';

        $rules = $this->rules();

        if($curRoute) {
            $action = trim(str_replace($this->routePrefix, '', $curRoute), '.');

            $method = $action . 'Rules';

            if( method_exists(self::class, $method) ) {
                $rules = $this->{$method}();
            }
        }
        
        return $rules;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}
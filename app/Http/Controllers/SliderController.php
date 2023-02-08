<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{
    private $pathViewController    = 'admin.pages.slider.';
    private $controllerName        = 'slider';
    private $model;
    private $params                = [];

    public function __construct()
    {
        $this->model = new MainModel;
        $this->params["pagination"]["totalItemsPerPage"] = 2;

        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $items              = $this->model->listItems($this->params , ['task'   => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params , ['task'  => 'admin-count-items-group-by-status']);

        return view($this->pathViewController . 'index',[
            'params' => $this->params,
            'items' => $items,
            'itemsStatusCount' => $itemsStatusCount,
        ]);
    }

    public function form($id = null)
    {
        $title = "SliderController - Form";
        return view($this->pathViewController . 'form', [
            'id'    => $id, 
            'title' => $title
        ]);
    }

    public function delete()
    {
        return "SliderController - delete";
    }

    public function status(Request $request)
    {
        echo '<h3>Id: '. $request->id .'</h3>';     
        echo '<h3>Status: '. $request->status .'</h3>';
        return redirect()->route('slider');

    }
}
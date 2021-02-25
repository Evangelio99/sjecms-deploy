<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EstMonitor;

class EstMonitorController extends Controller
{
    //
    public function display(){
        $data = EstMonitor::get();
        return collect($data);
    }

    public function formCreated(Request $request){
        $data = EstMonitor::where('estID', $request->estID);
        $data->increment('currentIn');
        $data->increment('totalIn');
        
    }

    public function updateOut($estID){
        $data = EstMonitor::find($estID);
        $data->decrement('currentIn');
    }
    
}

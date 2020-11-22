<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circuit;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\CircuitsImport;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class CircuitController extends Controller
{
    public function import() 
    {

    	$importJob = new CircuitsImport;
    	Excel::import($importJob, request()->file('file'));
		return $importJob->getRowCount(); 
	}

	public function showAll()
	{
		$circuits = DB::table('circuits')->orderBy('customer', 'ASC')->simplePaginate(15);
		return $circuits;
	}
}

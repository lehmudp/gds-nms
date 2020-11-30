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

	// Import data from file
    public function import() 
    {
    	$importJob = new CircuitsImport;
    	Excel::import($importJob, request()->file('file'));
		return $importJob->getRowCount(); 
	}

	// Get single circuit
	public function show($id)
	{
		$circuit = DB::table('circuits')->where('id', $id)->get();
		return $circuit;
	}

	// Get all circuit
	public function showAll()
	{
		$circuits = DB::table('circuits')->orderBy('customer', 'ASC')->simplePaginate(15);
		return $circuits;
	}

	// Get all current customer
	public function showAllCustomers()
	{
		$customers = DB::table('circuits')->select('customer')->distinct()->get();
		return $customers;
	}

	// Get all circuit from the same company
	public function getCircuitByCompany($customer)
	{
		$circuits = DB::table('circuits')->where('customer', $customer)->get();
		return $circuits;
	}
}

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

	//Get circuit from ID number
	public function getCircuitById($id)
	{
		$circuit = DB::table('circuits')->where('id', $id)->get();
		return $circuit;
	}

	// Edit existing circuit or create new one if ID not found
	public function updateOrCreateCircuit(Request $request)
	{
		$data = $request['circuit'];
		Circuit::updateOrCreate(
		    ['id' => $data['id']],
		    [
		    	'ntt_cid' => $data['ntt_cid'],
		    	'name' => $data['name'],
		    	'customer' => $data['customer'],
		    	'service_name' => $data['service_name'],
		    	'carrier_name' => $data['carrier_name'],
		    	'tt2_id' => $data['tt2_id'],
		    	'province' => $data['province'],
		    	'site_description' => $data['site_description'],
		    	'address' => $data['address'],
		    	'al_type' => $data['al_type'],
		    	'cable_type' => $data['cable_type'],
		    	'customer_contact' => $data['customer_contact'],
		    	'recipient_to' => $data['recipient_to'],
		    	'recipient_cc' => $data['recipient_cc'],
		    	'recipient_bcc' => $data['recipient_bcc'],
		    	'po_number' => $data['po_number'],
		    	'po_description' => $data['po_description'],
		    	'config' => $data['config'],
		    	'note' => $data['note'],
		    	'update_note' => $data['update_note'],
			]
		);
	}
}

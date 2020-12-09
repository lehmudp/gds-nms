<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = DB::table('suppliers')->select('supplier_name')->distinct()->get();
        $result = array();

        foreach ($suppliers as $supplier) {
            $temp = DB::table('suppliers')->where('supplier_name', $supplier->supplier_name)->get()->groupBy('group_value');
            $result[$supplier->supplier_name] = $temp;
        }
        return $result;
    }

    public function showAll()
    {
        $result = DB::table('suppliers')->get()->groupBy('supplier_name');
        return $result;
    }

    //Get supplier from ID number
    public function getSupplierById($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->get();
        return $supplier;
    }

    // Edit existing supplier or create new one if ID not found
    public function updateOrCreateSupplier(Request $request)
    {
        $data = $request['supplier'];
        Supplier::updateOrCreate(
            ['id' => $data['id']],
            [
                'supplier_name' => $data['supplier_name'],
                'level' => $data['level'],
                'contact_name' => $data['contact_name'],
                'contact_title' => $data['contact_title'],
                'contact_phone_number' => $data['contact_phone_number'],
                'contact_email' => $data['contact_email'],
                'group_key' => $data['group_key'],
                'group_value' => $data['group_value'],
                'note' => $data['note'],
            ]
        );
    }
}

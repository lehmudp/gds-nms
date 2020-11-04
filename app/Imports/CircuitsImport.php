<?php

namespace App\Imports;

use App\Circuit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class CircuitsImport implements ToCollection, WithMultipleSheets, WithHeadingRow
{
    private $importedRows = 0;

    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }

    public function collection(Collection $rows)
    {
    	DB::beginTransaction();
		try {
		    foreach ($rows as $row) {
		     	if ($row['ntts_cid'] == "COUNT") {
		     		break;
		     	}
	        	else if($row->filter()->isNotEmpty()) {
		     		DB::table('circuits')->updateOrInsert(
		     			[
	        				'name'  => $row['circuit_name'],
		     			], 
		     			[
	        				'ntt_cid'  => $row['ntts_cid'],
	        				'customer'  => $row['customer'],
	        				'tt2_id'  => $row['ma_tt2'],
	        				'province'  => $row['tinh'],
	        				'site_description'  => $row['sites_description'],
	        				'address'  => $row['address'],
	        				'al_type'  => $row['al_type'],
	        				'cable_type'  => $row['type_of_cable'],
	        				'customer_contact'  => $row['customer_contact'],
	        				'recipient_to'  => $row['email'],
	        				'recipient_cc'  => $row['email_cc'],
	        				'recipient_bcc'  => $row['email_bcc'],
	        				'po_number'  => $row['po_number'],
	        				'po_description'  => $row['po_description'],
	        				'config'  => $row['config'],
	        				'note'  => $row['note'],
	        				'update_note'  => $row['last_updated'],
		     			]);
		     		$this->importedRows++;
		     	}
			}
		    DB::commit();
		} catch (Exception $e) {
		    DB::rollback();
		}
    }

    public function getRowCount(): int
    {
        return $this->importedRows;
    }
}

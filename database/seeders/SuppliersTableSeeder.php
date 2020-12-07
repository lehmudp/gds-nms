<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$suppliers = [
        	// VNPT South
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 1 On Duty',
				'contact_name' => 'Operator',
				'contact_title' => '',
				'contact_phone_number' => '18001261',
				'contact_email' => 'support.vnp@vnpt.vn',
				'group_key' => 'region',
				'group_value' => 'South of Vietnam',
				'note' => 'Old level 1 contact: support@vdc2.com.vn'
        	],
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 2>Customer Support Dept (After 3h) – email cc to AM of Sale',
				'contact_name' => 'Lê Xuân Hùng',
				'contact_title' => '',
				'contact_phone_number' => '38248888 (ext: 4301)>Mobile: 0918431388',
				'contact_email' => 'xuanhung@vdc2.com.vn;>lxhung@vnpt.vn;>nguyenngocminh@vnpt.vn;>nguyentranchau@vnpt.vn;',
				'group_key' => 'region',
				'group_value' => 'South of Vietnam',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 3',
				'contact_name' => 'Ngô Hữu Đức',
				'contact_title' => 'Deputy Director',
				'contact_phone_number' => '(08) 38248888 (ext: 3100)',
				'contact_email' => 'ngohuuduc@vnpt.vn',
				'group_key' => 'region',
				'group_value' => 'South of Vietnam',
				'note' => ''
        	],

        	// VNPT North
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 1',
				'contact_name' => 'Operator',
				'contact_title' => 'Nhóm giám sát/ TT ĐHHTKHVIP',
				'contact_phone_number' => '18001261',
				'contact_email' => 'giamsatvip.vnp@vnpt.vn',
				'group_key' => 'region',
				'group_value' => 'North of Vietnam',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 2',
				'contact_name' => 'Mr. Phạm Anh Huy',
				'contact_title' => 'Phụ trách nhóm giám sát TTĐHHTKHVIP',
				'contact_phone_number' => '0947 266233',
				'contact_email' => 'anhhuy@vnpt.vn',
				'group_key' => 'region',
				'group_value' => 'North of Vietnam',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'VNPT',
				'level' => 'Level 3',
				'contact_name' => 'Mr. Nguyễn Trí Dũng',
				'contact_title' => 'PGĐ TTĐHHTKHVIP',
				'contact_phone_number' => '0913 224800',
				'contact_email' => 'nguventridung@vnpt.vn',
				'group_key' => 'region',
				'group_value' => 'North of Vietnam',
				'note' => ''
        	],

        	// FPT
        	[
	            'supplier_name' => 'FPT',
				'level' => 'Level 1',
				'contact_name' => 'Operator',
				'contact_title' => 'Customer Support',
				'contact_phone_number' => '19006600',
				'contact_email' => 'FTI.Support@fpt.com.vn;>FTEL.FTI.GS@fpt.com.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],        	
        	[
	            'supplier_name' => 'FPT',
				'level' => 'Resell FTTH of FPT',
				'contact_name' => 'Ms. Linh',
				'contact_title' => 'Reseller',
				'contact_phone_number' => '0937767855',
				'contact_email' => 'linhmtt3@fpt.com.vn ',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],

        	// CMC
        	[
	            'supplier_name' => 'CMC',
				'level' => 'Level 1',
				'contact_name' => 'Operator',
				'contact_title' => 'Customer Support',
				'contact_phone_number' => '1900 2020>Mobile: 0987115533',
				'contact_email' => 'goc@cmctelecom.vn;>g.soc@cmctelecom.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],

        	// Viettel
        	[
	            'supplier_name' => 'Viettel',
				'level' => 'Level 1',
				'contact_name' => 'Operator',
				'contact_title' => 'VIETTEL IDC NOC',
				'contact_phone_number' => '+84274.6280.280',
				'contact_email' => 'idc.bd.noc@viettelidc.com.vn;>idc.bd.collaborator@viettelidc.com.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => 'By web portal: https://portal.viettelidc.com.vn'
        	],
        	[
	            'supplier_name' => 'Viettel',
				'level' => 'Level 2',
				'contact_name' => 'Mr. Trần Văn Thành >= 6h',
				'contact_title' => '',
				'contact_phone_number' => '+84986.808.820',
				'contact_email' => 'thanhtv@viettelidc.com.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => 'When the outage happened. Beside the calling to level 1, please also send an email for them (Needed CC for level 2 & level 3 in mail loop for avoiding unexpected information may cause).'
        	],
        	[
	            'supplier_name' => 'Viettel',
				'level' => 'Level 3',
				'contact_name' => 'Mr. Phan Nguyễn Minh Tùng >= 8h',
				'contact_title' => '',
				'contact_phone_number' => '+84985.663.755',
				'contact_email' => 'tungpnm@viettelidc.com.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],


        	// Netnam
        	[
	            'supplier_name' => 'Netnam',
				'level' => 'Level 1',
				'contact_name' => 'Technical Hotline',
				'contact_title' => 'Wansi Department',
				'contact_phone_number' => '(+84-28) 3 911 8200 Ext: 191, 192, 193, 195>Mobile: 0914 104 638',
				'contact_email' => 'wansi-sg@netnam.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'Netnam',
				'level' => 'Level 2',
				'contact_name' => 'Mr. Nguyen Vu An',
				'contact_title' => 'Technical Manager',
				'contact_phone_number' => '(+84-28) 3 911 8200 Ext: 190>Mobile: 0905 856 959',
				'contact_email' => 'an.nv@netnam.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'Netnam',
				'level' => 'Level 3',
				'contact_name' => 'Mr Nguyen Minh Cang',
				'contact_title' => 'Technical Director',
				'contact_phone_number' => '(+84-28) 3 911 8200 Ext: 291>Mobile: 0905 931 441',
				'contact_email' => 'cang.nm@netnam.vn',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	// NTT
        	[
	            'supplier_name' => 'NTT',
				'level' => 'Level 1',
				'contact_name' => 'Mr. Do Thanh Xuan & Ms. Pham Thi Hai Yen',
				'contact_title' => 'Head of T1 and monitor service',
				'contact_phone_number' => '+84-28-3827-3646 Ext: 147>+84 901 357 485',
				'contact_email' => 'xuando@global.ntt;>yen.pham@global.ntt;>CC:>NTTVN.NI.HCM@global.ntt;>NTTVN.Operations.HCM@global.ntt',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'NTT',
				'level' => 'Level 2',
				'contact_name' => 'Mr. Vo Chi Quy',
				'contact_title' => 'NI Deputy Director',
				'contact_phone_number' => '+84-28-3827-3646>Ext: 102;+84 918 355 789',
				'contact_email' => 'quy.vo@global.ntt;>CC:>NTTVN.NI.HCM@global.ntt',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'NTT',
				'level' => 'Level 3',
				'contact_name' => 'Mr. Masayuki Terakubo',
				'contact_title' => 'Engineering Director',
				'contact_phone_number' => '+84 901 355 659',
				'contact_email' => 'masa.terakubo@global.ntt',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	],
        	[
	            'supplier_name' => 'NTT',
				'level' => 'Level 4',
				'contact_name' => 'Mr. Takashi Akiyama',
				'contact_title' => 'Deputy General Director',
				'contact_phone_number' => '+84 917 633 167',
				'contact_email' => 'taka.akiyama@global.ntt',
				'group_key' => '',
				'group_value' => '',
				'note' => ''
        	]
        ];
        DB::table('suppliers')->insert($suppliers);
    }
}

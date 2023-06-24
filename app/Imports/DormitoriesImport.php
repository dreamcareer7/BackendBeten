<?php

namespace App\Imports;

use App\Models\Dormitory;
use Maatwebsite\Excel\Concerns\ToModel;

class DormitoriesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dormitory([
            //
			'title'=>$row[1],
			'phones'=>$row[20],
			'city_id'=>$row[3],
			'location'=>$row[16],
			'coordinate'=>$row[14].','.$row[15],
			'is_active'=> true,
			
			'HOUSE_ID'=>$row[0],
			'HOUSE_COMMERCIAL_NAME_AR'=>$row[1], // also title
			'HOUSE_COMMERCIAL_NAME_LA'=>$row[2],
			'HOUSE_CITY_ID'=>$row[3],
			'HOUSE_TOTAL_ROOMS'=>$row[4],
			'HOUSE_GUEST_CAPACITY'=>$row[5],
			'HOUSE_MAP_ADDRESS_LATITUDE'=>$row[14],
			'HOUSE_MAP_ADDRESS_LONGITUDE'=>$row[15],
			'HOUSE_ADDRESS_1'=>$row[16],
			'HOUSE_PHONES_NO'=>$row[20],
			'HOUSE_MANAGER_NAME'=>$row[25],
			'HOUSE_MANAGER_PHONE'=>$row[26],
			'HOUSE_RENEWAL_SEASON'=>$row[32],
			
			
        ]);
    }
}

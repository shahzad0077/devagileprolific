<?php

namespace App\Imports;

use App\Models\Chart;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($selection,$title,$kpi)
    {
        $this->selection = $selection;
        $this->title = $title;
        $this->kpi = $kpi;
    }
    public function model(array $row)
    {
        return new Chart([
            'target_month' => $row[0],
            'target_value' => $row[1],
            'title' => $this->selection,
            'subtitle' => $this->title,
            'user_id' => Auth::id(),
            'kpi_setting_id' => $this->kpi
        ]);
    }
}

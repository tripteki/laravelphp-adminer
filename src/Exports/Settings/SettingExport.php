<?php

namespace Tripteki\Adminer\Exports\Settings;

use Tripteki\Setting\Models\Admin\Setting;
use Maatwebsite\Excel\Concerns\FromCollection;

class SettingExport implements FromCollection
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function collection()
    {
        return Setting::all([ "key", "value", ]);
    }
};

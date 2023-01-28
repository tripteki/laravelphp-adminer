<?php

namespace Tripteki\Adminer\Imports\Settings;

use Tripteki\Setting\Contracts\Repository\Admin\ISettingRepository as ISettingAdminRepository;
use Tripteki\Adminer\Http\Requests\Admin\Settings\SettingStoreValidation;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class SettingImport implements ToCollection
{
    /**
     * @param \Illuminate\Support\Collection $rows
     * @return void
     */
    protected function validate(Collection $rows)
    {
        $validator = (new SettingStoreValidation())->rules();

        Validator::make($rows->toArray(), [

            "*.0" => $validator["key"],
            "*.1" => $validator["value"],

        ])->validate();
    }

    /**
     * @param \Illuminate\Support\Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        $this->validate($rows);

        $settingAdminRepository = app(ISettingAdminRepository::class);

        foreach ($rows as $row) 
        {
            $settingAdminRepository->create([ "key" => $row[0], "value" => $row[1], ]);
        }
    }
};

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidJadwal implements Rule
{
     protected $kategoriId;

    public function __construct($kategoriId)
    {
        $this->kategoriId = $kategoriId;
    }

    public function passes($attribute, $value)
    {
         if ($this->kategoriId == 1) {
            return in_array($value, ['Senin-Rabu', 'Selasa-Kamis']);
        } elseif ($this->kategoriId == 2) {
            return $value == 'Jumat-Sabtu';
        }

        return false;
    }

    public function message()
    {
        return 'Jadwal tidak valid untuk kategori yang dipilih.';
    }
}

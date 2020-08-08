<?php

namespace App\Imports;


use App\Panitia;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
    default('none');


class PanitiaImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Panitia([
            'id' => Str::uuid(),
            'nama_panitia' => $row['Nama Panitia'],
            'username' => $row['Username'],
            'password' => bcrypt($row['Password']),
            'jk_peserta' => $row['JK Peserta'],
            'kategori' => $row['Kategori'],

        ]);
    }
}

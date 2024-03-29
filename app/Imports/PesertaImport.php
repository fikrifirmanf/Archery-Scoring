<?php

namespace App\Imports;

use App\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::
    default('none');


class PesertaImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Peserta([
            'uuid' => Str::uuid(),
            'no_target' => $row['No Target'],
            'nama_peserta' => $row['Nama Peserta'],
            'jk' => $row['Jk'],
            'kategori' => $row['Kategori'],
            'team' => $row['Team'],
            'kelas' => $row['Kelas'],

        ]);
    }
}

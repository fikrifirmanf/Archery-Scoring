<?php

namespace App\Imports;

use App\Kategori;
use App\Kelas;
use App\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
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
    // public function rules(): array
    // {
    //     return [
    //         '0' => 'required|string',
    //         '1' => 'required|string',
    //         '2' => 'required|numeric',
    //         // so on
    //     ];
    // }
    public function model(array $row)
    {
        // $kategori = Kategori::whereIn('nama_kategori', $row[4])->get(['uuid']);
        // for ($i = 0; $i < count($row[4]); $i++) {
        //     $cek[] = $kategori[$i]['uuid'];
        // }
        // $ntap = $cek;
        // $kelas = Kelas::whereIn('nama_kelas', $row[6])->get('uuid');
        // for ($i = 0; $i < count($row[6]); $i++) {
        //     $ceki[] = $kategori[$i]['uuid'];
        // }
        // $kls = $ceki;


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

<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrData = [
            [
                'key' => 'pemasukan',
                'value' => 'Gaji'
            ],
            [
                'key' => 'pemasukan',
                'value' => 'Tunjangan'
            ],
            [
                'key' => 'pemasukan',
                'value' => 'Bonus'
            ],
            [
                'key' => 'pengeluaran',
                'value' => 'Sewa Kost'
            ],
            [
                'key' => 'pengeluaran',
                'value' => 'Makan'
            ],
            [
                'key' => 'pengeluaran',
                'value' => 'Pakaian'
            ],
            [
                'key' => 'pengeluaran',
                'value' => 'Nonton Bisoskop'
            ],
        ];
        
        foreach($arrData as $ky => $value) {
            $model = new Kategori;
            $model->nama = $value['value'];
            $model->deskripsi = $value['value'];
            $model->tipe = $value['key'];
            $model->save();
        }
        
        
    }
}

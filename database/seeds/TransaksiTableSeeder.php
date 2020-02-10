<?php

use Illuminate\Database\Seeder;
use App\Transaksi;

class TransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start date
	$date = '2020-01-01';
	// End date
	$end_date = date('Y-m-d');

	while (strtotime($date) <= strtotime($end_date)) {
                $model = new Transaksi;
                $model->tanggal_transaksi = $date;
                $model->kategori_id = rand(1, 7);
                $model->nominal = rand(100000, 2000000);
                $model->deskripsi = "dummy data";
                $model->save();
                
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
	}

    }
}

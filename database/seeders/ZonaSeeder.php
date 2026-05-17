<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    public function run(): void
    {
        $zonas = [
            1 => ['Kamar Besar', '553,278,738,278,738,852,553,852'],
            2 => ['Parkir Space', '136,12,552,12,552,277,136,277'],
            3 => ['Jamaah Pria', '193,350,460,350,460,758,193,758'],
            4 => ['Gedung Samping', '0,350,192,350,192,758,0,758'],
            5 => ['Asrama Parkir Space', '2,13,135,13,135,350,2,350'],
            6 => ['Serambi Kanan', '193,278,552,278,552,349,193,349'],
            7 => ['Jamaah Perempuan', '461,351,552,351,552,761,461,761'],
            8 => ['Serambi Kiri', '193,759,552,759,552,830,193,830'],
            9 => ['Kamar Mandi Wanita', '136,204,192,204,192,349,136,349'],
            10 => ['Kamar Mandi Pria', '136,43,192,43,192,203,136,203'],
            11 => ['Imam Space', '193,501,235,501,235,563,193,563'],
            12 => ['Ambulance Port', '93,55,135,55,135,117,93,117'],
            13 => ['Ruang Muadzin', '193,587,235,587,235,757,193,757'],
            14 => ['Kamar Mandi Santri', '65,587,121,587,121,757,65,757'],
            15 => ['Kamar 2', '136,507,192,507,192,624,136,624'],
            16 => ['Kamar 3', '136,372,192,372,192,489,136,489'],
            17 => ['Kamar Ustad', '1,351,118,351,118,407,1,407'],
            18 => ['Kamar 1', '136,640,192,640,192,757,136,757'],
        ];

        foreach ($zonas as $id => $data) {
            Zona::updateOrCreate(
                ['id' => $id],
                ['nama' => $data[0], 'polygon' => $data[1], 'rating_agg' => 0]
            );
        }
    }
}


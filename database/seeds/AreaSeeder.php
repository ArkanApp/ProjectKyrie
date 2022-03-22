<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $generalDoctor = new Area();
        $generalDoctor->name = "Médico general";
        $generalDoctor->save();
        $odontologics = new Area();
        $odontologics->name = "Odontología";
        $odontologics->save();
    }
}

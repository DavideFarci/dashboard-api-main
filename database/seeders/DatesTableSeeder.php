<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Date;
use App\Models\Month;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatesTableSeeder extends Seeder
{

    protected $max_reservations;
    protected $times_slot;
    protected $days_off = [];

    public function setVariables($max_reservations, $times_slot, $days_off)
    {

        $this->max_reservations = $max_reservations;
        $this->times_slot = $times_slot;
        $this->days_off = $days_off;
    }

    public function run()
    {
        $maxReservation = $this->max_reservations;
        $currentDate = new DateTime();
        $times = $this->times_slot;
        $disabledDays = $this->days_off;

        // Si cicla contemporaneamente sui mesi, sui giorni e sulle fasce orarie
        // per ogni mese si contano i giorni, per ogni giorno si guarda il giorno(num) della settimana
        // per ogni giorno si verifica che il giorno non sia all'interno di quelli disabilitati dall'utente
        $currentMounth = $currentDate->format('n');

        for ($i = $currentMounth; $i <= 12; $i++) {
            $daysInMonth = $currentDate->format('t'); //n giorni nel mese
            Month::create([
                'month' => $currentDate->format('F'),
                'n' => $currentDate->format('n'),
                'y' => $currentDate->format('Y'),
            ]);
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $currentDayOfWeek = $currentDate->format('N');

                foreach ($times as $time) {
                   
                    if(!$disabledDays){
                        Date::create([
                            'reserved' => 0,
                            'day_w' => $currentDayOfWeek,
                            'month' => $currentDate->format('n'),
                            'day' => $currentDate->format('d'),
                            'time' => $time,
                            'max_res' => $maxReservation,
                            'year' => $currentDate->format('Y'),
                            'visible' => 1,
                
                        ]);
                    }
                    else {
                        Date::create([
                            'reserved' => 0,
                            'day_w' => $currentDayOfWeek,
                            'month' => $currentDate->format('n'),
                            'day' => $currentDate->format('d'),
                            'time' => $time,
                            'max_res' => $maxReservation,
                            'year' => $currentDate->format('Y'),
                            'visible' => (1 && !in_array($currentDayOfWeek, $disabledDays)),
                
                        ]);
                    }
                }
                $currentDate->modify('+1 day');
            }
        }
        @dump($currentDate);
    }
}

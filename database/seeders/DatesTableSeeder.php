<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Day;
use App\Models\Date;
use App\Models\Month;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatesTableSeeder extends Seeder
{

    protected $max_reservations;
    protected $max_pz;
    protected $times;
    protected $days_off = [];

    public function setVariables($max_reservations, $max_pz, $times, $days_off)
    {
        $this->max_reservations = $max_reservations;
        $this->max_pz = $max_pz;
        $this->times = $times;
        $this->days_off = $days_off;
    }

    public function run()
    {
        $currentDate = new DateTime();
     //   $currentDate->modify('+7 month');
        $times = $this->times;
        $abledDays = $this->days_off;

        // dump($times);

        // Si cicla contemporaneamente sui mesi, sui giorni e sulle fasce orarie
        // per ogni mese si contano i giorni, per ogni giorno si guarda il giorno(num) della settimana
        // per ogni giorno si verifica che il giorno non sia all'interno di quelli disabilitati dall'utente
        $currentMounth = $currentDate->format('n');

        for ($i = 1; $i <= 12; $i++) {
            $daysInMonth = $currentDate->format('t'); //n giorni nel mese
            Month::create([
                'month' => $currentDate->format('F'),
                'n' => $currentDate->format('n'),
                'y' => $currentDate->format('Y'),
            ]);
            for ($day = $currentDate->format('d'); $day <= $daysInMonth; $day++) {
                $currentDayOfWeek = $currentDate->format('N');

                Day::create([
                    'day' => $currentDate->format('d'),
                    'm' => $currentDate->format('n'),
                    'y' => $currentDate->format('Y'),
                ]);

                foreach ($times[$currentDayOfWeek - 1] as $time) {
                    // dump($time, $time['set']);
                    if ($time['set']) {
                        Date::create([
                            'reserved' => 0,
                            'reserved_pz' => 0,
                            'day_w' => $currentDayOfWeek,
                            'month' => $currentDate->format('n'),
                            'day' => $currentDate->format('d'),
                            'time' => $time['time'],
                            'max_res' => $this->max_reservations,
                            'max_pz' => $this->max_pz,
                            'year' => $currentDate->format('Y'),
                            'date_slot' => $currentDate->format('d') . '/' .  $currentDate->format('m') . '/' .  $currentDate->format('Y') . ' ' . $time['time'],
                            'status' => $time['set'],
                            'visible' => (1 && in_array($currentDayOfWeek, $abledDays)),
                        ]);
                    }
                }
                $currentDate->modify('+1 day');
            }
        }
        // dump($currentDate);
    }
}

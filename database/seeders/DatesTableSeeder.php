<?php

namespace Database\Seeders;

use DateTime;
use App\Models\Date;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatesTableSeeder extends Seeder
{

    protected $max_reservations;
    protected $times_slot;
    protected $days_off;

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

        for ($i = 0; $i < 12; $i++) {
            $this->generateMonthDates($currentDate, $maxReservation);
        }
    }

    private function generateMonthDates(DateTime $currentDate, $maxReservation)
    {
        $daysInMonth = $currentDate->format('t');
        $currentMonth = $currentDate->format('m');
        $currentYear = $currentDate->format('Y');

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $this->generateDayDates($currentDate, $maxReservation);
            $currentDate->modify('+1 day');
        }
    }

    private function generateDayDates(DateTime $currentDate, $maxReservation)
    {
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $currentDayOfWeek = $currentDate->format('N');

        $times = $this->times_slot;
        $disabledDays = $this->days_off;

        foreach ($times as $time) {
            Date::create([
                'reserved' => 0,
                'day_w' => $currentDayOfWeek,
                'month' => $currentDate->format('m'),
                'day' => $currentDate->format('d'),
                'time' => $time,
                'visible' => (1 && !in_array($currentDayOfWeek, $disabledDays)),
                'max_res' => $maxReservation,
                'year' => $currentDate->format('Y'),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

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
        $startTime = $this->times_slot;
        $disabledDays = $this->days_off;

        // @dump("max_reservations: " . $maxReservation, "times_slot: " . $startTime, "days_off: " . $disabledDays);
        // @dd("max_reservations: " . $maxReservation, "times_slot: " . $startTime, "days_off: " . $disabledDays);

        $currentDay = now();
        $year = $currentDay->year;
        $month = $currentDay->month;
        $dayOfWeek = $currentDay->dayOfWeek;

        for ($i = 0; $i < 12; $i++) {
            $daysInMonth = $currentDay->daysInMonth;

            for ($day = 1; $day <= $daysInMonth; $day++) {
                if ($dayOfWeek === 7) {
                    $dayOfWeek = 1;
                } else {
                    $dayOfWeek++;
                }

                foreach ($startTime as $time) {
                    Date::create([
                        'reserved' => 0,
                        'day_w' => $dayOfWeek,
                        'month' => $month,
                        'day' => $day,
                        'time' => $time,
                        'visible' => (1 && !in_array($dayOfWeek, $disabledDays)),
                        'max_res' => $maxReservation,
                        'year' => $year,
                    ]);
                }
            }

            if ($i < 11) {
                $currentDay->addMonth();
                $year = $currentDay->year;
                $month = $currentDay->month;
            }
        }
    }
    // public function run()
    // {
    //     $maxReservation = 5;


    //     //$cDay= 
    //     // $cNDMonth= date('t');
    //     // $cMonth= date('m');
    //     // $year= date('y');
    //     // $year= $year + 2000;
    //     // $dayWeek= date('N');

    //     $cDay = date('d');       // giorno corrente del mese (2 cifre)
    //     $cNDMonth = date('t');   // giorni tot mese corrente (28, 30, 31)
    //     $cMonth = date('m');     // mese corrente (2 cifre)
    //     $year = date('y');       // anno corrente (2 cifre)
    //     $year = $year + 2000;    // anno corrente (4 cifre)
    //     $dayWeek = date('N');    // giorno settimana corrente (numerico)

    //     $lDay = $cNDMonth - $cDay;
    //     $lMounth = 12 - $cMonth;


    //     for ($i = 1; $i <= $lDay; $i++) {
    //         if ($dayWeek !== 7) {
    //             $dayWeek = $dayWeek + 1;
    //         } else {

    //             $dayWeek = 1;
    //         }
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '10:30',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '11:00',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '11:30',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '12:00',
    //             'visible'  => true,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '12:30',
    //             'visible'  => true,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '13:00',
    //             'visible'  => true,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '13:30',
    //             'visible'  => true,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '16:30',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '17:00',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '17:30',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '18:00',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //         Date::create([
    //             "reserved" => 0,
    //             'day_w'    => $dayWeek,
    //             'month'    => $cMonth,
    //             'day'      => $cDay + $i,
    //             'time'     => '18:30',
    //             'visible'  => false,
    //             'max_res'  => $maxReservation,
    //             'year'     => $year,
    //         ]);
    //     };
    //     //genaerazione del secondo mese ecc
    //     if ($lMounth > 0) {
    //         for ($itop = $cMonth + 1; $itop <= 12; $itop++) {
    //             if ($itop == 1) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 2 && !(($year % 4) == 0)) {
    //                 $mdMonth = 28;
    //             };
    //             if ($itop == 2 && (($year % 2) == 0)) {
    //                 $mdMonth = 29;
    //             };
    //             if ($itop == 3) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 4) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 5) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 6) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 7) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 8) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 9) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 10) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 11) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 12) {
    //                 $mdMonth = 31;
    //             };

    //             $m = $itop;
    //             //creazione del mese con i giorni e degli orari
    //             for ($i = 1; $i <= $mdMonth; $i++) {
    //                 if ($dayWeek !== 7) {
    //                     $dayWeek = $dayWeek + 1;
    //                 } else {

    //                     $dayWeek = 1;
    //                 }


    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '10:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '11:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '11:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '12:00',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '12:30',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '13:00',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '13:30',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '16:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '17:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '17:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '18:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '18:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //             };
    //         }
    //     }
    //     if ($lMounth !== 12) {
    //         $year++;
    //         for ($itop = 1; $itop <= 12; $itop++) {

    //             if ($itop == 1) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 2 && !(($year % 4) == 0)) {
    //                 $mdMonth = 28;
    //             };
    //             if ($itop == 2 && (($year % 2) == 0)) {
    //                 $mdMonth = 29;
    //             };
    //             if ($itop == 3) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 4) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 5) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 6) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 7) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 8) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop == 9) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop == 10) {
    //                 $mdMonth = 31;
    //             };
    //             if ($itop + 1 == 11) {
    //                 $mdMonth = 30;
    //             };
    //             if ($itop + 1 == 12) {
    //                 $mdMonth = 31;
    //             };

    //             $m = $itop;
    //             //creazione del mese con i giorni e degli orari
    //             for ($i = 1; $i <= $mdMonth; $i++) {
    //                 if ($dayWeek !== 7) {
    //                     $dayWeek = $dayWeek + 1;
    //                 } else {

    //                     $dayWeek = 1;
    //                 }

    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '10:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '11:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '11:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '12:00',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '12:30',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '13:00',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '13:30',
    //                     'visible'  => true,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '16:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '17:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '17:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '18:00',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //                 Date::create([
    //                     "reserved" => 0,
    //                     'day_w'    => $dayWeek,
    //                     'month'    => $m,
    //                     'day'      => $i,
    //                     'time'     => '18:30',
    //                     'visible'  => false,
    //                     'max_res'  => $maxReservation,
    //                     'year'     => $year,
    //                 ]);
    //             };
    //         }
    //     }
    // }
}

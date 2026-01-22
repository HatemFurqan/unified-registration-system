<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'id' => 1,
                'name' => 'فردي',
                'code' => 'one_to_one',
                'amount' => 42300.00,
                'created_at' => Carbon::parse('2021-12-13 21:47:14'),
                'updated_at' => Carbon::parse('2022-03-13 14:25:43'),
            ],
            [
                'id' => 2,
                'name' => 'منتظمين',
                'code' => 'regular',
                'amount' => 14800.00,
                'created_at' => Carbon::parse('2021-12-13 23:07:57'),
                'updated_at' => Carbon::parse('2022-03-13 14:26:09'),
            ],
            [
                'id' => 3,
                'name' => 'مستجدين',
                'code' => 'new-students',
                'amount' => 19900.00,
                'created_at' => Carbon::parse('2021-12-29 17:15:44'),
                'updated_at' => Carbon::parse('2022-04-29 03:43:38'),
            ],
            [
                'id' => 4,
                'name' => 'التقسيط',
                'code' => 'installments',
                'amount' => 1000.00,
                'created_at' => Carbon::parse('2021-12-29 18:22:43'),
                'updated_at' => Carbon::parse('2021-12-29 18:22:43'),
            ],
            [
                'id' => 5,
                'name' => 'تقسيط المرحلة الثانية',
                'code' => 'installments-2',
                'amount' => 9500.00,
                'created_at' => Carbon::parse('2022-02-01 19:40:23'),
                'updated_at' => Carbon::parse('2022-02-01 19:40:27'),
            ],
            [
                'id' => 6,
                'name' => 'تقسيط المرحلة الثالثة',
                'code' => 'installments-3',
                'amount' => 9500.00,
                'created_at' => Carbon::parse('2022-02-01 19:40:31'),
                'updated_at' => Carbon::parse('2022-02-01 19:40:34'),
            ],
            [
                'id' => 7,
                'name' => 'الرباعي',
                'code' => 'fourth_to_fourth',
                'amount' => 31100.00,
                'created_at' => Carbon::parse('2022-03-17 00:15:10'),
                'updated_at' => Carbon::parse('2023-02-24 00:53:17'),
            ],
            [
                'id' => 8,
                'name' => 'طلاب مستجدين - رواية ورش',
                'code' => 'new-students-warsh',
                'amount' => 19900.00,
                'created_at' => Carbon::parse('2022-04-28 16:41:53'),
                'updated_at' => Carbon::parse('2022-06-13 17:26:22'),
            ],
            [
                'id' => 9,
                'name' => 'طلاب مستجدين - جميع الفروع',
                'code' => 'new-students-all',
                'amount' => 19900.00,
                'created_at' => Carbon::parse('2021-12-29 17:15:44'),
                'updated_at' => Carbon::parse('2022-04-29 03:43:38'),
            ],
            [
                'id' => 10,
                'name' => '35 دقيقة',
                'code' => 'minutes_35',
                'amount' => 20000.00,
                'created_at' => Carbon::parse('2022-01-01 00:00:00'),
                'updated_at' => Carbon::parse('2022-01-01 00:00:00'),
            ],
            [
                'id' => 11,
                'name' => '70 دقيقة',
                'code' => 'minutes_70',
                'amount' => 40000.00,
                'created_at' => Carbon::parse('2022-01-01 00:00:00'),
                'updated_at' => Carbon::parse('2022-01-01 00:00:00'),
            ],
            [
                'id' => 12,
                'name' => 'يوم التأسيس',
                'code' => 'founding-day',
                'amount' => 19900.00,
                'created_at' => Carbon::parse('2022-01-01 00:00:00'),
                'updated_at' => Carbon::parse('2022-01-01 00:00:00'),
            ],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->updateOrInsert(
                ['id' => $course['id']],
                $course
            );
        }
    }
}

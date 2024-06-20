<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from roles');
        DB::delete('delete from positions');
        DB::delete('delete from ranks');
        DB::delete('delete from departments');
        DB::delete('delete from institutions');
        DB::delete('delete from grade_levels');
        DB::delete('delete from educations');
        DB::delete('delete from users');
        DB::delete('delete from investment_types');
        DB::delete('delete from business_entity_types');
        DB::delete('delete from recommendations');
        DB::delete('delete from observations');
    }

}

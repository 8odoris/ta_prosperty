<?php

namespace Tests\Feature;

use App\Helpers\DBHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DBHelperTest extends TestCase
{
    public function test_concatAs(): void
    {
        $query = DB::table('spies')
            ->select(DBHelper::concatAs('col1', 'col2', 'test', ' '));

        $this->assertEquals($query->toSql(), "select CONCAT_WS(' ', `col1`, `col2`) AS `test` from `spies`");
    }

    public function test_calcAge(): void
    {
        $query = DB::table('spies')
            ->select(DBHelper::calcAge('col1', 'col2'));

        $this->assertEquals($query->toSql(), "select TIMESTAMPDIFF(YEAR, `col1`, COALESCE(`col2`, NOW())) from `spies`");
    }

}

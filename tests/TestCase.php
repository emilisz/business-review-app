<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    protected function logIn($user = null)
    {
        return $this->actingAs($user ?: User::factory()->create());
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InecDataGenerationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function test_generate_states()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate state')->assertSuccessful();

    }

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function test_generate_lgas()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate lga')->assertSuccessful();

    }

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function test_generate_wards()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate ward')->assertSuccessful();

    }

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function test_generate_polling_units()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate polling-unit')->assertSuccessful();
    }
}

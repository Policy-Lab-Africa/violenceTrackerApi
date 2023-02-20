<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InecDataGenerationTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateStates()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate state')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateLgas()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate lga')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateWards()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate ward')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGeneratePollingUnits()
    {
        return $this->markTestSkipped('Data generated in all areas, need to switch to mocked objects');
        $this->artisan('inecdata:generate polling-unit')->assertSuccessful();
    }
}

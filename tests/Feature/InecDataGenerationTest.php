<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InecDataGenerationTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateStates()
    {
        $this->artisan('inecdata:generate state')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateLgas()
    {
        $this->artisan('inecdata:generate lga')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGenerateWards()
    {
        $this->artisan('inecdata:generate ward')->assertSuccessful();

    }
    /**
     * Test tha the job to creat states is successful.
     *
     * @return void
     */
    public function testGeneratePollingUnits()
    {
        $this->artisan('inecdata:generate polling-unit')->assertSuccessful();

    }
}

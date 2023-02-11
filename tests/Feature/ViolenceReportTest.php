<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\NgWard;
use App\Models\NgState;
use App\Jobs\PublishTweet;
use App\Models\NgPuLocation;
use App\Models\ViolenceType;
use App\Models\NgPollingUnit;
use App\Models\ViolenceReport;
use App\Models\NgLocalGovernment;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViolenceReportTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, WithFaker;

    private $state, $lga, $ward, $pollingUnit, $type;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->state = NgState::factory()->create();
        $this->lga = NgLocalGovernment::factory()->create();
        $this->ward = NgWard::factory()->create();
        $this->pollingUnit = NgPollingUnit::factory()->create();
        $this->type = ViolenceType::factory()->create();
        
    }
    /**
     * Recent Reports
     * @test
     *
     * @return void
     */
    public function getRecentReports()
    {

        ViolenceReport::factory()->count(500)->create();
        $response = $this->get('api/violence-reports');
        
        $response->assertJson([
            'status' => 'success',
            'data' => [
                'violence_reports' => []
            ],
        ])->assertStatus(200);
    }

    /**
     * Create violence reports
     * 
     * @test
     *
     * @return void
     */
    public function createViolenceReports()
    {
        Queue::fake();
        
        $response = $this->post('api/violence-reports', [
            'ng_state_id' => $this->state->data_id,
            'ng_local_government_id' => $this->lga->data_id,
            'ng_polling_unit_id' => $this->pollingUnit->data_id,
            'type_id' => $this->type->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'file_path' => 'files/reports/file.png',
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ]);
        
        $response->assertJson([
            'status' => 'success',
            'data' => [
                'violence_report' => []
            ],
        ])->assertStatus(201);

        $this->assertDatabaseHas('violence_reports', [
            'ng_state_id' => $this->state->data_id,
            'ng_local_government_id' => $this->lga->data_id,
            'ng_polling_unit_id' => $this->pollingUnit->data_id,
            'type_id' => $this->type->id,
        ]);

        Queue::assertPushed(PublishTweet::class, 1);
    }

    /**
     * Show report
     *
     * @test
     * @return void
     */
    public function showViolenceReport()
    {
        $report = ViolenceReport::factory()->create();

        $this->get(route('violence-reports.show', $report->id))
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'violence_report' => [
                        'id' => $report->id,
                    ]
                ]
            ]);
    }

}

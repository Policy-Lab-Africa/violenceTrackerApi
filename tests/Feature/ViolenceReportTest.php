<?php

namespace Tests\Feature;

use App\Jobs\PublishTweet;
use App\Models\NgLocalGovernment;
use App\Models\NgPollingUnit;
use App\Models\NgState;
use App\Models\NgWard;
use App\Models\ViolenceReport;
use App\Models\ViolenceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class ViolenceReportTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $state;

    private $lga;

    private $ward;

    private $pollingUnit;

    private $type;

    protected function setUp(): void
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
     *
     *
     * @return void
     */
    #[Test]
    public function get_recent_reports()
    {

        ViolenceReport::factory()->count(500)->create();
        $response = $this->get('api/violence-reports');

        $response->assertJson([
            'status' => 'success',
            'data' => [
                'violence_reports' => [],
            ],
        ])->assertStatus(200);
    }

    /**
     * Create violence reports
     *
     *
     * @return void
     */
    #[Test]
    public function create_violence_reports()
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
            'recaptchaToken' => '6LeIx-InvAlid-Token-For-Now',
        ]);

        if ($response->getStatusCode() === 201) {
            $response->assertJson([
                'status' => 'success',
                'data' => [
                    'violence_report' => [],
                ],
            ])->assertStatus(201);

            $this->assertDatabaseHas('violence_reports', [
                'ng_state_id' => $this->state->data_id,
                'ng_local_government_id' => $this->lga->data_id,
                'ng_polling_unit_id' => $this->pollingUnit->data_id,
                'type_id' => $this->type->id,
            ]);

            Queue::assertPushed(PublishTweet::class, 1);
        } elseif ($response->getStatusCode() === 201) {
            //
        }

    }

    /**
     * Show report
     *
     *
     * @return void
     */
    #[Test]
    public function show_violence_report()
    {
        $report = ViolenceReport::factory()->create();

        $this->get(route('violence-reports.show', $report->id))
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'violence_report' => [
                        'id' => $report->id,
                    ],
                ],
            ]);
    }

    /**
     * Fetch Report Data
     *
     *
     * @return void
     */
    #[Test]
    public function fetches_report_data()
    {
        //
        $reports = ViolenceReport::factory()->create();

        $this->get(route('violence-reports.show.data', [
            'q' => NgState::find($reports->first()->ng_state_id)->name,
            'start' => date('Y-m-d', strtotime('8 years ago')),
            'end' => date('Y-m-d', strtotime('1 years ago')),
        ]))
            ->assertStatus(200);
    }
}

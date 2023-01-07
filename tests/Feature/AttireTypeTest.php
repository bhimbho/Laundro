<?php

namespace Tests\Feature;

use App\Models\Administrator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Testing\File;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AttireTypeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_attire_types_can_be_created()
    {
        Sanctum::actingAs(
            Administrator::factory()->create()
        );
        Storage::fake();
        $response = $this->postJson(route('attires.store'), [
            'title' => 'Women Men2',
            'attire_image' => UploadedFile::fake()->image('avatar.png'),
            'group' => 'xxl'
        ]);

        $response->assertSuccessful();
    }

    public function test_correct_image_extension_is_validated()
    {
        Sanctum::actingAs(
            Administrator::factory()->create()
        );
        Storage::fake();
        $response = $this->postJson(route('attires.store'), [
            'title' => 'Women Men2',
            'attire_image' => UploadedFile::fake()->create('avatar.pdf'),
            'group' => 'xxl'
        ]);

        $response->assertJsonStructure(['errors']);
        $response->assertSeeText('The attire image must be an image');
    }
}

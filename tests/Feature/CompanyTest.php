<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_name_is_required()
    {
        $this->get_authenticated();

        Storage::fake('public');
        
        $response = $this->post('companies', [
            'name' => '',
            'email' => 'test@example.com',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example.com',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_email_is_required()
    {
        $this->get_authenticated();

        Storage::fake('public');
        
        $response = $this->post('companies', [
            'name' => 'Sample Company Name',
            'email' => '',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function an_email_is_unique()
    {
        $this->get_authenticated();

        Storage::fake('public');

        $this->post('companies', [
            'name' => 'Sample Company Name 1',
            'email' => 'test1@test.com',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example1.com',
        ]);
        
        $response = $this->post('companies', [
            'name' => 'Sample Company Name 2',
            'email' => 'test1@test.com',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example2.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function an_email_is_in_correct_format()
    {
        $this->get_authenticated();

        Storage::fake('public');
        
        $response = $this->post('companies', [
            'name' => 'Sample Company Name',
            'email' => 'test',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_logo_is_required()
    {
        $this->get_authenticated();
        
        $response = $this->post('companies', [
            'name' => 'Sample Company Name',
            'email' => 'test@test.co',
            'logo' => '',
            'website' => 'http://example.com',
        ]);

        $response->assertSessionHasErrors('logo');
    }

    /** @test */
    public function a_logo_has_correct_dimensions()
    {
        $this->get_authenticated();
        
        $response = $this->post('companies', [
            'name' => 'Sample Company Name',
            'email' => 'test@test.co',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 10, 40),
            'website' => 'http://example.com',
        ]);

        $response->assertSessionHasErrors('logo');
    }

    /** @test */
    public function a_company_can_be_created()
    {
        $this->get_authenticated();
        
        $this->withoutExceptionHandling();

        $response = $this->create_a_company();

        $response->assertStatus(302);
        $this->assertCount(1, Company::all());
    }

    /** @test */
    public function a_company_can_be_updated()
    {
        $this->get_authenticated();
        
        $this->withoutExceptionHandling();

        $this->create_a_company();

        $company = Company::first();
        
        $response = $this->put('/companies/' . $company->id, [
            'name' => 'test company',
            'email' => 'test@ww.co1',
            'website' => 'http://example.com'
        ]);
        
        $this->assertEquals('test company', Company::first()->name);
    }

    /** @test */
    public function a_company_can_be_deleted()
    {
        $this->get_authenticated();
        
        $this->withoutExceptionHandling();

        $this->create_a_company();
        
        $company = Company::first();

        $this->assertCount(1, Company::all());

        $response = $this->delete('/companies/' . $company->id);
        
        $this->assertCount(0, Company::all());
    }

    private function get_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
    
    private function create_a_company()
    {
        Storage::fake('public');
        
        return $this->post('companies', [
            'name' => 'test company',
            'email' => 'test@example.com',
            'logo' => $file = UploadedFile::fake()->image('AdminLTELogo.png', 100, 100),
            'website' => 'http://example.com',
        ]);
    }
}
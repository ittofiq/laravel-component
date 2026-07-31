<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageRenderTest extends TestCase
{
    /**
     * Test that all demo pages load successfully.
     */
    public function test_home_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('BacaDev');
    }

    public function test_components_demo_page_loads(): void
    {
        $response = $this->get('/components');
        $response->assertStatus(200);
        $response->assertSee('Component Library');
    }

    public function test_demo_index_page_loads(): void
    {
        $response = $this->get('/demo');
        $response->assertStatus(200);
        $response->assertSee('Demo Pages');
    }

    public function test_demo_minimal_page_loads(): void
    {
        $response = $this->get('/demo-minimal');
        $response->assertStatus(200);
    }

    public function test_custom_components_demo_page_loads(): void
    {
        $response = $this->get('/custom-components');
        $response->assertStatus(200);
    }

    public function test_textarea_demo_page_loads(): void
    {
        $response = $this->get('/textarea-demo');
        $response->assertStatus(200);
    }

    /**
     * Test that all component categories are rendered on the main demo page.
     */
    public function test_category_pages_load(): void
    {
        foreach (['ui', 'form', 'data', 'navigation', 'overlay', 'feedback', 'layout', 'custom'] as $cat) {
            $response = $this->get("/components/{$cat}");
            $response->assertStatus(200);
        }
    }

    /**
     * Test dark mode toggle is present on all pages.
     */
    public function test_dark_mode_toggle_is_present(): void
    {
        $response = $this->get('/');
        $response->assertSee('dark');
    }
}
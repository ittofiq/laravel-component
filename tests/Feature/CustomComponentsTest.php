<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class CustomComponentsTest extends ComponentTestCase
{
    public function test_loader_renders_with_text()
    {
        $html = $this->renderComponent('custom.loader', [
            'size' => 'lg',
            'text' => 'Loading...',
        ]);

        $this->assertStringContainsString('Loading...', $html);
    }

    public function test_rating_stars_renders()
    {
        $html = $this->renderComponent('custom.rating-stars', [
            'rating' => 4,
            'maxStars' => 5,
        ]);

        // Star buttons should be present
        $this->assertStringContainsString('type="button"', $html);
    }

    public function test_rating_stars_interactive_renders()
    {
        $html = $this->renderComponent('custom.rating-stars', [
            'rating' => 3,
            'interactive' => true,
        ]);

        $this->assertNotEmpty($html);
    }

    public function test_shopping_cart_renders_items()
    {
        $html = $this->renderComponent('custom.shopping-cart', [
            'items' => [
                ['name' => 'Product A', 'price' => 99.99, 'quantity' => 2],
            ],
        ]);

        $this->assertStringContainsString('Product A', $html);
        $this->assertHasDarkClasses($html);
    }

    public function test_user_profile_renders()
    {
        $html = $this->renderComponent('custom.user-profile', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'Developer',
        ]);

        $this->assertSeeAll($html, ['John Doe', 'john@example.com', 'Developer']);
        $this->assertHasDarkClasses($html);
    }

    public function test_pricing_card_shows_popular_badge()
    {
        $html = $this->renderComponent('custom.pricing-card', [
            'plan' => 'Pro',
            'price' => '$29',
            'features' => ['20 Projects', '100GB Storage'],
            'popular' => true,
        ]);

        $this->assertSeeAll($html, ['Pro', '$29', '20 Projects', 'POPULER']);
    }

    public function test_pricing_card_without_popular_has_no_badge()
    {
        $html = $this->renderComponent('custom.pricing-card', [
            'plan' => 'Basic',
            'price' => '$9',
        ]);

        $this->assertStringNotContainsString('POPULER', $html);
    }

    public function test_permission_system_renders_roles()
    {
        $html = $this->renderComponent('custom.permission-system', [
            'roles' => [
                ['name' => 'Admin', 'permissions' => [['name' => 'Create', 'granted' => true]]],
            ],
        ]);

        $this->assertSeeAll($html, ['Admin', 'Create']);
        $this->assertHasDarkClasses($html);
    }

    public function test_protected_button_renders_slot()
    {
        $html = $this->renderSlotComponent('custom.protected-button', 'Edit Post', ['permission' => 'edit-post']);

        $this->assertStringContainsString('Edit Post', $html);
    }

    public function test_two_fa_auth_step_one_renders()
    {
        $html = $this->renderComponent('custom.two-fa-auth');

        $this->assertStringContainsString('Verify', $html);
    }
}
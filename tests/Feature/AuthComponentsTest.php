<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class AuthComponentsTest extends ComponentTestCase
{
    public function test_login_card_renders()
    {
        $html = $this->renderComponent('auth.login-card');

        $this->assertSeeAll($html, ['Sign In']);
        $this->assertStringContainsString('type="email"', $html);
        $this->assertStringContainsString('name="password"', $html);
        $this->assertHasDarkClasses($html);
    }

    public function test_login_card_accepts_custom_labels()
    {
        $html = $this->renderComponent('auth.login-card', [
            'title' => 'Masuk',
            'emailLabel' => 'Alamat Email',
            'submitLabel' => 'Login',
        ]);

        $this->assertSeeAll($html, ['Masuk', 'Alamat Email', 'Login']);
    }

    public function test_register_card_renders()
    {
        $html = $this->renderComponent('auth.register-card');

        $this->assertSeeAll($html, ['Create Account']);
        $this->assertStringContainsString('type="email"', $html);
        $this->assertStringContainsString('name="password"', $html);
        $this->assertHasDarkClasses($html);
    }

    public function test_reset_password_card_renders()
    {
        $html = $this->renderComponent('auth.reset-password-card');

        $this->assertSeeAll($html, ['Reset Password']);
        $this->assertStringContainsString('type="email"', $html);
        $this->assertHasDarkClasses($html);
    }

    public function test_change_password_card_renders()
    {
        $html = $this->renderComponent('auth.change-password-card');

        $this->assertSeeAll($html, ['Ubah Password']);
        $this->assertStringContainsString('name="current_password"', $html);
        $this->assertHasDarkClasses($html);
    }
}
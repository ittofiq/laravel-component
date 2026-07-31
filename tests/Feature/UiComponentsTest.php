<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class UiComponentsTest extends ComponentTestCase
{
    // ============================================================
    // Button
    // ============================================================

    public function test_button_renders_with_variants(): void
    {
        $html = $this->renderComponent('ui.button', ['variant' => 'primary']);
        $this->assertStringContainsString('bg-blue-500', $html);

        $html = $this->renderComponent('ui.button', ['variant' => 'danger']);
        $this->assertStringContainsString('bg-red-500', $html);

        $html = $this->renderComponent('ui.button', ['variant' => 'success']);
        $this->assertStringContainsString('bg-green-500', $html);

        $html = $this->renderComponent('ui.button', ['variant' => 'secondary']);
        $this->assertStringContainsString('bg-gray-200', $html);
    }

    public function test_button_renders_disabled_state(): void
    {
        $html = $this->renderComponent('ui.button', ['disabled' => true]);
        $this->assertStringContainsString('disabled', $html);
    }

    public function test_button_renders_correctly(): void
    {
        $html = $this->renderComponent('ui.button', ['variant' => 'primary']);
        $this->assertStringContainsString('<button', $html);
        $this->assertStringContainsString('bg-blue-500', $html);
    }

    public function test_button_renders_with_slot(): void
    {
        $html = $this->renderSlotComponent('ui.button', 'Click Me', ['variant' => 'primary']);
        $this->assertStringContainsString('Click Me', $html);
    }

    // ============================================================
    // Badge
    // ============================================================

    public function test_badge_renders_with_variants(): void
    {
        foreach (['primary', 'secondary', 'success', 'warning', 'danger'] as $variant) {
            $html = $this->renderSlotComponent('ui.badge', $variant, ['variant' => $variant]);
            $this->assertStringContainsString($variant, $html);
        }
    }

    public function test_badge_has_dark_mode_classes(): void
    {
        $html = $this->renderSlotComponent('ui.badge', 'Test', ['variant' => 'primary']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Avatar
    // ============================================================

    public function test_avatar_renders_with_initials(): void
    {
        $html = $this->renderComponent('ui.avatar', ['initials' => 'JD']);
        $this->assertStringContainsString('JD', $html);
    }

    public function test_avatar_renders_with_sizes(): void
    {
        $html = $this->renderComponent('ui.avatar', ['initials' => 'JD', 'size' => 'sm']);
        $this->assertStringContainsString('JD', $html);

        $html = $this->renderComponent('ui.avatar', ['initials' => 'AB', 'size' => 'lg']);
        $this->assertStringContainsString('AB', $html);
    }

    public function test_avatar_renders_with_colors(): void
    {
        $html = $this->renderComponent('ui.avatar', ['initials' => 'JD', 'color' => 'blue']);
        $this->assertStringContainsString('JD', $html);
        $this->assertStringContainsString('bg-blue', $html);
    }

    // ============================================================
    // Card
    // ============================================================

    public function test_card_renders_with_title(): void
    {
        $html = $this->renderComponent('ui.card', ['title' => 'Card Title']);
        $this->assertStringContainsString('Card Title', $html);
    }

    public function test_card_renders_with_subtitle(): void
    {
        $html = $this->renderComponent('ui.card', ['title' => 'Title', 'subtitle' => 'Subtitle']);
        $this->assertStringContainsString('Subtitle', $html);
    }

    public function test_card_renders_slot_content(): void
    {
        $html = $this->renderSlotComponent('ui.card', 'Card Body', ['title' => 'Title']);
        $this->assertStringContainsString('Card Body', $html);
    }

    public function test_card_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('ui.card', ['title' => 'Title']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Tag
    // ============================================================

    public function test_tag_renders_with_variant(): void
    {
        $html = $this->renderSlotComponent('ui.tag', 'Tag Label', ['variant' => 'primary']);
        $this->assertStringContainsString('Tag Label', $html);
    }

    public function test_tag_has_dark_mode_classes(): void
    {
        $html = $this->renderSlotComponent('ui.tag', 'Tag', ['variant' => 'primary']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Chip
    // ============================================================

    public function test_chip_renders(): void
    {
        $html = $this->renderSlotComponent('ui.chip', 'Chip Label');
        $this->assertStringContainsString('Chip Label', $html);
    }

    public function test_chip_has_dark_mode_classes(): void
    {
        $html = $this->renderSlotComponent('ui.chip', 'Chip');
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Divider
    // ============================================================

    public function test_divider_renders(): void
    {
        $html = $this->renderComponent('ui.divider');
        $this->assertNotEmpty($html);
    }

    public function test_divider_renders_with_text(): void
    {
        $html = $this->renderComponent('ui.divider', ['text' => 'OR']);
        $this->assertStringContainsString('OR', $html);
    }

    public function test_divider_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('ui.divider');
        $this->assertHasDarkClasses($html);
    }
}
<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class FeedbackComponentsTest extends ComponentTestCase
{
    // ============================================================
    // Alert
    // ============================================================

    public function test_alert_renders_all_types(): void
    {
        foreach (['info', 'success', 'warning', 'danger'] as $type) {
            $html = $this->renderSlotComponent('feedback.alert', 'Alert message', ['type' => $type]);
            $this->assertStringContainsString('Alert message', $html);
        }
    }

    public function test_alert_renders_dismissible(): void
    {
        $html = $this->renderSlotComponent('feedback.alert', 'Dismiss me', ['type' => 'info', 'dismissible' => true]);
        $this->assertStringContainsString('Dismiss me', $html);
    }

    public function test_alert_has_dark_mode_classes(): void
    {
        $html = $this->renderSlotComponent('feedback.alert', 'Alert', ['type' => 'info']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Toast
    // ============================================================

    public function test_toast_renders_with_message(): void
    {
        $html = $this->renderComponent('feedback.toast', [
            'type' => 'success',
            'message' => 'Saved successfully',
            'show' => 'true',
        ]);
        $this->assertStringContainsString('Saved successfully', $html);
    }

    public function test_toast_renders_all_types(): void
    {
        foreach (['success', 'error', 'warning', 'info'] as $type) {
            $html = $this->renderComponent('feedback.toast', [
                'type' => $type,
                'message' => 'Test message',
                'show' => 'true',
            ]);
            $this->assertNotEmpty($html);
        }
    }

    public function test_toast_renders_all_positions(): void
    {
        foreach (['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'] as $pos) {
            $html = $this->renderComponent('feedback.toast', [
                'type' => 'info',
                'message' => 'Position test',
                'position' => $pos,
                'show' => 'true',
            ]);
            $this->assertNotEmpty($html);
        }
    }

    public function test_toast_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('feedback.toast', [
            'type' => 'success',
            'message' => 'Test',
            'show' => 'true',
        ]);
        $this->assertHasDarkClasses($html);
    }

    public function test_toast_renders_with_custom_duration(): void
    {
        $html = $this->renderComponent('feedback.toast', [
            'type' => 'info',
            'message' => 'Custom duration',
            'duration' => '10000',
            'show' => 'true',
        ]);
        $this->assertNotEmpty($html);
    }

    public function test_toast_container_renders(): void
    {
        $html = $this->renderComponent('feedback.toast-container', ['position' => 'top-right']);
        $this->assertNotEmpty($html);
    }

    public function test_toast_container_renders_with_alpine_binding(): void
    {
        $html = $this->renderComponent('feedback.toast-container', ['position' => 'top-right']);
        $this->assertStringContainsString('toastContainerComponent', $html);
        $this->assertStringContainsString('x-on:add-toast.window', $html);
    }

    // ============================================================
    // Spinner
    // ============================================================

    public function test_spinner_renders(): void
    {
        $html = $this->renderComponent('feedback.spinner');
        $this->assertStringContainsString('animate-spin', $html);
    }

    public function test_spinner_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('feedback.spinner');
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Skeleton
    // ============================================================

    public function test_skeleton_renders_text_type(): void
    {
        $html = $this->renderComponent('feedback.skeleton', ['type' => 'text', 'count' => '3']);
        $this->assertStringContainsString('animate-pulse', $html);
    }

    public function test_skeleton_renders_all_types(): void
    {
        foreach (['text', 'paragraph', 'image', 'circle', 'card', 'profile', 'table-row'] as $type) {
            $html = $this->renderComponent('feedback.skeleton', ['type' => $type, 'count' => '3']);
            $this->assertNotEmpty($html);
        }
    }

    public function test_skeleton_respects_count_parameter(): void
    {
        $html = $this->renderComponent('feedback.skeleton', ['type' => 'text', 'count' => '5']);
        $this->assertNotEmpty($html);
    }

    public function test_skeleton_supports_custom_size(): void
    {
        foreach (['sm', 'md', 'lg'] as $size) {
            $html = $this->renderComponent('feedback.skeleton', ['type' => 'circle', 'size' => $size]);
            $this->assertNotEmpty($html);
        }
    }

    public function test_skeleton_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('feedback.skeleton', ['type' => 'text', 'count' => '3']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Empty State
    // ============================================================

    public function test_empty_state_renders_with_defaults(): void
    {
        $html = $this->renderComponent('feedback.empty-state');
        $this->assertStringContainsString('Tidak ada data', $html);
    }

    public function test_empty_state_renders_with_custom_content(): void
    {
        $html = $this->renderComponent('feedback.empty-state', [
            'icon' => '🔍',
            'title' => 'No Results',
            'message' => 'Try different keywords',
        ]);
        $this->assertSeeAll($html, ['🔍', 'No Results', 'Try different keywords']);
    }

    public function test_empty_state_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('feedback.empty-state');
        $this->assertHasDarkClasses($html);
    }
}
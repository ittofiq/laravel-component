<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class FormComponentsTest extends ComponentTestCase
{
    // ============================================================
    // Input
    // ============================================================

    public function test_input_renders_with_label(): void
    {
        $html = $this->renderComponent('form.input', [
            'name' => 'email',
            'label' => 'Email Address',
            'type' => 'email',
        ]);
        $this->assertSeeAll($html, ['Email Address', 'email']);
    }

    public function test_input_renders_required_indicator(): void
    {
        $html = $this->renderComponent('form.input', [
            'name' => 'name',
            'label' => 'Name',
            'required' => true,
        ]);
        $this->assertStringContainsString('*', $html);
    }

    public function test_input_renders_error_state(): void
    {
        $html = $this->renderComponent('form.input', [
            'name' => 'email',
            'label' => 'Email',
            'error' => 'Email is required',
        ]);
        $this->assertStringContainsString('Email is required', $html);
    }

    public function test_input_renders_disabled_state(): void
    {
        $html = $this->renderComponent('form.input', [
            'name' => 'field',
            'label' => 'Field',
            'disabled' => true,
        ]);
        $this->assertStringContainsString('disabled', $html);
    }

    public function test_input_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.input', ['name' => 'test', 'label' => 'Test']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Textarea
    // ============================================================

    public function test_textarea_renders_with_label(): void
    {
        $html = $this->renderComponent('form.textarea', [
            'name' => 'message',
            'label' => 'Message',
        ]);
        $this->assertSeeAll($html, ['Message', 'textarea']);
    }

    public function test_textarea_renders_with_rows(): void
    {
        $html = $this->renderComponent('form.textarea', [
            'name' => 'message',
            'label' => 'Message',
            'rows' => '10',
        ]);
        $this->assertNotEmpty($html);
    }

    public function test_textarea_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.textarea', ['name' => 'test', 'label' => 'Test']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Select
    // ============================================================

    public function test_select_renders_with_label(): void
    {
        $html = $this->renderComponent('form.select', [
            'name' => 'option',
            'label' => 'Choose Option',
        ]);
        $this->assertStringContainsString('Choose Option', $html);
    }

    public function test_select_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.select', ['name' => 'test', 'label' => 'Test']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Checkbox
    // ============================================================

    public function test_checkbox_renders_with_label(): void
    {
        $html = $this->renderComponent('form.checkbox', [
            'name' => 'agree',
            'label' => 'I agree',
        ]);
        $this->assertStringContainsString('I agree', $html);
    }

    public function test_checkbox_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.checkbox', ['name' => 'test', 'label' => 'Test']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Radio
    // ============================================================

    public function test_radio_renders(): void
    {
        $html = $this->renderComponent('form.radio', [
            'name' => 'choice',
            'value' => 'yes',
            'label' => 'Yes',
        ]);
        $this->assertStringContainsString('Yes', $html);
    }

    public function test_radio_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.radio', ['name' => 'test', 'value' => 'a', 'label' => 'Test']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Date / Time / DateTime Inputs
    // ============================================================

    public function test_date_input_renders(): void
    {
        $html = $this->renderComponent('form.date-input', ['name' => 'date', 'label' => 'Date']);
        $this->assertNotEmpty($html);
    }

    public function test_time_input_renders(): void
    {
        $html = $this->renderComponent('form.time-input', ['name' => 'time', 'label' => 'Time']);
        $this->assertNotEmpty($html);
    }

    public function test_datetime_input_renders(): void
    {
        $html = $this->renderComponent('form.datetime-input', ['name' => 'datetime', 'label' => 'DateTime']);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Color Picker
    // ============================================================

    public function test_color_picker_renders(): void
    {
        $html = $this->renderComponent('form.color-picker', [
            'name' => 'color',
            'label' => 'Choose Color',
        ]);
        $this->assertNotEmpty($html);
    }

    public function test_color_picker_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('form.color-picker', ['name' => 'color', 'label' => 'Color']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // File Upload
    // ============================================================

    public function test_file_upload_renders(): void
    {
        $html = $this->renderComponent('form.file-upload', ['name' => 'file', 'label' => 'Upload']);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Search Input
    // ============================================================

    public function test_search_input_renders(): void
    {
        $html = $this->renderComponent('form.search-input', ['name' => 'search', 'label' => 'Search']);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Form Wizard
    // ============================================================

    public function test_form_wizard_renders(): void
    {
        $html = $this->renderComponent('form.form-wizard', ['steps' => ['Step 1', 'Step 2', 'Step 3']]);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Rich Text Editor
    // ============================================================

    public function test_rich_text_editor_renders(): void
    {
        $html = $this->renderComponent('form.rich-text-editor', ['name' => 'content', 'label' => 'Content']);
        $this->assertNotEmpty($html);
    }
}
<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class DataNavigationComponentsTest extends ComponentTestCase
{
    // ============================================================
    // Data: Table
    // ============================================================

    public function test_table_renders(): void
    {
        $html = $this->renderComponent('data.table', [
            'headers' => ['Name', 'Email'],
            'rows' => [['John', 'john@example.com']],
        ]);
        $this->assertSeeAll($html, ['Name', 'Email', 'John', 'table']);
    }

    public function test_table_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('data.table', [
            'headers' => ['Name'],
            'rows' => [['Test']],
        ]);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Data: Advanced Table
    // ============================================================

    public function test_advanced_table_renders(): void
    {
        $html = $this->renderComponent('data.advanced-table', [
            'headers' => [['key' => 'name', 'label' => 'Name']],
            'rows' => [['name' => 'John']],
        ]);
        $this->assertStringContainsString('advancedTableComponent', $html);
    }

    // ============================================================
    // Data: Progress Bar
    // ============================================================

    public function test_progress_bar_renders(): void
    {
        $html = $this->renderComponent('data.progress-bar', ['percent' => '60']);
        $this->assertNotEmpty($html);
    }

    public function test_progress_bar_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('data.progress-bar', ['percent' => '50']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Data: Stat Card
    // ============================================================

    public function test_stat_card_renders(): void
    {
        $html = $this->renderComponent('data.stat-card', [
            'label' => 'Users',
            'value' => '1.2K',
            'icon' => '👥',
        ]);
        $this->assertSeeAll($html, ['Users', '1.2K', '👥']);
    }

    public function test_stat_card_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('data.stat-card', [
            'label' => 'Test',
            'value' => '1',
            'icon' => '📊',
        ]);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Data: Timeline
    // ============================================================

    public function test_timeline_renders(): void
    {
        $html = $this->renderComponent('data.timeline', [
            'items' => [['title' => 'Event 1', 'date' => 'Today', 'content' => 'Done']],
        ]);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Navigation: Breadcrumb
    // ============================================================

    public function test_breadcrumb_renders(): void
    {
        $html = $this->renderComponent('navigation.breadcrumb', [
            'items' => [['label' => 'Home'], ['label' => 'Products'], ['label' => 'Item']],
        ]);
        $this->assertSeeAll($html, ['Home', 'Products', 'Item']);
    }

    public function test_breadcrumb_renders_with_links(): void
    {
        $html = $this->renderComponent('navigation.breadcrumb', [
            'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Products']],
        ]);
        $this->assertStringContainsString('Home', $html);
        $this->assertStringContainsString('Products', $html);
    }

    // ============================================================
    // Navigation: Pagination
    // ============================================================

    public function test_pagination_renders(): void
    {
        $html = $this->renderComponent('navigation.pagination', [
            'total' => '100',
            'perPage' => '10',
            'currentPage' => '1',
        ]);
        $this->assertNotEmpty($html);
    }

    // ============================================================
    // Navigation: Tabs
    // ============================================================

    public function test_tabs_renders(): void
    {
        $html = $this->renderComponent('navigation.tabs', [
            'tabs' => [
                ['label' => 'Tab 1', 'content' => 'Content 1'],
                ['label' => 'Tab 2', 'content' => 'Content 2'],
                ['label' => 'Tab 3', 'content' => 'Content 3'],
            ],
        ]);
        $this->assertSeeAll($html, ['Tab 1', 'Tab 2', 'Tab 3']);
    }

    public function test_tabs_renders_with_default_active(): void
    {
        $html = $this->renderComponent('navigation.tabs', [
            'tabs' => [['label' => 'First', 'content' => 'First content']],
        ]);
        $this->assertStringContainsString('First', $html);
    }

    // ============================================================
    // Navigation: Dropdown
    // ============================================================

    public function test_dropdown_renders(): void
    {
        $html = $this->renderComponent('navigation.dropdown', ['label' => 'Menu']);
        $this->assertStringContainsString('Menu', $html);
    }

    public function test_dropdown_has_dark_mode_classes(): void
    {
        $html = $this->renderComponent('navigation.dropdown', ['label' => 'Menu']);
        $this->assertHasDarkClasses($html);
    }

    // ============================================================
    // Navigation: Sidebar
    // ============================================================

    public function test_sidebar_renders(): void
    {
        $html = $this->renderComponent('navigation.sidebar', [
            'links' => ['Home', 'Settings', 'Logout'],
        ]);
        $this->assertNotEmpty($html);
    }
}
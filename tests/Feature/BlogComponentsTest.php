<?php

namespace Tests\Feature;

use Tests\ComponentTestCase;

class BlogComponentsTest extends ComponentTestCase
{
    public function test_article_card_renders()
    {
        $html = $this->renderComponent('blog.article-card', [
            'title' => 'Belajar Laravel',
            'category' => 'Web Development',
            'author' => 'Andi Wijaya',
            'date' => '12 Agustus 2026',
        ]);

        $this->assertSeeAll($html, ['Belajar Laravel', 'Web Development', 'Andi Wijaya', '12 Agustus 2026']);
        $this->assertHasDarkClasses($html);
    }

    public function test_article_meta_renders()
    {
        $html = $this->renderComponent('blog.article-meta', [
            'author' => 'Andi',
            'date' => '12 Agustus 2026',
            'readTime' => '6 menit',
            'views' => '1.2K',
        ]);

        $this->assertSeeAll($html, ['Andi', '12 Agustus 2026', '6 menit', '1.2K']);
    }

    public function test_comment_renders()
    {
        $html = $this->renderComponent('blog.comment', [
            'name' => 'Budi',
            'time' => '2 jam lalu',
            'text' => 'Artikel bagus!',
        ]);

        $this->assertSeeAll($html, ['Budi', '2 jam lalu', 'Artikel bagus!']);
        $this->assertHasDarkClasses($html);
    }

    public function test_post_renders()
    {
        $html = $this->renderComponent('blog.post', [
            'title' => 'Judul Artikel',
            'category' => 'Laravel',
            'author' => 'Andi',
        ]);

        $this->assertSeeAll($html, ['Judul Artikel', 'Laravel', 'Andi']);
        $this->assertHasDarkClasses($html);
    }

    public function test_author_card_renders()
    {
        $html = $this->renderComponent('blog.author-card', [
            'name' => 'Andi Wijaya',
            'bio' => 'Penulis Laravel',
        ]);

        $this->assertSeeAll($html, ['Andi Wijaya', 'Penulis Laravel']);
        $this->assertHasDarkClasses($html);
    }

    public function test_related_posts_renders()
    {
        $html = $this->renderComponent('blog.related-posts', [
            'posts' => [
                ['title' => 'Artikel A'],
                ['title' => 'Artikel B'],
            ],
        ]);

        $this->assertSeeAll($html, ['Artikel Terkait', 'Artikel A', 'Artikel B']);
    }

    public function test_sidebar_renders_slot()
    {
        $html = $this->renderSlotComponent('blog.sidebar', '<p>Konten sidebar</p>');

        $this->assertSeeAll($html, ['Konten sidebar']);
    }

    public function test_widget_renders_title_and_slot()
    {
        $html = $this->renderSlotComponent('blog.widget', '<p>Isi widget</p>', ['title' => 'Kategori']);

        $this->assertSeeAll($html, ['Kategori', 'Isi widget']);
        $this->assertHasDarkClasses($html);
    }

    public function test_category_list_renders()
    {
        $html = $this->renderComponent('blog.category-list', [
            'categories' => [
                ['name' => 'Web Development', 'count' => 12],
                ['name' => 'Design', 'count' => 8],
            ],
        ]);

        $this->assertSeeAll($html, ['Web Development', '12', 'Design', '8']);
    }

    public function test_popular_posts_renders()
    {
        $html = $this->renderComponent('blog.popular-posts', [
            'posts' => [
                ['title' => 'Post Populer'],
                ['title' => 'Tutorial Laravel'],
            ],
        ]);

        $this->assertSeeAll($html, ['Post Populer', 'Tutorial Laravel']);
    }

    public function test_tag_cloud_renders()
    {
        $html = $this->renderComponent('blog.tag-cloud', [
            'tags' => ['Laravel', 'Tailwind'],
        ]);

        $this->assertSeeAll($html, ['Laravel', 'Tailwind']);
    }

    public function test_newsletter_renders()
    {
        $html = $this->renderComponent('blog.newsletter');

        $this->assertSeeAll($html, ['Newsletter', 'Langganan']);
        $this->assertHasDarkClasses($html);
    }
}
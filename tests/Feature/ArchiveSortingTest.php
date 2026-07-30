<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArchiveSortingTest extends TestCase
{
    public function test_archive_listing_is_sorted_by_issue_date_descending(): void
    {
        $books = collect([
            (object) ['id' => 1, 'title' => 'Book Old', 'volume' => 'Vol 1', 'issue' => '2022-01-01', 'iscurrent' => 0, 'image' => '', 'slug' => 'book-old', 's_description' => 'Desc 1'],
            (object) ['id' => 2, 'title' => 'Book New', 'volume' => 'Vol 2', 'issue' => '2024-06-01', 'iscurrent' => 0, 'image' => '', 'slug' => 'book-new', 's_description' => 'Desc 2'],
            (object) ['id' => 3, 'title' => 'Book Mid', 'volume' => 'Vol 3', 'issue' => '2023-03-15', 'iscurrent' => 0, 'image' => '', 'slug' => 'book-mid', 's_description' => 'Desc 3'],
        ]);

        $html = view('admin.templete.archive.index', [
            'books' => $books,
            'bookArticles' => collect([]),
        ])->render();

        $posNew = strpos($html, 'Book New');
        $posMid = strpos($html, 'Book Mid');
        $posOld = strpos($html, 'Book Old');

        $this->assertTrue($posNew !== false && $posMid !== false && $posOld !== false);
        $this->assertTrue($posNew < $posMid);
        $this->assertTrue($posMid < $posOld);
    }
}

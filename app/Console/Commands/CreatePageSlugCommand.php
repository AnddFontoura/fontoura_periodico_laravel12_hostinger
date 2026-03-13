<?php

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreatePageSlugCommand extends Command
{
    protected $signature = 'app:create-page-slug-command';

    protected $description = 'Command description';

    public function handle()
    {
        $pages = Page::all();

        foreach ($pages as $page) {
            $page->slug = Str::slug($page->name);
            $page->save();
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Models\Comments;
use Carbon\Carbon;

class AddComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news-comment:create {NewsID} {Comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add news comment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $news = News::where('id', $this->argument('NewsID'))->get();
        if(!count($news))
            dd("News not found");

        $commentId = Comments::insertGetId([
            'news_id' => $this->argument('NewsID'),
            'text' => $this->argument('Comment'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        News::where('id', $this->argument('NewsID'))->increment('comment_count');

        echo $commentId;
    }
}

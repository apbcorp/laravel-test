<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Models\Comments;

class DelComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news-comment:delete {CommentID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete news comment';

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
        $news_id = Comments::select('news_id')->where('id', $this->argument('CommentID'))->get();

        if(!count($news_id))
            dd('Comment not found');

        Comments::where('id', $this->argument('CommentID'))->delete();

        News::where('id', $news_id[0]->news_id)->decrement('comment_count');
    }
}

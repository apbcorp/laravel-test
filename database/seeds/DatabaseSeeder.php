<?php

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Comments;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('NewsSeeder');
        $this->call('CommentsSeeder');
    }
}

class NewsSeeder extends Seeder{

    public function run()
    {
        DB::table('News')->delete();
        News::create([
            'title' => 'First News',
            'text' => 'First News Text',
            'comment_count' => 1
        ]);

        News::create([
            'title' => 'Second News',
            'text' => 'Second News Text',
            'comment_count' => 0
        ]);

        News::create([
            'title' => 'Third News',
            'text' => 'Third News Text',
            'comment_count' => 0
        ]);
    }

}

class CommentsSeeder extends Seeder{

    public function run()
    {
        DB::table('Comments')->delete();
        Comments::create([
            'news_id' => 1,
            'text' => 'Comment 1'
        ]);
    }

}
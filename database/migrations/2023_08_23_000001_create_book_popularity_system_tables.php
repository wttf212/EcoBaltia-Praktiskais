<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 264);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 264);
            $table->integer('total_pages');
            $table->date('published_at');
            $table->foreignId('publisher_id')->constrained('publishers');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('book_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('author_id')->constrained('authors');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('book_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('genre_id')->constrained('genres');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('book_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        DB::table('publishers')->insert([
            [
                'name' => 'Janis Roze'
            ],
            [
                'name' => 'Zvaigzne ABC'
            ]
        ]);

        DB::table('authors')->insert([
            [
                'full_name' => 'Ieva Samauska'
            ],
            [
                'full_name' => 'Odeds Galors'
            ],
            [
                'full_name' => 'Anna Jansone'
            ]
        ]);

        DB::table('genres')->insert([
            [
                'name' => 'Drama'
            ],
            [
                'name' => 'Zinatne'
            ],
            [
                'name' => 'Komedija'
            ],
            [
                'name' => 'Patiesi notikumi'
            ]
        ]);

        DB::table('books')->insert([
            [
                'title' => 'Pazudusi meita',
                'total_pages' => 342,
                'published_at' => '2022-06-12',
                'publisher_id' => 1
            ],
            [
                'title' => 'Kas tu busi, kad izaugsi jeb Celojums ar noslepumu',
                'total_pages' => 652,
                'published_at' => '2021-12-01',
                'publisher_id' => 2
            ],
            [
                'title' => 'Cilveces celojums',
                'total_pages' => 204,
                'published_at' => '2023-01-10',
                'publisher_id' => 2
            ],
            [
                'title' => 'Trakas lietas jeb ieraksti policijas dezurzurnala',
                'total_pages' => 931,
                'published_at' => '2019-12-29',
                'publisher_id' => 2
            ],
            [
                'title' => 'Septinas sparnotas atzinas maza somina',
                'total_pages' => 112,
                'published_at' => '2018-10-01',
                'publisher_id' => 2
            ],
        ]);

        DB::table('book_genres')->insert([
            [
                'book_id' => 1,
                'genre_id' => 4,
            ],
            [
                'book_id' => 2,
                'genre_id' => 4,
            ],
            [
                'book_id' => 3,
                'genre_id' => 1,
            ],
            [
                'book_id' => 4,
                'genre_id' => 1,
            ],
            [
                'book_id' => 5,
                'genre_id' => 2,
            ],
            [
                'book_id' => 1,
                'genre_id' => 2,
            ],
            [
                'book_id' => 2,
                'genre_id' => 3,
            ],
            [
                'book_id' => 3,
                'genre_id' => 3,
            ],
            [
                'book_id' => 4,
                'genre_id' => 4,
            ],
            [
                'book_id' => 5,
                'genre_id' => 4,
            ],
        ]);

        DB::table('book_authors')->insert([
            [
                'book_id' => 1,
                'author_id' => 3,
            ],
            [
                'book_id' => 2,
                'author_id' => 1,
            ],
            [
                'book_id' => 3,
                'author_id' => 2,
            ],
            [
                'book_id' => 4,
                'author_id' => 1,
            ],
            [
                'book_id' => 5,
                'author_id' => 1,
            ],
        ]);

        collect([3, 6, 1, 4, 9])->each(function (int $times, int $key) {
            for ($i = 1; $i <= $times; $i++) {
                DB::table('book_purchases')->insert([
                    [
                        'book_id' => $key + 1,
                        'created_at' => (new DateTimeImmutable())->sub(new DateInterval('P3D'))->format('Y-m-d')
                    ]
                ]);
            }
        });

        collect([3, 6, 1, 4, 9])->each(function (int $times, int $key) {
            for ($i = 1; $i <= $times; $i++) {
                DB::table('book_purchases')->insert([
                    [
                        'book_id' => $key + 1,
                        'created_at' => (new DateTimeImmutable())->sub(new DateInterval('P3M'))->format('Y-m-d')
                    ]
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /**
         * TODO: Drop tables in correct order
         */
    }
};

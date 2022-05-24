<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Course;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 500);
            $table->string('excerpt', 1000)->nullable();
            $table->longText('description_1')->nullable();
            $table->longText('description_2')->nullable();
            $table->string('teacher_name', 100)->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger('people_type')->comment('1: Tổng hợp | 2: Trẻ em');
            $table->string('age_range', 50)->nullable();
            $table->string('learn_time', 50)->nullable();
            $table->double('learn_price');
            $table->double('learn_price_discount')->nullable();
            $table->double('learn_price_for_tools')->nullable();
            $table->unsignedTinyInteger('learn_type')->comment('1: Online')
                ->default(Course::LEARN_TYPE_ONLINE);
            $table->unsignedTinyInteger('paper_type')->comment('1: Giấy Roki | 2: Giấy Happy | 3: Toan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

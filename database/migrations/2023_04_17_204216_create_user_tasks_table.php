<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('task_id');
            $table->timestamp('due_date');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('remarks', 100);
            $table->unsignedInteger('status_id');
            $table->timestamps();
            $table->softDeletes();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('status_id')->references('id')->on('statuses');

        });

        DB::statement('ALTER TABLE user_tasks MODIFY COLUMN id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;');
        DB::statement('ALTER TABLE user_tasks MODIFY COLUMN user_id INT(11) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE user_tasks MODIFY COLUMN task_id INT(11) UNSIGNED NOT NULL;');
        DB::statement('ALTER TABLE user_tasks MODIFY COLUMN status_id INT(12) UNSIGNED NOT NULL;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tasks');
    }
};

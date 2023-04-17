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
        Schema::create('tasks', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->string('name', 100);
            $table->string('description');
            $table->timestamp('due_date');
            $table->unsignedInteger('status_id');
            $table->timestamps();
            $table->softDeletes();

            // foreign key
            $table->foreign('status_id')->references('id')->on('statuses');

        });

        DB::statement('ALTER TABLE tasks MODIFY COLUMN id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;');
        DB::statement('ALTER TABLE tasks MODIFY COLUMN status_id INT(12) UNSIGNED NOT NULL;');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100)->unique();
            $table->string('phone_number', 20)->nullable();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->integer('department_id');
            $table->integer('designation_id');
            $table->date('date_of_joining');
            $table->enum('employment_status', ['active', 'inactive', 'resigned'])->default('active');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->text('address')->nullable();
            $table->string('reporting_manager', 20)->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('employment_type', ['fulltime', 'parttime', 'contract'])->default('fulltime');
            $table->string('profile_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

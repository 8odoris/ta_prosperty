<?php

use App\Enums\AgenciesEnum;
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
        Schema::create('spies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->enum('agency', AgenciesEnum::values())->nullable();
            $table->string('country_of_operation')->nullable();
            $table->date('birth_date');
            $table->date('death_date')->nullable();
            $table->timestamps();
            $table->unique(['name', 'surname', 'birth_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spies');
    }
};

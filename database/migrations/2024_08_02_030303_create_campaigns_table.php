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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('campaign_id'); // Excel'den gelen kampanya ID
            $table->string('campaign_name');
            $table->string('brand');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('network_category');
            $table->string('ad_model');
            $table->string('platform');
            $table->string('campaign_type');
            $table->integer('planned')->nullable();
            $table->decimal('spent', 10, 2)->nullable();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->decimal('unit_percentage', 5, 2)->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('sales')->nullable();
            $table->integer('impressions')->nullable();
            $table->integer('downloads')->nullable();
            $table->integer('views')->nullable();
            $table->string('currency')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropForeign(['group_id']);
        });

        Schema::dropIfExists('campaigns');
    }
};

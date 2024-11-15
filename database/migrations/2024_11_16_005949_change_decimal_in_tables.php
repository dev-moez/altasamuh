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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('minimum_donation_value', 15, 2)->change();
            $table->decimal('required_donation_value', 15, 2)->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('project_quick_donations', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
        });

        Schema::table('misc_donation_values', function (Blueprint $table) {
            $table->decimal('value', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('minimum_donation_value', 8, 2)->change();
            $table->decimal('required_donation_value', 8, 2)->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->change();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->change();
        });

        Schema::table('project_quick_donations', function (Blueprint $table) {
            $table->decimal('amount', 8, 2)->change();
        });

        Schema::table('misc_donation_values', function (Blueprint $table) {
            $table->decimal('value', 8, 2)->change();
        });
    }
};

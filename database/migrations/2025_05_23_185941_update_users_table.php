<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // ✅ Add new fields
            $table->string('username')->unique()->after('name');
            $table->string('phone')->nullable()->after('email');
            $table->string('country_code')->default('+60')->after('phone');
            $table->date('dob')->nullable()->after('country_code');
            $table->enum('role', ['admin', 'staff'])->after('dob');

            // ❌ Remove unused field (example)
            $table->dropColumn('email_verified_at');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback changes
            $table->dropColumn(['username', 'phone', 'country_code', 'dob', 'role']);
            $table->timestamp('email_verified_at')->nullable(); // Restore if dropped
        });
    }
};
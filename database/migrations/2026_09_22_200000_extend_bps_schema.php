<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username', 50)->nullable()->unique()->after('name');
            }
        });

        Schema::table('publikasis', function (Blueprint $table) {
            if (!Schema::hasColumn('publikasis', 'no')) {
                $table->unsignedInteger('no')->nullable()->unique()->after('id');
            }
            if (!Schema::hasColumn('publikasis', 'link')) {
                $table->text('link')->nullable()->after('sampul');
            }
        });
    }

    public function down(): void
    {
        Schema::table('publikasis', function (Blueprint $table) {
            if (Schema::hasColumn('publikasis', 'link')) $table->dropColumn('link');
            if (Schema::hasColumn('publikasis', 'no')) $table->dropUnique(['no']);
            if (Schema::hasColumn('publikasis', 'no')) $table->dropColumn('no');
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) $table->dropUnique(['username']);
            if (Schema::hasColumn('users', 'username')) $table->dropColumn('username');
        });
    }
};

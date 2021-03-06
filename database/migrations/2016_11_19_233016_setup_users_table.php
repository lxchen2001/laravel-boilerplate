<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetupUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->after('password')->default(true);

            $table->string('confirmation_token', 100)->after('active')
                ->nullable();
            $table->boolean('confirmed')->after('confirmation_token')
                ->default(false);

            $table->string('locale')->after('remember_token')->default('');
            $table->string('timezone')->after('locale')->default('');

            $table->string('slug')->after('timezone')->default('')->unique();
            $table->timestamp('last_access_at')->after('slug')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('locale')->default(null)->change();
            $table->string('timezone')->default(null)->change();
            $table->string('slug')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'active',
                'confirmed',
                'confirmation_token',
                'locale',
                'timezone',
                'slug',
                'last_access_at',
            ]);
        });
    }
}

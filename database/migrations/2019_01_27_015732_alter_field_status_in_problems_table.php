<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFieldStatusInProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE problems RENAME TO problems_tmp;");
        DB::statement('CREATE TABLE "problems" ("id" integer not null primary key autoincrement, "admin_id" integer not null, "name" varchar not null, "pdf_path" varchar not null, "time" integer not null, "status" varchar check ("status" in (\'show\', \'hide\', \'unused\')) not null, "created_at" datetime null, "updated_at" datetime null, foreign key("admin_id") references "users"("id") on delete cascade);');
        DB::statement("INSERT INTO problems SELECT * FROM problems_tmp;");
        DB::statement("DROP TABLE problems_tmp;");
        // Schema::table('problems', function (Blueprint $table) {
        //     $table->enum('status', ['show', 'hide', 'unused'])->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE problems RENAME TO problems_tmp;");
        DB::statement('CREATE TABLE "problems" ("id" integer not null primary key autoincrement, "admin_id" integer not null, "name" varchar not null, "pdf_path" varchar not null, "time" integer not null, "status" varchar check ("status" in (\'show\', \'hide\')) not null, "created_at" datetime null, "updated_at" datetime null, foreign key("admin_id") references "users"("id") on delete cascade);');
        DB::statement("INSERT INTO problems SELECT * FROM problems_tmp;");
        DB::statement("DROP TABLE problems_tmp;");
        // Schema::table('problems', function (Blueprint $table) {
        //     $table->enum('status', ['show', 'hide'])->change();
        // });
    }
}

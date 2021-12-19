<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->integer('assignedToUserID')->default(0);

            $table->integer('reporterID')->default(0);
            $table->integer('targetID')->default(0);
            $table->integer('softwareID')->default(0);
            $table->integer('typeID')->default(0);
            $table->integer('parentIssueID')->default(0);
            $table->timestamp('dueOn')->default(now());
            $table->integer('stateID')->default(0);

/* States:
0 = untouched
1 = working
2 = request/waiting intern
3 = request/waiting extern
4 = done
5 = reject
6 = test
7 = test extern
8 = ...
*/

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}

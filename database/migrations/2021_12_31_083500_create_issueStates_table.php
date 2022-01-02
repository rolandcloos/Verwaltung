<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issueStates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->string('description')->default('');
        });

        // Insert some stuff
        $data = [
            [ 'name' => 'untouched' , 'description' => 'the issue hasnt begun' , 'color' => 'info' ],
            [ 'name' => 'working' , 'description' => 'the user is working on the issue' , 'color' => 'warning'],
            [ 'name' => 'request/waiting intern' , 'description' => 'there is an internal request to this issue' , 'color' => 'warning'],
            [ 'name' => 'request/waiting extern' , 'description' => 'there is an external request to this issue' , 'color' => 'error'],
            [ 'name' => 'done' , 'description' => 'the work on the issue is done' , 'color' => 'success'],
            [ 'name' => 'reject' , 'description' => 'the issue has been rejected for some reason' , 'color' => '.'],
            [ 'name' => 'testing' , 'description' => 'the issue is undergoing internal tests' , 'color' => '.'],
            [ 'name' => 'testing extern' , 'description' => 'the issue is waiting for external test' , 'color' => '.'],
            [ 'name' => '...' , 'description' => '...' , 'color' => '.'],
        ];
        foreach ($data as $datarow) {
            DB::table('issueStates')->insert(
                $datarow
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issueStates');
    }
}

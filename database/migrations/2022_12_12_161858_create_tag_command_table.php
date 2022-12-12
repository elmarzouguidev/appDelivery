<?php

use App\Models\Sameleon\Command;
use App\Models\Sameleon\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagCommandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_command', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Command::class)->constrained();
            $table->foreignIdFor(Tag::class)->constrained();
            $table->index(['command_id', 'tag_id']);
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
        Schema::dropIfExists('tag_command');
    }
}

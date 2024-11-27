<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFolderToMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->bigInteger('folder_id')->unsigned()->index()->nullable()->after('location');
            $table->foreign('folder_id')->references('id')->on('media_folders')->onDelete('set null')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable()->after('location');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medias', function (Blueprint $table) {
            $table->dropForeign('medias_folder_id_foreign');
            $table->dropColumn('folder_id');
            $table->dropForeign('medias_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}

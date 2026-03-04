<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $generalRoom = ChatRoom::create([
            'name' => 'Общий чат',
            'description' => 'Чат для общих обсуждений',
            'user_id' => 1,
        ]);
        
        $supportRoom = ChatRoom::create([
            'name' => 'Техподдержка',
            'description' => 'Вопросы по техническим проблемам',
            'user_id' => 1,
        ]);

        $users = User::all();
        $rooms = ChatRoom::all();
        foreach ($rooms as $room) {
            $room->users()->attach($users->pluck('id'));
        }

        if (App::environment('local')) {
            ChatMessage::factory(9)->create();
        }
    }
}
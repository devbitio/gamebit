<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\GameRooms;

class NextWordGameController extends Controller
{
    public function createRoom(Request $request, $game_id)
    {
      // $validator = Validator::make($request->all(), [
      //     'game_id' => 'required|exists:games,id',
      // ]);
      //
      // if ($validator->fails()) {
      //     return $validator->errors();
      // }

      $room = GameRooms::create([
        'room_code' => $this->generateCode(),
        'game_id' => $game_id,
      ]);

      return $room;
    }

    public function generateCode()
    {
      $digits = 5;
      $code = rand(pow(10, $digits-1), pow(10, $digits)-1);

      $room = GameRooms::where('room_code', $code)->count();

      if($room !== 0){
        $this->generateCode();
      }else{
        return $code;
      }
    }

    public function joinRoom(Request $request, $room_code)
    {
      $validator = Validator::make($request->all(), [
          'room_code' => 'required|exists:game_rooms',
      ]);

      if ($validator->fails()) {
          return $validator->errors();
      }

      $user_id = \Auth::user()->id;

      $joinRoom = GameRoomsParticipants::create([
        'game_room_id'
      ]);
    }
}

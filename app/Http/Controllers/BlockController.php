<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Block;
use Termwind\Components\Dd;

class BlockController extends Controller
{
    //
    public function blockUser(Request $request)
    {

        $block = Block::create([
            "blockerID" => $request->blockerID,
            "blockedID" => $request->blockedID,
        ]);
        $block->save();
        return [
            "blockerID" => $request->blockerID,
            "blockedID" => $request->blockedID,
            "message" => "Napupunta ka sa Back-End pero may prob sa database",
            "status" => 200,
        ];
    }


    public function unblockUser(Request $request)
    {
        $block = Block::where('blockerID', $request->blockerID)
            ->where('blockedID', $request->blockedID)
            ->first();

        if ($block) {
            $block->delete();
            return [
                "blockerID" => $request->blockerID,
                "blockedID" => $request->blockedID,
                "message" => "Data deleted successfully.",
                "status" => 200,
            ];
        } else {
            return [
                "blockerID" => $request->blockerID,
                "blockedID" => $request->blockedID,
                "message" => "Data not found.",
                "status" => 404,
            ];
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChannelSetting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $users = User::where('is_verified', true)->get();
        $channels = ChannelSetting::withCount('users')->get();
        return view('admin.dashboard', compact('channels'));
    }
    public function showverifiedusers()
    {
        $users = User::where('is_admin', false)
                    ->where('is_verified', true)
                    ->paginate(10);
        return view('admin.verifiedusers', compact('users'));
    }

    public function searchVerified(Request $request)
    {
        $query = $request->get('query');
        
        if (empty($query)) {
            return redirect()->route('verifiedusers');
        }

        $users = User::where('is_admin', false)
            ->where('is_verified', true)
            ->where(function($q) use ($query) {
                $q->where('firstname', 'LIKE', "%{$query}%")
                ->orWhere('lastname', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%")
                ->orWhere('telegram_channel_url', 'LIKE', "%{$query}%");
            })
            ->paginate(10);

        // Append the search query to pagination links
        $users->appends(['query' => $query]);

        return view('admin.verifiedusers', compact('users'));
    }

    public function showallusers()
    {
        $users = User::paginate(10);
        return view('admin.allusers', compact('users'));
    }

    public function usersByChannel($channelId)
    {
        $channel = ChannelSetting::findOrFail($channelId);
        $users = User::where('telegram_channel_url', $channel->telegram_channel_url)->paginate(10);
        
        return view('admin.channel_users', compact('users', 'channel'));
    }

    public function updateChannel(Request $request, $id)
    {
        $request->validate([
            'telegram_channel_url' => 'required|url',
        ]);

        $channel = ChannelSetting::findOrFail($id);
        $channel->update([
            'telegram_channel_url' => $request->telegram_channel_url,
            'is_active' => true,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Channel updated successfully');
    }

    public function addChannel(Request $request){
        $request->validate([
            'telegram_channel_url' => 'required|url',
        ]);
        $channel = new ChannelSetting();
        $channel->create([
            'telegram_channel_url' => $request->telegram_channel_url,
            'is_active' => true,
            'comment' => $request->comment
        ]);
        return redirect()->back()->with('success', 'Channel updated successfully');
    }


    public function destroy($id)
    {
        $user=User::where('id',$id)->first();
        
        if($user->is_verified){
            $user_channel=ChannelSetting::where('telegram_channel_url',$user->telegram_channel_url)->first();
            $user_channel->decrement('user_count');
        }
        $user->delete();
        
        return redirect()->route('allusers')->with('success', 'User deleted successfully');
    }

public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (empty($query)) {
            return redirect()->route('allusers');
        }

        $users = User::where('is_admin', false)
            ->where(function($q) use ($query) {
                $q->where('firstname', 'LIKE', "%{$query}%")
                ->orWhere('lastname', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$query}%");
            })
            ->paginate(10);

        // Append the search query to pagination links
        $users->appends(['query' => $query]);

        return view('admin.allusers', compact('users'));
    }
}
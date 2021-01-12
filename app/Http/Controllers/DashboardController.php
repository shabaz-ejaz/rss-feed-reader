<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleXMLElement;
use Vedmant\FeedReader\Facades\FeedReader;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $user_id = Auth::id();
        $feeds = Feed::where('user_id', $user_id)->get();

        foreach ($feeds as $feed) {

            if(!empty($feed->url)) {
                $f = FeedReader::read($feed->url);
                $max = $f->get_item_quantity();
                $feed->feed_title = $f->get_title();
                $feed->story_count = $max;
            }
        }
        return view("dashboard", ['feeds' => $feeds]);
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id) {
        $user_id = Auth::id();
        $feed = Feed::where('id', $id)->where('user_id', $user_id)->first();
        $f = FeedReader::read($feed->url);

        $max = $f->get_item_quantity();
        $feed->feed_title = $f->get_title();
        $feed->story_count = $max;
        $feed->feed = $f;
        return view("feed", ['feed' => $feed]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) {

        $url = $request->post('url');
        if(!empty($url)) {
            if($this->checkIsValidFeed($url)) {
                $user_id = Auth::id();
                $feed = new Feed;
                $feed->name = $url;
                $feed->user_id = $user_id;
                $feed->url = $url;
                $feed->save();
                return redirect()->route('dashboard')->with('message', 'Feed added');
            } else {
                return redirect()->route('dashboard')->with('error', 'Feed is not valid');
            }
        }
    }


    /**
     * @param $feed
     * @return bool
     */
    private function checkIsValidFeed($feed) {

        $feed = FeedReader::read($feed);
        if($feed->error()){
            return false;
        }
        return true;
    }
}

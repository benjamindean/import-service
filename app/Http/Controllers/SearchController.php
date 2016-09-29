<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $usersArray;
    private $limit;
    private $params;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->usersArray = array();
        $this->limit = null;
        $this->params = array();
    }

    /**
     * Simple SELECT from 'users' table.
     * Limited to 50 by default because there is no pagination.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $this->params = $request->all();
        $this->limit = $request->get('limit', 50);
        unset($this->params['limit']);

        if(array_filter($this->params)) {
            DB::connection()->disableQueryLog();
            $query = DB::table('users');
            foreach ($this->params as $key => $term) {
                if ($term) {
                    $query->where($key, 'LIKE', "%$term%");
                }
            }

            $this->usersArray = $query->limit($this->limit)->get();
        }

        // Passing usersArray to view
        return view('search', [
            'title' => 'Search',
            'values' => $this->params,
            'limit' => $this->limit,
            'results' => $this->usersArray
        ]);
    }
}

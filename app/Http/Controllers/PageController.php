<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return void
     */
    public function show(string $slug)
    {

        // check if the slug is correct and valid
        if ($slug && strlen($slug)) {

            // check if the slug is an integer
            if(is_numeric($slug)){

                // query for the page data
                $content = (new Page())->where('id', $slug)->first();

            }else{

                // query for the page data
                $content = (new Page())->where('slug', $slug)->first();

            }

            // check if the page existatas and load the d
            if ($content) {

                return view('page.show', [
                    'content' => $content
                ]);
            }
        }

        // abort the page and send the user to the 404 page
        abort(404);
    }
}

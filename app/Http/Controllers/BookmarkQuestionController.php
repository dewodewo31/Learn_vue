<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class BookmarkQuestionController extends Controller
{
    public function store(Question $question, Request $request)
    {
        $question->bookmarks()->attach($request->user());

        return back()->with('success', 'Your question bookmarked succesfully');
    }
    public function destroy(Question $question, Request $request)
    {
        $question->bookmarks()->detach($request->user());

        return back()->with('success', 'Your question has been remove from bookmark');
    }
}

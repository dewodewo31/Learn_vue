<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaggedQuestionController extends Controller
{
    public function __invoke(Request $request, Tag $tag)
    {
        $questions = QuestionResource::collection(
            $tag->questions()->with('user')
                ->withCount('answers')
                ->latest()->paginate(15)->withQueryString()
        );

        return Inertia('Questions/Index', [
            'questions' => $questions,
            'tag' => $tag,
        ]);
    }
}

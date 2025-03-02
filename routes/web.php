<?php

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $questions = QuestionResource::collection(
        Question::with('user')->latest()->paginate(15)
    );


    return Inertia('Questions/Index', [
        'questions' => $questions
    ]);
})->name('questions.index');


Route::get('/questions/{id}', function ($id) {
    return inertia('Questions/Show', [
        'question' => ['id' => $id, 'title' => 'Question' . $id],
    ]);
})->name('questions.show');

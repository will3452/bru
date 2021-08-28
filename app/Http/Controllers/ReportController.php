<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function book($id)
    {
        $book = Book::find($id);
        $ages = $book->age_report;
        $sexes = $book->sex_report;
        $genders = $book->gender_report;
        $countries = $book->country_report;

        return [
            'ages' => $ages,
            'sexes' => $sexes,
            'genders' => $genders,
            'countries' => $countries,
        ];

    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = request()->validate([
            'type' => 'required',
            'id' => 'required',
        ]);

        $report = null;

        if ($data['type'] == 'book') {
            $report = $this->book($data['id']);
        }

        return view('report', compact('report'));
    }
}

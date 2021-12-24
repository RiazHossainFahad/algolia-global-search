<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    private $searchable_models = [
        User::class,
        Company::class,
        Project::class,
    ];

    public function index()
    {
        return view('global-search.index');
    }

    public function search(Request $request)
    {
        $searchable_data = [];
        if ($request->q) {
            foreach ($this->searchable_models as $key => $model) {
                $model_class = new $model;
                $results = $model_class->search($request->q)->get();
                $fields = $model_class->searchable_fields;

                foreach ($results as $result) {
                    $parsed_data = $result->only($fields);
                    $parsed_data['model'] = class_basename($model);

                    $formatted_fields = [];
                    foreach ($fields as $field) {
                        $formatted_fields[$field] = Str::of($field)->replace('_', ' ')->ucfirst();
                    }
                    $parsed_data['formatted_fields'] = $formatted_fields;

                    // TODO:: Will place the action url here
                    $parsed_data['action_url'] = null;

                    $searchable_data[] = $parsed_data;
                }
            }
        }

        return response()->json($searchable_data, 200);
    }
}
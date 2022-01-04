<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Column;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\DashboardTransformer;
use App\Helpers\Serializer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Column $column, Request $request)
    {
        
		$manager = new Manager();
			
		$manager->setSerializer(new Serializer());

        $column_cards = $column::with(['card' => function($q) use ($request){
            $q->where('user_id', $request->user()->id);
        }])->get();

        // dd($column_cards);

		$resource = new Collection($column_cards, new DashboardTransformer());

	    return $manager->createData($resource)->toArray();

    }

}

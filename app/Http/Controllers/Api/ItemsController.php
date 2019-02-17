<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Items;
use App\Http\Resources\ItemsResource;

class ItemsController extends Controller
{
    /**
     * @param Request $request
     *
     * Save a new item to the database.
     *
     * @return ItemsResource
     */
    public function store(Request $request)
    {
        $info = [
            'value' => $request->get('value'),
            'computer_id' => 1,
            'is_checked' => 0,
        ];

        $item = Items::create($info);

        return new ItemsResource($item);
    }
}

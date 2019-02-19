<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Items;
use App\Http\Resources\ItemsResource;
use Session;
use Carbon\Carbon;

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
        if(Session::get('computer_id') === null) Items::setId();
        $computer_id = Session::get('computer_id');
        $info = [
            'value' => $request->get('value'),
            'computer_id' => $computer_id,
            'is_checked' => 0,
        ];

        $item = Items::create($info);

        return new ItemsResource($item);
    }

    /**
     * Return a list of items.
     *
     * @return ItemsResource
     */
    public function index()
    {
        if(Session::get('computer_id') === null) Items::setId();
        $items = Items::whereDate('created_at', Carbon::today())->where('computer_id', Session::get('computer_id'))->get();
        return ItemsResource::collection($items);
    }

    /**
     * Checked item.
     *
     * @param Items $item
     * @return Items
     */
    public function update(Items $item)
    {
        $item->checked();
        return $item;
    }

    /**
     *
     * Delete item.
     *
     * @param Items $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Items $item) {

        $item->delete();
        return response()->json([
            'success' => 'Item has been deleted successfully!'
        ]);
    }
}

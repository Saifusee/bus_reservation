<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartnerTravel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\CreatePartnerTravelRequest;

class PartnerTravelController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePartnerTravelRequest $request)
    {
        $new_partner_travels = PartnerTravel::create($request->all());
        return response()->json($new_partner_travels, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(PartnerTravel::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePartnerTravelRequest $request, $id)
    {
        return response()->json(PartnerTravel::findOrFail($id)->update($request->all()), 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(PartnerTravel::findOrFail($id)->delete(),204);
    }










    public function index(PartnerTravel $model, Request $request)
    {
        extract($request->only([ 'itemsPerPage', 'page', 'orderBy', 'orderType', 'user_id', 'searchQuery']));

        //if no search query then return all data paginated
        if(is_null($searchQuery))
        {
            $count = $model->where('user_id', '=', $user_id)->count();
            $data = $model->where('user_id', '=', $user_id)->offset($itemsPerPage * ($page-1))->limit($itemsPerPage)->orderBy($orderBy, $orderType)->get();
        }
        else
        {
            $fields = Schema::getColumnListing('partner_travels');  //Getting all Column Names
            $data = $this->getFilterDataFromColumn($fields, $searchQuery, $user_id, $itemsPerPage, $page, $orderBy, $orderType, false);
            //if we page is 4 but search query get only 2 records back
            //then in pagination $data is empty bcz 2 records on page 1 not on page 4
            //so if $data is empty we reassure by changing page no. if its empty again then we return empty $data.
            if (count($data) === 0)
            {
                $data = $this->getFilterDataFromColumn($fields, $searchQuery, $user_id, $itemsPerPage, 1, $orderBy, $orderType, false);
            }

            //for counting all matching records
            $count = $this->getFilterDataFromColumn($fields, $searchQuery, $user_id, $itemsPerPage, $page, $orderBy, $orderType, true);

        }

        return response()->json(['data' => $data, 'data_count' => $count],200);
    }


    protected function getFilterDataFromColumn ($fields, $searchQuery, $user_id, $itemsPerPage, $page, $orderBy, $orderType, $is_count)
    {

        $data = DB::table('partner_travels')->where('partner_travel_name', '=', '%'.$searchQuery.'%');
        $field_count = count($fields);  //Counting total no. of fields
        for ($i=0; $i<$field_count; $i++)
        {
            //getting all records from particular column matching search query
            $instance =  DB::table('partner_travels')->where([['user_id', 'like', '%'.$user_id.'%'], [$fields[$i], 'like', '%'.$searchQuery.'%']]);

            //we need get() when performing union on last field to merge with whole data and without pagination
            //this is so we get total count of matched data
            if ($i === ($field_count - 1) && $is_count)
            {
                $data = $data->union($instance)->count();
                return $data;
            }
            //we need get() when performing union on last field to merge with whole data and perform requested pagination
            elseif ($i === ($field_count - 1))
            {
                $data = $data->union($instance)->offset($itemsPerPage * ($page-1))->limit($itemsPerPage)->orderBy($orderBy, $orderType)->get();
                return $data;
            }
            else
            {
                $data = $data->union($instance);
            }
        }
        return $data;
    }
}

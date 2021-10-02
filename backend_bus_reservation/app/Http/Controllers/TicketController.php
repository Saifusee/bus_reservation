<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\CreateTicketRequest;

class TicketController extends Controller
{

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    $ticket = Ticket::create($request->all());
    $ticket->rc = count(Ticket::where('user_id', $request->user_id)->withTrashed()->get());
    $ticket->balance = $ticket->amount - $ticket->advance;
    $ticket->save();
    return response()->json($ticket, 201);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Ticket::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTicketRequest $request, $id)
    {
        $request->balance = $request->amount - $request->advance;
        return response()->json(Ticket::findOrFail($id)->update($request->all()), 200);
    }


    /**
     * Cancel the specified ticket from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancelTicket ($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        // dd($ticket->is_cancel);
        $ticket->is_cancel = $ticket->is_cancel == false ? true : false;
        $ticket->save();
        return response()->json($ticket, 200);
    }






    public function index(Ticket $model, Request $request)
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
            $fields = Schema::getColumnListing('tickets');  //Getting all Column Names
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

        //Fetching and Sending Partner Travels and PickupPoint name
        for($i=0; $i<count($data); $i++)
        {
            $data[$i]->partner_travel_name = $data[$i]->partner_travel->partner_travel_name;
            $data[$i]->pickup_point_address = $data[$i]->pickup_point->pickup_point_address;
        }

        return response()->json(['data' => $data, 'data_count' => $count],200);
    }


    protected function getFilterDataFromColumn ($fields, $searchQuery, $user_id, $itemsPerPage, $page, $orderBy, $orderType, $is_count)
    {

        $data = DB::table('tickets')->where('user_id', '=', '%'.$searchQuery.'%');
        $field_count = count($fields);  //Counting total no. of fields
        for ($i=0; $i<$field_count; $i++)
        {
            //getting all records from particular column matching search query
            $instance =  DB::table('tickets')->where([['user_id', 'like', '%'.$user_id.'%'], [$fields[$i], 'like', '%'.$searchQuery.'%']]);

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


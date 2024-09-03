<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Card;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class CardController extends Controller
{
    public function addOrder(OrderRequest $request){
        $orderMedicines =  $request->validated();

        foreach ($orderMedicines['orderMedicines'] as $va) {
            $quantity = $va['quantity'];
            $mName = $va['medicine_name'];
            $medicine = Medicine::where('commercial_name', $mName)->first();
            $q = $medicine->quantity;
            if ($quantity > $q) {
                return response()->json([
                    'data' => null,
                    'message' => "quantity of $mName is not available"
                ], 400);
            }
        }

        $card = Card::query()->create([
            'user_id' => auth()->user()->id,
            'send_status' => 'sending',
            'payment_status' => 'unpaid',
        ]);
        $id = $card->id;

        foreach ($orderMedicines['orderMedicines'] as $order) {
            Order::create([
                'card_id' => $id,
                'medicine_name' => $order['medicine_name'],
                'quantity' => $order['quantity'],
            ]);
        }

        return response()->json([
            'data' => null,
            'message' => 'The order was added successfully'
        ], 200);
    }

    //SHOW USER ORDER
    public function showOrder(){
        $id=auth()->user()->id;
        $user=User::find($id);
        $cards = $user->cards;
        return response()->json([
            'data' => $cards,
            'message'=>'success',
            'status'=> 200
        ], 200);
        }

    //SHOW ALL ORDERS
    public function showAllOrder(){
       $cards = Card::get();
        return response()->json([
            'data' => $cards,
            'message'=>'success',
            'status'=> 200
        ], 200);

    }

    //SHOW ALL ORDER'S MEDICINE////////////////////////////////////////
    public function showMedOrder($id){
         $card=Card::query()->find($id);
        $orders =  $card->orders;
        return response()->json([
            'data' => $orders,
            'message'=>'success',
            'status'=> 200
        ], 200);
    }

    //UPDATE STATUS CARD
    public function update(Request $request,$id){
        $request->validate([
            'send_status'=>['required','in:sending,sent,received'],
            'payment_status'=>['required','in:paid,unpaid']
        ]);
        $update=Card::query()->where('id',$id)->update([
            'send_status'=>$request['send_status'],
            'payment_status'=>$request['payment_status']
        ]);
        if($request['send_status']=='sent' || $request['send_status']=='received'){
            $card=Card::query()->find($id);
            foreach ($card->orders as $data){
                $M= Medicine::where('commercial_name','=',$data->medicine_name)->first();
                $qm=$M->quantity;
                $id3=$M->id;
                $q2=$data->quantity;
                Medicine::find($id3)->update([
                     'quantity'=>$qm-$q2,
                 ]);
            }
        }
        return response()->json([
            'data' => null,
            'message'=> "the order updated successfully",
            'status'=> 200
        ], 200);
    }

public function f(Request $request){
    $date1='2023-1-1';
    $date2='2024-12-29';
    $rq=Medicine::find(1);
    $d=$rq->created_at;
     $r=Medicine::get();
    $coun= Card::whereDate('created_at','>=',$date1)->whereDate('created_at','<=',$date2)->count();
    $e= Card::whereDate('created_at','>=',$date1)->whereDate('created_at','<=',$date2)->get();
    $i=0;
       foreach($e as $date){
       $id=$date->id;
        $p=Order::count();
        $i+=$p;
       }
       echo $i;
       echo $coun;
}
}

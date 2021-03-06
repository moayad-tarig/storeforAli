<?php

namespace App\Http\Livewire\Frontend\Customer;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderTransaction;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class OrdersComponent extends Component
{

    public $showOrder = false;
    public $order=[];

    public function displayOrder($id)
    {
      
        $this->order = Order::with('products')->where('id', $id)->get();
        
       
       
        
       
        $this->showOrder = false;
    }

    public function requestReturnOrder($id)
    {
        $order = Order::whereId($id)->first();

        $order->update([
            'order_status' => Order::REFUNDED_REQUEST
        ]);

        $order->transactions()->create([
            'transaction' => OrderTransaction::REFUNDED_REQUEST,
            'transaction_number' => $order->transactions()->whereTransaction(OrderTransaction::PAYMENT_COMPLETED)->first()->transaction_number,
        ]);

        $this->alert('success', 'Your request is sent successfully');
    }


    public function render()
    {
        return view('livewire.frontend.customer.orders-component', [
            'orders' => auth()->user()->orders,
            'products' => $this->order,
            ]);
        }
}

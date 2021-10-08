@props(['title'=>'Payment','paymentFor'=>"", 'amount'=>'0', 'currency'=>'PHP'])
<x-card header="Payment">
    <form action="/payment-post" method="POST">
        @csrf
        <x-form.group>
            <x-form.input type="text" label="Description" value="{{$paymentFor}}" readonly/>
        </x-form.group>
        <x-form.group>
            <x-form.input type="text" label="Amount" value="PHP {{number_format($amount, 2)}}" readonly/>
        </x-form.group>
        <input type="hidden" name="amount" value="{{$amount}}"/>
        <input type="hidden" name="description" value="{{$paymentFor}}"/>
        <x-form.group>
            <x-button type="submit" color="primary">Pay Now</x-button>
        </x-form.group>
    </form>
</x-card>

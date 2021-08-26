@props(['model'])

<x-card header="PAYMENT DETAILS">
    
    <x-form.group>
        <x-form.input type="text" label="Payment For" name="payment_for" value="{{ $model->payment_for }}" readonly/>
    </x-form.group>

    <x-form.group>
        <x-form.input type="text" label="Pay With" name="pay_with" value="{{ $model->pay_with }}" readonly/>
    </x-form.group>

    <x-form.group>
        <x-form.input type="text" label="Amount" name="" value="{{ $model->currency }} {{ $model->amount }}" readonly/>
    </x-form.group>

    <x-form.group>
        <x-form.input type="text" label="Date Submitted" name="" value="{{ $model->created_at->format('m/d/Y') }}" readonly/>
    </x-form.group>

    <x-form.group>
        <x-form.label>
            Proof of Payment (Image)
        </x-form.label>
        <x-link url="{{ $model->proof_of_payment }}">Click Here to View</x-link>
    </x-form.group>

</x-card>
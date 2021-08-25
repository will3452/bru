@props(['title'=>'Payment','paymentFor'=>""])
<x-card :header="$title">
    <form action="">
        <x-form.group>
            <x-form.input label="Payment For" name="payment_for" value="{{ $paymentFor }}" readonly/>
        </x-form.group>
        <x-form.group>
            <div x-data="{
                type:'',
                typeHandler(){
                    this.type = this.$refs.pay_with.value;s
                }
            }">
                <x-form.select x-ref="pay_with" x-on:change="typeHandler()" id="pay_with" name="pay_with" label="Pay With" :options="[
                    [
                        'value'=>'bdo',
                        'label'=>'BDO'
                    ],
                    [
                        'value'=>'gcash',
                        'label'=>'Gcash'
                    ],
                    [
                        'value'=>'paypal',
                        'label'=>'Paypal',
                    ],
                ]"/>

                <div x-show="type == 'gcash'">
                    <x-card header="Gcash Information">
                        Gcash Creds here
                    </x-card>
                </div>

                <div x-show="type == 'bdo'">
                    <x-card header="Bdo Information">
                        Bdo creds here
                    </x-card>
                </div>
                
                <div x-show="type == 'paypal'">
                    <x-card header="Paypal Information">
                        Paypal Creds here
                    </x-card>
                </div>
            </div>
        </x-form.group>
        <x-form.group>
            <x-form.label>
                Proof of Payment <small> [Image/Screenshot of your Receipt] </small>
            </x-form.label>
            <x-form.file name="proof_of_payment" required accept="image/*"/>
        </x-form.group>
    </form>
</x-card>

<x-alpine></x-alpine>
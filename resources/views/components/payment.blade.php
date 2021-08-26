@props(['title'=>'Payment','paymentFor'=>"", 'amount'=>'0', 'currency'=>'PHP'])
<x-card :header="$title">
    <x-alert>
        Please pay for the cost of the advertisement that you have availed HERE.
    </x-alert>
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
                <x-form.select
                x-ref="pay_with"
                x-on:change="typeHandler()"
                id="pay_with"
                name="pay_with"
                label="Pay With"
                required
                :options="[
                    [
                        'value'=>'bdo',
                        'label'=>'BDO'
                    ],
                    {{-- [
                        'value'=>'gcash',
                        'label'=>'Gcash'
                    ], --}}
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
                    <x-card header="BDO Bank Details">
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    Account Name: 
                                </th>
                                <td>
                                    KamitHiraya Corp
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Account Number:
                                </th>
                                <td>
                                    '005880606113
                                </td>
                            </tr>
                        </table>
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
            
            <input type="hidden" name="currency" value="{{ $currency }}" required/>

            <input type="hidden" name="amount" value="{{ $amount }}" required/>

            <x-form.input type="text" label="Amount" value="{{ $currency }} {{ $amount }}" required readonly/>
        </x-form.group>

        <x-form.group>
            <x-alert>
                Maximum file size upload: 2MB
            </x-alert>
        </x-form.group>

        <x-form.group>
            <x-form.label>
                Proof of Payment <small> [ Image/Screenshot of your Receipt ] </small>
            </x-form.label>
            <x-form.file name="proof_of_payment" required accept="image/*"/>
        </x-form.group>
</x-card>

<x-alpine></x-alpine>
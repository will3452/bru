<form action="{{ route('marketing.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div>
        
        <x-vendor.jquery/>
        <x-vendor.ckeditor/>

        <x-form.group>

            <x-form.select
            wire:model="category"
            label="Category"
            name="category"
            :options="[
                [
                    'value'=>1,
                    'label'=>'Bulletin'
                ],
                [
                    'value'=>2,
                    'label'=>'Marquee'
                ],
                [
                    'value'=>3,
                    'label'=>'Sliding Banner'
                ],
                [
                    'value'=>5,
                    'label'=>'In-App Message Blast'
                ],
                [
                    'value'=>4,
                    'label'=>'Loading image'
                ],
                [
                    'value'=>6,
                    'label'=>'Newspaper'
                ],
            ]"/>

        </x-form.group>

        <x-form.group>
            
            <x-form.select
            label="Attach to Event"
            name="event_id"
            :options="
                $events->map(function($value, $key){
                    return [
                        'value'=>$value->id,
                        'label'=>$value->name
                    ];
                })
            "/>

        </x-form.group>

        <x-form.group>
            
            <x-form.label>Duration</x-form.label>
            <select name="duration" id="" wire:model="duration" class="custom-select">
                <option value="" selected disabled>-----</option>
            @if ($category == 1)
                <option value="3-100">3 days - 100.00</option>
                <option value="7-180">7 days - 180.00</option>
                <option value="30-750">30 days - 750.00</option>
            @elseif($category == 2)
                {{-- <option value="3-60">3 days - 60.00</option> --}}
                <option value="7-180">7 days - 120.00</option>
                <option value="30-750">30 days - 510.00</option>
            @elseif($category == 3)
                <option value="3-300">3 days - 300.00</option>
                <option value="7-600">7 days - 600.00</option>
                <option value="30-300">30 days - 2400.00</option>
            @elseif($category == 4)
                <option value="3-300">3 days - 300.00</option>
                <option value="7-600">7 days - 600.00</option>
                <option value="30-300">30 days - 2400.00</option>
            @elseif($category == 5)
                <option value="1-100">Once -  100.00</option>
                <option value="3-420">Daily for 3 Days - 420.00</option>
            @elseif($category == 6)
                <option value="3-300">3 days - 100.00</option>
                <option value="7-180">7 days - 180.00</option>
                <option value="30-750">30 days - 750.00</option>
            @endif

            </select>

        </x-form.group>

        <x-form.group>
            
            <x-form.input type="date" label="Schedule" name="schedule" required/>
            <small class="text-success">Schedule must be 14 days from date of creation</small>

        </x-form.group>

    {{-- bulletin --}}
        @if ($category == 1) 
            <input type="hidden" name="category" value="bulletin">


            <x-form.group>
                
                <x-form.input type="text" label="Headline" name="name" required />

            </x-form.group>

            <div wire:ignore>
                <x-form.group>
                
                    <x-form.textarea
                    label="Content"
                    name="bulletin_content" required>
                    </x-form.textarea>

                </x-form.group>
            </div>

            <x-form.group>

                <x-form.label>
                    Upload image for the actual bulletin post.
                </x-form.label>
                <x-form.file name="image" label="" required accept="image/*"/>

            </x-form.group>

            <x-form.group>
                
                <x-copyright-disclaimer/>

            </x-form.group>


            {{-- <div class="form-group">
                <label for="">
                    Upload image for the actual bulletin post.
                </label>
                <input type="file" accept="image/*" class="d-block" name="image_post" required>
                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div> --}}
            
           
            
        @endif

        @if($category == 2)
        <input type="hidden" name="category" value="marquee">

        <x-form.group>
            
            <x-form.label>Content</x-form.label>
            <textarea name="content" id="" class="form-control" maxlength="100" placeholder="Up to 100 characters only"></textarea>

        </x-form.group>

        @endif

        @if ($category == 3)
            <input type="hidden" name="category" value="sliding_banner">

            <x-form.group>
                
                <x-form.label>Do you have your own banner? Size is <a href="https://picsum.photos/640/320" target="_blank">640 x 320</a></x-form.label>
                <select name="" id="" wire:model="hasImageBanner" class="custom-select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>


            </x-form.group>

            @if ($hasImageBanner)
                <x-form.group>
                    
                        <x-form.label>Upload Image Banner</x-form.label>
                        <x-form.file name="image" label="" accept="image/*" required/>

                </x-form.group>

                <x-form.group>
                    
                    <x-copyright-disclaimer/>

                </x-form.group>

            @else 

                <x-form.group>

                    <x-form.label>It's okay. Let's make one right now. </x-form.label>
                    <x-link url="/banner-maker" target="_blank">Go to the Banner Maker</x-link>

                </x-form.group>

            @endif
        @endif

        @if ($category == 4)
            <input type="hidden" name="category" value="loading_image">

            <x-form.group>
                
                <x-form.label>
                    Upload image banner
                </x-form.label>
                <x-form.file name="image" label="" required accept="image/*"/>

            </x-form.group>

            <x-form.group>
                
                <x-copyright-disclaimer/>

            </x-form.group>
            
        @endif

        @if ($category == 5)
            <input type="hidden" name="category" value="in_app_message">

            @if ($duration != null)
                @if ($duration != '1-100')
                    @for ($i = 1; $i <= 3; $i++)

                        <x-card header="Day {{ $i }}">

                            <x-form.group>

                                <x-form.label>Subject <small>*** Up to 30 characters</small></x-form.label>
                                <input type="text" class="form-control" maxlength="30" name="subject[]" required>

                            </x-form.group>

                            <x-form.group>

                                <x-form.label>Content <small>*** Up to 300 characters</small></x-form.label>
                                <textarea name="message[]" id="" class="form-control" required maxlength="300"></textarea>

                            </x-form.group>
                        </x-card>

                    @endfor
                @else 
                
                <x-card header="Message Setup">

                    <x-form.group>

                        <x-form.label>Subject <small>*** Up to 30 characters</small></x-form.label>
                        <input type="text" class="form-control" maxlength="30" name="subject[]" required>

                    </x-form.group>
                    
                    <x-form.group>

                        <x-form.label>
                            Content <small>*** Up to 300 characters</small>
                        </x-form.label>
                        <textarea name="message[]" id="" class="form-control" required maxlength="300"></textarea>

                    </x-form.group>

                </x-card>

                @endif
                
                <x-form.group>
                    
                    <x-form.label>Upload image, if available</x-form.label>
                    <x-form.file name="image" label="" required accept="image/*"/>

                </x-form.group>

                <x-form.group>
                    
                    <x-copyright-disclaimer/>

                </x-form.group>

            @endif
        @endif

        @if ($category == 6)
            <input type="hidden" name="category" value="newspaper">

            <x-form.group>
                
                <x-form.input type="text" label="Headline" name="name"  required/>

            </x-form.group>

            <div wire:ignore="duration">

                <x-form.group>
                    
                    <x-form.textarea
                    label="News-Feature Content"
                    name="newspaper_content"
                    required>
                    </x-form.textarea>

                </x-form.group>
                
            </div>


            <x-form.group>
                
                <x-form.label>Upload image</x-form.label>
                <x-form.file name="image" label="" required accept="image/*"/>

            </x-form.group>

            <x-form.group>
                
                <x-copyright-disclaimer/>

            </x-form.group>
            
        @endif

        @if ($duration != null)

            <x-form.group>
                
                <x-form.select
                wire:model="proceed_contract"
                label="You will now be working on paperwork that will make this event permanent. Are you sure you wish to proceed?"
                name="proceed_contract"
                :options="[
                    [
                        'value'=>1,
                        'label'=>'Yes'
                    ],
                    [
                        'value'=>0,
                        'label'=>'No'
                    ]
                ]" required/>

            </x-form.group>    

            @if ($proceed_contract)

                <x-form.group>
                    
                    <x-form.label>
                        Great! Let's proceed to your contract. !
                    </x-form.label>
                    <div>
                        <button class="btn btn-primary" name="proceed" value="true">Proceed</button>
                    </div>

                </x-form.group>
                
            @else 
                
                <x-form.group>
                    
                    <x-form.label>You can save this for now and get back to it when you're ready.</x-form.label>
                    <div>
                        <button class="btn btn-secondary" name="proceed" value="false">Save and Exit</button>
                    </div>

                </x-form.group>

            @endif
        @endif
    </div>
</form>
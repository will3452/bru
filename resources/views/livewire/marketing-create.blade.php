<form action="{{ route('marketing.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Attach to Event</label>
        <select name="event_id" id="" class="custom-select">
            @foreach ($events as $item)
                <option value="" disabled selected>---</option>
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/ckeditor/ckeditor.js"></script>
        <div class="form-group">
            <label for="">Category</label>
            <select wire:model="category" id="" class="custom-select">
                <option value="1">Bulletin</option>
                <option value="2">Marquee</option>
                <option value="3">Sliding Banner</option>
                <option value="5">In-App Message Blast</option>
                <option value="4">Loading image</option>
                <option value="6">Newspaper</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Duration</label>
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
            
        </div>
        <div class="form-group">
            <label for="">Schedule</label>
            <input type="date" name="schedule" required class="form-control">
            <small class="text-success">Schedule must be 14 days from date of creation</small>
        </div>
    {{-- bulletin --}}
        @if ($category == 1) 
            <input type="hidden" name="category" value="bulletin">
            <div class="form-group">
                <label for="">Headline</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group" wire:ignore="duration">
                <label for="">Content</label>
                <textarea name="bulletin_content"  class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Upload image banner
                </label>
                <input type="file" accept="image/*" class="d-block" name="image" required>
                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    Upload image banner for bulletin post
                </label>
                <input type="file" accept="image/*" class="d-block" name="image_post" required>
                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div>
            
            <script>
                $(function(){
                    CKEDITOR.replace('{{ $category == 1 ? "bulletin":"newspaper" }}_content');
                });
            </script>
            
        @endif

        @if($category == 2)
        <input type="hidden" name="category" value="marquee">
        <div class="form-group">
            <label for="">Content</label>
            <textarea name="content" id="" class="form-control" maxlength="100" placeholder="Up to 100 characters only"></textarea>
        </div>
        @endif

        @if ($category == 3)
            <input type="hidden" name="category" value="sliding_banner">
            <div class="form-group">
                <label for="">Do you have your own banner? Size is <a href="https://picsum.photos/640/320" target="_blank">640 x 320</a></label>
                <select name="" id="" wire:model="hasImageBanner" class="custom-select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            @if ($hasImageBanner)
                <div class="form-group">
                        <label for="">
                            Upload image banner
                        </label>
                        <input type="file" accept="image/*" class="d-block" name="image" required>
                        <div class="alert alert-warning mt-2">
                            <div>
                                <strong>Required*</strong>
                            </div>
                            <input type="checkbox" required id="ck_box" name="cpy">
                            @copyright_disclaimer
                        </div>
                </div>
            @else 
                <label for="">It's okay. Let's make one right now. </label>
                <a href="/banner-maker" target="_blank">go to banner maker</a>
            @endif
        @endif

        @if ($category == 4)
            <input type="hidden" name="category" value="loading_image">
            <div class="form-group">
                <label for="">
                    Upload image banner
                </label>
                <input type="file" accept="image/*" class="d-block" name="image" required>
                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div>
        @endif

        @if ($category == 5)
            <input type="hidden" name="category" value="in_app_message">
            @if ($duration != null)
                @if ($duration != '1-90')
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="card mt-2">
                            <div class="card-header">
                                Day {{ $i }}
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">
                                        Subject <small>*** Up to 30 characters</small>
                                    </label>
                                    <input type="text" class="form-control" maxlength="30" name="subject[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Content <small>*** Up to 300 characters</small></label>
                                    <textarea name="message[]" id="" class="form-control" required maxlength="300"></textarea>
                                </div>
                            </div>
                        </div>
                    @endfor
                @else 
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">
                                Subject <small>*** Up to 30 characters</small>
                            </label>
                            <input type="text" class="form-control" maxlength="30" name="subject[]" required>
                        </div>
                        <div class="form-group">
                            <label for="">Content <small>*** Up to 300 characters</small></label>
                            <textarea name="message[]" id="" class="form-control" required maxlength="300"></textarea>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group mt-2">
                    <label for="">
                        Upload image, if available
                    </label>
                    <input type="file" accept="image/*" class="d-block" name="image">
                    <div class="alert alert-warning mt-2">
                        <div>
                            <strong>Required*</strong>
                        </div>
                        <input type="checkbox" required id="ck_box" name="cpy">
                        @copyright_disclaimer
                    </div>
                </div>
            @endif
        @endif

        @if ($category == 6)
            <input type="hidden" name="category" value="newspaper">
            <div class="form-group">
                <label for="">Headline</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group" wire:ignore="duration">
                <label for="">News-feature Content</label>
                <textarea name="newspaper_content" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-2">
                <label for="">
                    Upload image
                </label>
                <input type="file" accept="image/*" class="d-block" name="image">
                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div>
            
            <script>
                $(function(){
                    CKEDITOR.replace('newspaper_content');
                });
            </script>
        @endif

        @if ($duration != null)
            <div class="form-group">
                <label for="">
                    You will now be working on paperwork that will make this event permanent. Are you sure you wish to proceed?
                </label>
                <select name="proceed_contract" id="" wire:model="proceed_contract" class="custom-select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            @if ($proceed_contract)
                <div class="form-group">
                    <label for="" class="text-success">
                        Great! Let's proceed to your contract. !
                    </label>
                    <div>
                        <button class="btn btn-primary" name="proceed" value="true">Proceed</button>
                    </div>
                </div>
            @else 
                <div class="form-group">
                    <label for="">
                        You can save this for now and get back to it when you're ready. 
                    </label>
                    <div>
                        <button class="btn btn-secondary" name="proceed" value="false">Save and Exit</button>
                    </div>
                </div>
            @endif
        @endif
    </div>
</form>
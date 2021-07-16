<div>
    <div class="form-group">
        <label for="">Category</label>
        <select name="category" wire:model="category" id="" class="custom-select">
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
        <select name="duration" id="" class="custom-select">
            <option value="" selected disabled>-----</option>
        @if ($category == 1)
            <option value="3-90">3 days - 90.00</option>
            <option value="7-180">7 days - 180.00</option>
            <option value="30-750">30 days - 750.00</option>
        @elseif($category == 2)
            <option value="3-60">3 days - 60.00</option>
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
            <option value="once">Once -  90.00</option>
            <option value="7-600">Daily for 3 Days - 420.00</option>
        @elseif($category == 6)
            <option value="3-300">3 days - 90.00</option>
            <option value="7-600">7 days - 180.00</option>
            <option value="30-300">30 days - 750.00</option>
        @endif

        </select>
        
    </div>
    <div class="form-group">
        <label for="">Schedule</label>
        <input type="date" name="schedule" class="form-control">
        <small class="text-success">Schedule must be 14 days from date of creation</small>
    </div>
{{-- bulletin --}}
    @if ($category == 1) 
        <input type="hidden" name="category" value="bulletin">
        <div class="form-group">
            <label for="">Headline</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="">Content</label>
            <textarea name="bulletin-content" id="" cols="30" rows="10" required></textarea>
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
    @endif

    @if($category == 2)
    <div class="form-group">
        <label for="">Content</label>
        <textarea name="content" id="" class="form-control" maxlength="100" placeholder="Up to 100 characters only"></textarea>
    </div>
    @endif

    @if ($category == 3)
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









    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function(){
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            // $('select').select2();
            $('#tag').select2({
                tags:true,
                tokenSeparators: [',', ' ']
            });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            //rich editor
            CKEDITOR.replace('bulletin-content');
        });
    </script>
</div>
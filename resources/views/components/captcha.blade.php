<x-form.group>
    <div class="captcha">
        <span>{!! captcha_img() !!}</span>
        <button type="button" class="btn btn-secondary" class="reload" id="reload">
            &#x21bb;
        </button>
    </div>
</x-form.group>
<x-form.group>
    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
</x-form.group>

<x-vendor.jquery/>
<script type="text/javascript">
    $(function(){
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    });
</script>
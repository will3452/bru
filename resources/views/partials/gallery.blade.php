<div class="float-image-parent-container"
        style="
        display:flex;
        flex-direction:column;
        align-items:flex-end;
        width:30vw;
        position:fixed;
        bottom:0px;
        z-index:999999;
        right:10px;
        "
    >
        <div id="float-image-container" style="
        background:#250039;
        width:20vw;
        height:50vh;
        margin-bottom:10px;
        border-radius:10px;
        overflow-y:auto;
        padding:10px;
        display:grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-auto-rows: minmax(min-content, max-content);
        align-items: stretch;
        " >
           @foreach (auth()->user()->arts  as $art)
               <img src="{{ url($art->file) }}" 
               style="object-fit: cover;width:100%;"
               alt="">
                <img src="{{ url($art->file) }}" 
               style="object-fit: cover;"
               alt="" width="100%">
           @endforeach
        </div>
        <button id="float-image-toggler" style="
        border:none;
        background:#250039;
        color:white;
        padding:10px;
        width:50px;
        height:50px;
        border-radius:50%;
        ">
        <i class="fa fa-image"></i>
    </button>
</div>
<script src='/vendor/jquery/jquery.min.js'></script>
<script>
    $(function(){
        $('#float-image-container').hide();

        $('#float-image-toggler').click(function(){
            $('#float-image-container').toggle(100);
        });

        
    });
</script>

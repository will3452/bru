<style>
    
    #pp{
        text-align: center;
        color: white;
        border-radius: 0px;
        display:flex;
        width:90%;
        position: fixed;
        z-index:99999;
        bottom:10px;
        border: 5px solid #fff;
        right:5%;
    }
    
</style>
<div id="pp">
    <div class="" style="background:url('/img/card-bg-custom.png');
        background-size: cover;padding:1em;">
        Please read our <a href="/privacy-policy" target="_blank">Privacy Policy</a> first. By continuing to browse this site and/or clicking I AGREE, you guarantee that you have read and understood our Privacy Policy and that you consent to its terms.
        <button class="btn btn-primary mt-5" onclick="ppAgree()">I AGREE</button>
    </div>
</div>
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script>

    $('#pp, #pp > *').hide(100)

    if(Cookies.get('pp') == undefined){
       setTimeout(function(){
           $('#pp, #pp> *').show();
       }, 5000);
    }
    function ppAgree(){
       $('#pp').hide(500);
       Cookies.set('pp', '1', { expires: 365 });
    }
    let click = 0;
    $('#admin').click(function(){
        click++;
        if(click == 3){
            window.location.href = "/admin/login";
        }
    })

</script>
<a href="#" id="logo">
    <img src="/static/textlogo.png" alt="">
</a>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const xx = document.querySelector('#logo');
        let count = 0;
        xx.addEventListener('click', function(){
            count++;
            if(count >= 3){
                window.location.href = '/nova/login';
            }
        })
    });
</script>
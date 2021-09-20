@props(['img'=>'', 'link'=>''])
<div style="
    margin-top:2em;
    width:100%;
    height:200px;
    background:url('/img_landing/violet bluebackground.png');
    padding:1.5%;
">
    <a href="{{ $link }}">
        <div
            style="
            background:url('{{ $img }}');
            width:100%;
            height:100%;
            background-size:cover;
            background-position:center;
            "
        >

        </div>
    </a>
</div>
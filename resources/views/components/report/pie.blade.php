@props([
    'id'=>'pie'.\Str::random(6),
    'h'=>'100%', 
    'w'=>'100%',
    'labels'=>['label 1', 'label 2'],
    'values'=>[1,9],
    'title'=>'Report',
    'color'=>new App\Tools\Color()
    ])
<x-vendor.chartjs/>
<div 
{{ $attributes->merge([
        'id'=>$id.'-container',
        'style'=>'width:'.$w.';height:'.$h,
    ]) }}>
<h5>{{ $title }}</h5>
 <canvas id="{{ $id }}"></canvas>
</div>
<script>
var ctx = document.getElementById('{{ $id }}');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            @foreach ($labels as $label)
                '{{ $label }}',
            @endforeach
        ],
        datasets: [{
            label: '{{ $title }}',
            data: [
                @foreach ($values as $value)
                {{ $value }},
                @endforeach
            ],
            backgroundColor: [
                @foreach ($values as $value)
                    '{{ $color->get() }}',
                @endforeach
            ],
            // borderColor: [
            //     'rgba(255, 99, 132, 1)',
            //     'rgba(54, 162, 235, 1)',
            //     'rgba(255, 206, 86, 1)',
            //     'rgba(75, 192, 192, 1)',
            //     'rgba(153, 102, 255, 1)',
            //     'rgba(255, 159, 64, 1)'
            // ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

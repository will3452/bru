<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img style="width:300px" src="https://scontent.fcrk1-2.fna.fbcdn.net/v/t1.15752-9/s2048x2048/136384333_731193937825306_3981406775426014212_n.png?_nc_cat=101&ccb=2&_nc_sid=ae9488&_nc_eui2=AeHdf9xH4rT9KAy9i541ZZcZZLV2SgVkBUNktXZKBWQFQ0jV7sEsIAQS3AFS4UgLr2LG9zw67y2az2ag7j5lnkBJ&_nc_ohc=E-q6EXVaQ6kAX92VXff&_nc_ht=scontent.fcrk1-2.fna&_nc_tp=30&oh=b7f9cc8f6b2793031c28d5762195c414&oe=601D85DE" class="logo" alt="BRUMILTIVERSE">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>

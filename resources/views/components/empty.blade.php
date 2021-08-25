@props(['message'])
<div class="card card-body" style="background: #aaa">
    <h2 class="text-center">
        {{ $message ?? 'No Item Found.' }}
    </h2>
</div>
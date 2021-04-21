<li  class="nav-item dropdown no-arrow mx-1">
    <a wire:poll.750ms class="nav-link dropdown-toggle" href="{{ route('inbox.index') }}" id="messagesDropdown"  >
        <i class="fas fa-envelope fa-fw"></i>
        {{ now() }}
        <!-- Counter - Messages -->
        @if (count(auth()->user()->unread_messages))
            <span class="badge badge-danger badge-counter">{{ count(auth()->user()->unread_messages) }}</span>
        @endif
    </a>
</li>
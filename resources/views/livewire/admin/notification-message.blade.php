<div wire:poll.5s>
    <div  class="nav-item dropdown no-arrow mx-1" >
        <a  class="nav-link dropdown-toggle" href="{{ route('admin.messages.index') }}?mtype=in&utype=user" id="messagesDropdown"  >
            {{-- <a  class="nav-link dropdown-toggle" href="#" id="messagesDropdown"  > --}}
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            @if (count(auth()->guard('admin')->user()->unread_messages))
                <span class="badge badge-danger badge-counter">{{ count(auth()->guard('admin')->user()->unread_messages) }}</span>
            @endif
        </a>
    </div>
</div>
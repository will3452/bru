<span x-data="{isOpen:false}">
    <nav class="navbar"">
        <x-static.logo/>
        <span class="mobile" x-show="!isOpen" x-on:click="isOpen = true">
            <x-static.close/>
        </span>
        <span class="mobile" x-show="isOpen" x-on:click="isOpen = false">
            <x-static.open/>
        </span>

        {{-- desktop --}}
        <span class="desktop">
            <a href="{{ route('static.home') }}"
            class="{{ route('static.home') != url()->current() ?:'active' }}">HOME</a>
            <a href="{{ route('static.about') }}"
            class="{{ route('static.about') != url()->current() ?:'active' }}"
            >ABOUT</a>
            <a href="{{ route('static.contact') }}"
            class="{{ route('static.contact') != url()->current() ?:'active' }}">CONTACT</a>
            <a href="/please-input-aan">SIGN UP</a>
            <a href="/login">SIGN IN</a>
        </span>
        {{-- end desktop --}}
    </nav>
    <span class="mobile" x-show.transition="isOpen">
        <x-static.navlist/>
    </span>
</span>
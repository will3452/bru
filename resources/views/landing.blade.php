@extends('layouts.static-2')
@section('content')
<nav>
    <a href="#" id="xx">
        <img src="/img_landing/brumultiverse logo.png" alt="">
    </a>
    <ul>
        <li class="active"> 
            <a href="/">Home</a>
        </li>
        <li >
            <a href="/about">About Us</a>
        </li>
        <li>
            <a href="/contact">Contact Us</a>
        </li>
        @guest
            <li>
                <a href="/please-input-aan">Sign Up</a>
            </li>
            <li>
                <a href="/login">
                    Sign In
                </a>
            </li>
        @else 
            <li>
                <a href="/home">
                    Dashboard
                </a>
            </li>
        @endguest
    </ul>
</nav>

<header>
    <div id="tagline">
        <div class="white">
            <div>
                ESCAPE
            </div>
            <div>
                INTO
            </div>
            <div>
                THE
            </div>
            <div>
                NOW-KNOWN
            </div>
        </div>
        <div class="violet">
            <div>
                ESCAPE
            </div>
            <div>
                INTO
            </div>
            <div>
                THE
            </div>
            <div>
                NOW-KNOWN
            </div>
        </div>
        <div class="blue">
            <div>
                ESCAPE
            </div>
            <div>
                INTO
            </div>
            <div>
                THE
            </div>
            <div>
                NOW-KNOWN
            </div>
        </div>
    </div>
</header>


<main>
    <section>
        The brainchild of Khiara Laurea and Miel Salva, BRUMULTIVERSE is vast, having multifold dimensions and realms, and parallel realities and universes, characters that come to life in the dead of night, and names that echo whispered dreams and stirred feelings. It is an immense plane, where billions of stories, waiting to be told, exist. Some of the best ones have already been written, while others await their rightful storytellers. 

    </section>
    <div class="art" id="about-art"> 
    </div>
    <section>
        Precisely because of that, BRUMULTIVERSE explores the infinite potentials and promises of human existence and circumstances we have yet to understand. It is ever expanding, built and rooted firmly in the joint musings, imaginations, beliefs, perceptions and conceptions of the Filipino creators and of authors and artists of all genres and from varying backgrounds around the globe.    

    </section>
    <section>
        In 2021, BRUMULTIVERSE is launched and introduced through Realidad Dimension, one of six dimensions, for its first phase. Within this dimension is Tellurian Realm or the realm of the living and of reality. And here, on Earth, is a university, where all its mysteries unfold.

    </section>
    <section>
        Please note, however, that while we recognize your awesome works and ideas, we only publish stories set within the BRUMULTIVERSE. 
    </section>
</main>


<footer>
    <div id="logo">
    </div>
    <div id="extra">
        <p>We’d love for you to join our growing BRU family!</p>
        <h3>BRUMULTIVERSE</h3>
        <p>
            Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
        </p>
    </div>
    <div id="download">
        <div id="gplay"></div>
        <div id="astore"></div>
    </div>
    <div id="qlinks">
        <h3>Quick Links</h3>
        <ul>
            <li>
                <a href="/">Home</a>
            </li>
            <li>
                <a href="/">About</a>
            </li>
            <li>
                <a href="/">Contacts</a>
            </li>
            <li>
                <a href="/">Sign In</a>
            </li>
            <li>
                <a href="/">Sign Up</a>
            </li>
        </ul>
    </div>
</footer>
@endsection
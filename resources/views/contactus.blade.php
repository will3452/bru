<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRUMULTIVERSE | Contact</title>
    <link rel="stylesheet" href="/css/static.generic.css">
    <link rel="stylesheet" href="/css/about.css">
</head>
<body>
    <nav>
        <a href="#" id="xx">
            <img src="/img_landing/brumultiverse logo.png" alt="">
        </a>
        <ul>
            <li > 
                <a href="/">Home</a>
            </li>
            <li >
                <a href="/about">About Us</a>
            </li>
            <li class="active">
                <a href="/contact">Contact Us</a>
            </li>
            <li>
                <a href="/please-input-aan">Sign Up</a>
            </li>
            <li>
                <a href="/login">
                    Sign In
                </a>
            </li>
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
        <div id="header-about">
            <div></div>
        </div>
        <section>
            BRUMULTIVERSE is always in need of authors and artists, who see the world and the universe differently. We need you to help us inspire people to live their lives the way they are always meant to live it! We need you to help us awaken that spark of love, light and life within them through your stories and your artworks. 
        </section>
        <div class="art" id="contact-art"> 
        </div>
        <section>
            Help us make a difference by touching hearts and souls. 
        </section>
        <section>
            For interested authors and artists, please send sample materials – short stories or first three chapters of a manuscript you’re working on or your visual works of art – to brumultiverse@gmail.com, along with a brief introduction about you and your artistic life. We will get back to you as soon as we can. 
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
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const xx = document.querySelector('#xx');
            let count = 0;
            xx.addEventListener('click', function(){
                count++;
                if(count >= 3){
                    window.location.href = '/admin/login';
                }
            })
        })
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRUMULTIVERSE | Home</title>
    <link rel="stylesheet" href="/css/static.generic.css">
    <link rel="stylesheet" href="/css/landing.css">
</head>
<body>
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
        <div id="header-landing">
            Berkeley-Reagan University
        </div>
        <section>
            Berkeley-Reagan University or BRU was founded on October 13 by a British teacher, named Henry Berkeley, and an American businessman, named William Reagan, who came to Taguig City, Philippines in 1951.
        </section>
        <section>
            From offering only four courses in natural sciences and performing arts as Berkeley-Reagan Colleges, it has expanded, not only its land area, but also the curriculum it offered over the years. It earned its University status in 1986, as more than eight thousand students from around Southeast Asia flocked its grounds, making it one of the most prestigious international universities in the world. In 1989, BRU began accepting students from Pre-K to Senior High, which now comprises its Integrated School population.
        </section>
        <section>
            At present, BRU specializes in Business, Sports, Arts and Social Sciences. Its British-American-inspired buildings withstood the test of time, boasting their original architectural designs and structures to date, along with state-of-the art facilities.
        </section>
        <div class="art" id="landing-gate"></div>
        <div id="vission" class="panel">
            <div class=" is-left">
                <div class="panel-child-header">VISION / MISSION</div>
                <div class="panel-child-body">
                    Berkeley-Reagan University is a premier university in
                    business, arts and sciences that bridges knowledge and
                    culture and develops globally-competitive and responsible
                    professionals attuned to a sustainable world.
                </div>
            </div>
            <div class=" is-right">
                <div class="panel-image"></div>
            </div>
        </div>
        <div id="goal" class="panel">
            <div class=" is-left">
                <div class="panel-image"></div>
            </div>
            <div class=" is-right">
                <div class="panel-child-header">GOALS</div>
                <div class="panel-list">
                    <ul>
                        <li>
                            Provide quality education through highly trained and competent educators and state-of-the-arts facilities.
                        </li>
                        <li>
                            Challenge the abilities of young individuals to promote resourcefulness and creativity through various activities inside and/or outside the campus.
                        </li>
                        <li>
                            Develop critical minds of students in addressing important issues and guide them into making sound judgment.
                        </li>
                        <li>
                            Promote openness, mutual respect and collaboration in a multi-cultural and multi-racial environment.
                        </li>
                        <li>
                            Maintain and preserve ecological balance through initiatives directed towards caring for Mother Earth.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="core" class="panel">
            <div class=" is-left">
                <div class="panel-child-header">CORE VALUES</div>
                <div class="is-flex">
                    <div class="panel-list">
                        <ul>
                            <li>
                                Excellence and Competence.
                            </li>
                            <li>
                                Imagination and Creativity.
                            </li>
                            <li>
                                Respect and Compassion.
                            </li>
                            <li>
                                Community and Culture.
                            </li>
                            <li>
                                Honor and Integrity.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=" is-right">
                <div class="panel-image"></div>
            </div>
        </div>
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
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
            Founded on October 13, 1951 by Henry Berkeley and William Reagan, the Berkeley-Reagen University (BRU) in Taguig City, Philippines is one of the world's most prestigious universities. It specializes in Business, Sports, Arts, and Social Sciences, with over eight thousand enrolled students from around Southeast Asia. 
        </section>
        <section>
            Berkeley, who was a British teacher, and Reagan, an American businessman, started the school as Berkeley-Reagan Colleges, offering only four courses in the natural sciences and performing arts. BRC earned its University status in 1986, and three years later, opened the Integrated School to make way for Pre-K to Senior High students.
        </section>
        <section>
            Today, BRU is home to more than 7 thousand students, ensuring a quality and dynamic learning environment with its original British and American-inspired architectural designs and structures, along with state-of-the-art facilities.
        </section>
        <div class="art" id="landing-gate"></div>
        <div id="vission" class="panel">
            <div class=" is-left">
                <div class="panel-child-header">VISION / MISSION</div>
                <div class="panel-child-body">
                    Berkeley-Reagan University is a premier international university specializing in business, arts, and sciences that seeks to bridge knowledge and culture and develop globally competent and responsible professionals attuned to making a sustainable world.
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
                            Provide quality education through highly trained and competent educators and state-of-the-art facilities
                        </li>
                        <li>
                            Promote openness, mutual respect, and collaboration in a multicultural environment
                        </li>
                        <li>
                            Challenge the abilities of the students to promote resourcefulness and creativity
                        </li>
                        <li>
                            Develop critical thinking and sound judgment of young minds
                        </li>
                        <li>
                            Help preserve environmental resources to maintain ecological balance
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
                                Excellence and Competence
                            </li>
                            <li>
                                Imagination and Creativity
                            </li>
                            <li>
                                Respect and Compassion
                            </li>
                            <li>
                                Community and Culture
                            </li>
                            <li>
                                Honor and Integrity
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
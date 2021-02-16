<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ config('app.name') }}</title>
		<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
		<link href="styles.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="mod.css">
		<link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	</head> 
	<body>
		<div id="background">
			<div id="Background"><img src="images/Background.png"></div>
			<div id="background2"><img src="images/background2.png"></div>
			<div id="Rectangle3"><img src="images/Rectangle3.png"></div>
			<div id="brulogo"><img src="images/brulogo.png"></div>
			<div id="brulogocopy"><img src="images/brulogocopy.png"></div>
			<div id="backgroundfortext"><img src="images/backgroundfortext.png"></div>
			<div id="arrowbodyline"><img src="images/arrowbodyline.png"></div>
			<div id="arrowbodylinecopy2"><img src="images/arrowbodylinecopy2.png"></div>
			<div id="arrowbodylinecopy3"><img src="images/arrowbodylinecopy3.png"></div>
			<div id="arrowtailcopy"><img src="images/arrowtailcopy.png"></div>
			<div id="arrowhead"><img src="images/arrowhead.png"></div>
			<div id="signinlowerdesigncop"><img src="images/signinlowerdesigncop.png"></div>
			<div id="ABOUTUS"><img src="images/ABOUTUS.png"></div>
			<div id="CONTACTUS"><img src="images/CONTACTUS.png"></div>
			<div id="BerkeleyReaganUniver"><img src="images/BerkeleyReaganUniver.png"></div>
			<div id="SIGNUP"><img src="images/SIGNUP.png"></div>
			<div id="SIGNIN"><img src="images/SIGNIN.png"></div>
			<div id="backgroundforlogo"><img src="images/backgroundforlogo.png"></div>
			<div id="brumultiverseapplogo"><img src="images/brumultiverseapplogo.png"></div>
		</div>
		<main>
			<div id="artwork">
			</div>
			<div class="lead">
				<p>
					Berkeley-Reagan University or BRU was founded on October 13 by a British teacher, named Henry Berkeley, and an American businessman, named William Reagan, who came to Taguig City, Philippines in 1951.
				</p>
				<p>
					From offering only four courses in natural sciences and performing arts as Berkeley-Reagan Colleges, it has expanded, not only its land area, but also the curriculum it offered over the years. It earned its University status in 1986, as more than eight thousand students from around Southeast Asia flocked its grounds, making it one of the most prestigious international universities in the world. In 1989, BRU began accepting students from Pre-K to Senior High, which now comprises its Integrated School population.
				</p>
				<p>
					At present, BRU specializes in Business, Sports, Arts and Social Sciences. Its British-American-inspired buildings withstood the test of time, boasting their original architectural designs and structures to date, along with state-of-the art facilities.
				</p>
			</div>
			<hr>
			<div>
				<h2 class="bg-custom p-2">
					VISION - MISSON
				</h2>
				<p class="lead">
					Berkeley-Reagan University is a premier university in business, arts and sciences that bridges knowledge and culture and develops globally-competitive and responsible professionals attuned to a sustainable world.
				</p>
			</div>
			<hr>
			<div class="mt-2">
				<div class="row">
					<div class="col-6">
						<h2 class="bg-custom p-2">
							GOALS
						</h2>
						<ol>
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
						</ol>
					</div>
					<div class="col-6">
						<h2 class="bg-custom p-2">
							CORE VALUES
						</h2>
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
			<hr>
			<div id="footer">
				<p class="lead text-center pt-2">
					We’d love for you to join our growing BRU family!
				</p>
				<div class="row justify-content-center">
					<div class="col-md-4">
						<img src="images/brulogo.png" alt="" class="img-fluid">
					</div>
				</div>
				<p class="lead w-50 text-center mx-auto">
					Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
				</p>
				<div class="row justify-content-center">
					<div class="col-2">
						<img src="googleplay.png" alt="" class="img-fluid">
					</div>
					<div class="col-2">
						<img src="appstore.png" alt="" class="img-fluid">
					</div>
				</div>
				<small class="d-block text-center mt-2">
					Copyright BRUMULTIVERSE 2020. Tarlac City, Philippines.
				</small>
			</div>
		</main>
		
		@include('partials.loader')	
 <script>
	$(function(){
		$('#SIGNUP').click(function(){
			document.location.href = "{{ route('input.aan') }}"
		})
		$('#SIGNIN').click(function(){
			document.location.href = "{{ route('login') }}"
		})
		$('#CONTACTUS').click(function(){
			alert('contact us is in progress');
		})
		$('#ABOUTUS').click(function(){
			alert('about us is in progress');
		})
		$('#BerkeleyReaganUniver').click(function(){
			alert('berkely page is in progress');
		})
	})
</script>
<script>
	window.onload = function(){
		$('.loader-container').fadeOut(1000);
	}
</script>
 </body>
 </html>
 
<div>
    <div class="alert alert-warning">
        Please note that banners created thru this site are solely for BRUMULTIVERSE App's purposes. Do not download and use outside of the App and this site.
    </div>
    <div class="card">
                <div class="card-header">
                    Choose from among these default banner backgrounds.
                </div>
                <div class="card-body">
                    <div style="
                    display:grid;
                    grid-gap:10px;
                    grid-template-columns:1fr 1fr 1fr 1fr;
                    ">
                    @for ($i = 1; $i <= 11; $i++)
                        <a href="#canvas"><img id='bg{{ $i }}' src="/banner/{{ $i }}.jpg" class="img-fluid simg" style="cursor:pointer;" onclick="(function(e){
                            selectBackground('bg{{ $i }}');
                            $('.simg').removeClass('activeBg')
                            $('#bg{{ $i }}').addClass('activeBg');
                        })()"></a>
                    @endfor
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Basic Editor
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <canvas id="canvas" width="620" height="320" style="border:2px dashed #222; margin:auto;"></canvas>
                            <script>
                                function getImage(){
                                        var link = document.createElement('a');
                                        link.download = `${document.getElementById('title').value}-banner.png`;
                                        link.href = document.getElementById('canvas').toDataURL()
                                        link.click();
                                }
                            </script>
                            <a href="#" onclick="getImage()" class="btn btn-primary">Download now!</a>
                        </div>
                        <div class="col-md-5" style="height:60vh;overflow-y:auto;">
                            <div class="card">
                                <div class="card-header">
                                    Upload Book Cover 
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Upload your book cover</label>
                                        <input type="file" accept="image/*" wire:model="bookCover" onchange="init()" class="d-block">
                                        <img src="{{ $bookCover != null ? $bookCover->temporaryUrl() : '' }}" alt="" id="bookcover" style="display:none">
                                        {{-- <img src="/book 1.png" alt="" id="bookcover"> --}}
                                        <small wire:loading='bookCover'>Please Wait...</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-header">
                                    Indicate price of your book here. 
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" id="bookprice" value="12 Crystals" class="form-control"  oninput="init()" style="width:100%">
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <small>font-size</small>
                                            <input type="range" class="d-block" id="fontsizePrice" min="8" value="15" max="32" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>font-color</small>
                                            <input type="color" id="fontColorPrice" style="width:100%" onchange="init()">
                                        </div>
                                        <div class="col-12">
                                            <small>x-axis</small>
                                            <input type="range" class="d-block" id="xprice" min="10" max="600" step="5" value="510" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>y-axis</small>
                                           <input type="range" class="d-block" id="yprice" min="10" max="300" step="5"  value="250" onchange="init()" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-header">
                                    Book Title
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" id="title" value="BOOK TITLE" class="form-control" placeholder="Type your Book Title here." oninput="init()" style="width:100%">
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <small>font-size</small>
                                            <input type="range" class="d-block" id="fontsizeTitle" min="14" max="40" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>font-color</small>
                                            <input type="color" id="fontColor" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>x-axis</small>
                                            <input type="range" class="d-block" id="x" min="10" max="600" step="5" value="220" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>y-axis</small>
                                           <input type="range" class="d-block" id="y" min="10" max="300" step="5"  value="120" onchange="init()" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-2">
                                <div class="card-header">
                                    Pen Name
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select name="" id="" id="penname" value="PEN NAME" class="form-control"  onchange="init()" style="width:100%">
                                            <option value="">----</option>
                                            @foreach (auth()->user()->pens as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" id="penname" value="PEN NAME" class="form-control" placeholder="Type your Pen Name here."> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <small>font-size</small>
                                            <input type="range" class="d-block" id="fontsizePen" min="8" max="32" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>font-color</small>
                                            <input type="color" id="fontColorPen" style="width:100%" onchange="init()">
                                        </div>
                                        <div class="col-12">
                                            <small>x-axis</small>
                                            <input type="range" class="d-block" id="xpen" min="10" max="600" step="5" value="220" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>y-axis</small>
                                           <input type="range" class="d-block" id="ypen" min="10" max="300" step="5"  value="150" onchange="init()" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-2">
                                <div class="card-header">
                                    Choose your tagline. 
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" id="tagline" maxlength="45" value='Available Now!' onchange="init()"  class="form-control" placeholder="Enter your tagline" oninput="init()" style="width:100%">
                                        <div>
                                            @php
                                                $taglines = ['Available Now!', 'New Release!', 'Check this out!'];
                                            @endphp
                                            @foreach ($taglines as $tag)
                                                <button onclick="$('#tagline').val('{{ $tag }}')" class="badge badge-sm badge-primary">{{ $tag }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <small>font-size</small>
                                            <input type="range" class="d-block" id="fontsizeTag" min="8" max="32" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>font-color</small>
                                            <input type="color" id="fontColorTag" style="width:100%" onchange="init()">
                                        </div>
                                        <div class="col-12">
                                            <small>x-axis</small>
                                            <input type="range" class="d-block" id="xtag" min="10" max="600" step="5" value="240" onchange="init()" style="width:100%">
                                        </div>
                                        <div class="col-12">
                                            <small>y-axis</small>
                                           <input type="range" class="d-block" id="ytag" min="10" max="300" step="5"  value="270" onchange="init()" style="width:100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <img src="" alt="" onclick="addCover(this)">
            <script>
                const canvas = document.getElementById('canvas');
                const ctx = canvas.getContext('2d');
                let oldImageId;
                function selectBackground(imageId){
                    oldImageId = imageId;
                    const image = document.getElementById(imageId);
                    ctx.drawImage(image, 0, 0, 620, 320);
                    addCover();
                    addTitle();
                    addPen();
                    addBookPrice();
                    addTagLine();
                }

                function init(){
                    ctx.clearRect(0, 0, 620, 320);
                    selectBackground(oldImageId);
                    addCover();
                    addTitle();
                    addPen();
                    addBookPrice();
                    addTagLine();
                }

                function addCover(){
                    const image = document.getElementById('bookcover');
                    image.onload = function(){
                        ctx.save();
                        ctx.transform(1, -0.5, 0.28, 1, 55, 65);
                        ctx.drawImage(image, 0, 50, 103, 156);
                        ctx.restore();
                    }
                    ctx.save();
                    // ctx.rotate(-16*Math.PI/180);
                    ctx.transform(1, -0.5, 0.28, 1, 55, 65);
                    ctx.drawImage(image, 0, 50, 103, 156);
                    ctx.restore();
                    addTitle();
                    addPen();
                }

                function addTitle(){
                    const text = document.getElementById('title').value;
                    ctx.font = `${document.getElementById('fontsizeTitle').value}px arial`;
                    ctx.fillStyle = document.getElementById('fontColor').value;
                    ctx.fillText(text, document.getElementById('x').value, document.getElementById('y').value);
                }

                function addPen(){
                    const text = document.getElementById('penname').value;
                    ctx.font = `${document.getElementById('fontsizePen').value}px arial`;
                    ctx.fillStyle = document.getElementById('fontColorPen').value;
                    ctx.fillText(text, document.getElementById('xpen').value, document.getElementById('ypen').value);
                }

                function addBookPrice(){
                    const text = document.getElementById('bookprice').value;
                    ctx.font = `${document.getElementById('fontsizePrice').value}px arial`;
                    ctx.fillStyle = document.getElementById('fontColorPrice').value;
                    ctx.fillText(text, document.getElementById('xprice').value, document.getElementById('yprice').value);
                    
                }

                function addTagLine(){
                    const text = document.getElementById('tagline').value;
                    ctx.font = `${document.getElementById('fontsizeTag').value}px arial`;
                    ctx.fillStyle = document.getElementById('fontColorTag').value;
                    ctx.fillText(text, document.getElementById('xtag').value, document.getElementById('ytag').value);
                    console.log(document.getElementById('fontsizeTag').value)
                    console.log(document.getElementById('xtag').value, document.getElementById('ytag').value)
                }

                

            </script>
            <style>
                .activeBg{
                    border:5px solid rgb(184, 85, 255);
                }
            </style>
</div>

@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Song') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.group>
            <x-form.input type="text" label="Title" name="title"  required/>
        </x-form.group>
        
        <x-form.select
        label="Genre"
        name="genre"
        :options="\App\SongGenre::get()->map(function($item){
            return [
                'value'=>$item->name,
                'label'=>$item->label
            ];
        })" required/>

        <div x-data="{
            typeOfWork:1, 
            updateWork(){
                this.typeOfWork = document.getElementById('workSelector').value;
            }
        }">

        <x-form.group>
            <x-form.select
            default="1"
            id="workSelector"
            x-on:change="updateWork()"
            label="Type of Work"
            :options="[
                [
                    'value'=>1,
                    'label'=>'Solo'
                ],
                [
                    'value'=>2,
                    'label'=>'Collaboration'
                ]
            ]"/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Artist"
            name="artist"
            :options="
            auth()->user()->pens->map(function($item){
                    return [
                        'value'=>$item->name,
                        'label'=>$item->name
                    ];
                })
            " required/>
        </x-form.group>

        <template x-if="typeOfWork == 2">
            
            <x-form.group>
                <x-form.select
                label="Select Group"
                name="group_id"
                :options="
                    auth()->user()->groups->map(function($item){
                        return [
                            'value'=>$item->id,
                            'label'=>$item->name
                        ];
                    })
                " required/>
            </x-form.group>

        </template>
        
        </div>
        
        <x-form.group>
            <x-form.textarea
            label="Description"
            name="desc" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Credits"
            name="credits" required>
            </x-form.textarea>
        </x-form.group>

        <div x-data="{isAssoc:false}">
            
            <x-form.group>
                <x-form.select
                x-on:change="$refs.select.value == 'yes' ? isAssoc = true:isAssoc = false"
                x-ref="select"
                default="no"
                label="Is this associated with any other works within the multiverse?"
                name=""
                :options="[
                    [
                        'value'=>'no',
                        'label'=>'No'
                    ],
                    [
                        'value'=>'yes',
                        'label'=>'Yes'
                    ],
                ]"/>
            </x-form.group>

            <template x-if="isAssoc">
                
                <div class="card card-body">
                    <div>
                        <input type="radio" name="associated_type" checked value="Original Sound Track"> Original Sound Track (OST)
                        <br>
                        <input type="radio" name="associated_type" value="Based On"> Based On
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div>Books</div>
                            <select name="book_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Book::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Audio Books</div>
                            <select name="audio_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Audio::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Arts Scenes</div>
                            <select name="art_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Art::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Films / Trailers</div>
                            <select name="thrailer_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Thrailer::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </template>

        </div>

        <x-form.group>
            <x-form.label>
                Cover
            </x-form.label>
            <x-form.file name="cover" required accept="image/*"/>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Choose Type of Crystal"
            name="cost_type"
            :options="[
                [
                    'value'=>'purple',
                    'label'=>'Purple'
                ],
                [
                    'value'=>'white',
                    'label'=>'White'
                ],
            ]" required/>    
        </x-form.group>

         <x-form.group>
             <x-form.number label="Cost" name="cost" required/>
         </x-form.group>

        <x-form.group>
            <x-form.upload
            label="Upload Song"
            chunk="300kb"
            limit="10mb"
            title="audio file"
            ext="mp3, wav"
            submit_id="submit"
            required
            />
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Lyrics"
            name="lyrics" required>
            </x-form.textarea >
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Copytright"
            name="copyright" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <label for="" x-data="{shower:false}">
                <input name="is_copyright" type="checkbox" x-on:change="if(!shower){alert(`Please have it copyrighted as soon as possible. Thank you.`)}; shower = !shower;"> This song is not yet copyrighted.
            </label>
        </x-form.group>

        <x-form.group>
            <button type="submit" class="btn btn-primary btn-block" id="submit">Submit</button>
        </x-form.group>
    </form>
@endsection

@section('top')
    
    <x-vendor.ckeditor/>
    <x-alpine/>
    <x-vendor.pupload/>

@endsection
@section('bottom')


@endsection
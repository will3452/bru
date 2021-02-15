@extends('layouts.auth')

@section('main-content')
<script src="{{ asset('js/app.js') }}"></script>
<div class="container" id="app">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card o-hidden border-0 shadow-lg my-5 card-bg-custom">
                <div class="card-body">
                    <form action="{{ route('register') }}" method="GET">
                        <div class="form-group text-center">
                            <input type="text" name="aan" v-model="aan" required class="form-control" placeholder="Please input AAN here." @keyup="validate" :class="{'is-valid':valid, 'is-invalid':!valid}">
                        </div>
                        <input type="hidden" name="signature" value="{{ Hash::make(Date('y-m-d')) }}">
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" :disabled="!valid">
                                Submit
                            </button>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="#" @click.prevent="ihavenoaan">I have no AAN.</a>
                            </div>
                            <div>
                                <a href="{{ route('please-contact', ['msg'=>'Please contact BRUMULTIVERSE ADMIN for your AAN.']) }}">I forgot my AAN.</a>
                            </div>
                        </div>
                    </form>
                    <div class="mt-5" v-if="no_aan">
                        <hr>
                        <p>
                            Are you signing up for an AUTHOR/ARTIST account or a READER account? 
                        </p>
                        <div class="text-center">
                            <a href="{{ route('please-contact', ['msg'=>'Please contact BRUMULTIVERSE ADMIN for your AAN.']) }}" class="btn btn-success btn-sm mx-2"> AUTHOR/ARTIST</a>
                            <a href="{{ route('please-download') }}" class="btn btn-warning btn-sm mx-2">READER</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script>
    new Vue({
        el:"#app",
        data:{
            aan:'',
            no_aan:false,
            valid:false,
        },
        methods:{
            validate(){
                axios.post('{{ route('aan.check') }}', {
                    aan:this.aan ? this.aan : 0
                })
                .then(res=>{
                    if(res.data){
                        this.valid = true;
                    }else {
                        this.valid = false;
                    }
                })
                .catch(err=>console.log(err))
            },
            ihavenoaan(){
                this.no_aan = this.no_aan ? false: true;
            }
        }
    })
</script>
@endsection

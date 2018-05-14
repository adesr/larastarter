@extends('app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4>Beranda</h4>
            </div>
            <div class="box-body">
                <blockquote>
                    <p>Selamat Datang, <span class="text-primary">{{ Auth::user()->name }}</span>!</p>
                </blockquote>
            </div>
        </div>
    </div>
</div>

@endsection

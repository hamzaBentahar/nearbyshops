@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <panel>
            <template slot="title">
                Preferred shops
            </template>
            <template slot="body">
                <shops url="/preferredData"></shops>
            </template>
        </panel>
    </div>
@endsection
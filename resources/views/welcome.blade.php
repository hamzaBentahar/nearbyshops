@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <panel>
            <template slot="title">
                Nearby shops
            </template>
            <template slot="body">
                <shops></shops>
            </template>
        </panel>
    </div>
@endsection

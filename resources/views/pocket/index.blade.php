@extends('layouts.app')

@section('pageTitle')
Pockets
@endsection

@section('content')

<h1 class="text-center">All Pockets</h1>
<div class="row">
    <p id="errorText" class="error"></p>
    @forelse($pockets as $pocket)
    @php ($contentCount = count($pocket->contents))
    <div class="col-md-4 col-sm-12 mb-10">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">{{$pocket['title']}}</h5>
                <table class="fs-14 mb-10">
                    <tr>
                        <td>
                            <p class="card-text bold">Total {{ $contentCount > 1 ? 'Contents' : 'Content'}}</p>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <p class="card-text pl-10">{{$contentCount}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="card-text bold">Created At</p>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <p class="card-text pl-10">{{$pocket['created_at']}}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="card-text bold">Last Updated At</p>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <p class="card-text pl-10">{{$pocket['updated_at']}}</p>
                        </td>
                    </tr>
                </table>
                <div class="text-center">
                    <a data-title="{{$pocket['title']}}" data-id="{{$pocket['id']}}" href="javascript:void(0);" class="text-center btn btn-primary view-contents {{$contentCount <= 0 ? 'disabled' : ''}}">View {{$contentCount > 1 ? 'Contents' : 'Content'}}</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <h3 class="text-center">No pockets available!</h3>
    @endforelse
</div>
@include('pocket._contentModal')
@endsection
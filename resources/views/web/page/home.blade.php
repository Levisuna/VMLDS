@extends(env('WEBSITE_TEMPLATE').'._base.layout')

@section('title', __('general.dashboard'))

<?php
    $homepage = $page['homepage'] ?? [];
    $about = $page['about'] ?? [];
?>

<style>
    .homepage {
        height: 500px;
        background: radial-gradient(circle at right center,  #788BFF 0%,#788BFF 50%,#788BFF 50%, transparent 0,transparent 0);
        color: #788BFF;
    }

    .homepage-desc {
        color: #674848;
        text-align: justify;
        text-justify: inter-word;
    }

    .homepage-details {
        padding: 0 2rem;
    }
</style>

@section('content')
    <div class="homepage row">
        <div class="col-12 col-md-6 align-self-center">
            <div class="homepage-details">
                <h2 class="text-bold">
                    {{ $homepage['title'] ?? '' }} 
                </h2>
                <p class="homepage-desc pl-1">
                    {{ $homepage['content'] ?? '' }}
                </p>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center home-logo">
            <img src="{{ isset($homepage['image']) ? asset($homepage['image']) : asset('assets/cms/images/no-img.png') }}" class="img-responsive img-fluid w-75" alt="Homepage Logo"/>
        </div>
    </div>
    <div class="about">
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
        <p>asdasfasgasgagasg</p>
    </div>
@stop

@section('script-bottom')
    @parent
@stop

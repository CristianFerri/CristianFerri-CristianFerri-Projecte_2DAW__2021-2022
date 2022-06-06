@extends('layouts.app')
<style>

    body {
        background-color:#03396c !important;
    }

    .editorial {
        display: block;
        width: 100%;
        height: 60px;
        max-height: 60px;
        margin: 0;
        z-index: 1;
        bottom: 0;
        position: relative;
        left: 0px;
        top: -45px;
        float: left;
        z-index: 100;
    }

    .parallax1>use {
        animation: move-forever1 10s linear infinite;

        &:nth-child(1) {
            animation-delay: -2s;
        }
    }

    .parallax2>use {
        animation: move-forever2 8s linear infinite;

        &:nth-child(1) {
            animation-delay: -2s;
        }
    }

    .parallax3>use {
        animation: move-forever3 6s linear infinite;

        &:nth-child(1) {
            animation-delay: -2s;
        }
    }

    .parallax4>use {
        animation: move-forever4 4s linear infinite;

        &:nth-child(1) {
            animation-delay: -2s;
        }
    }

    @keyframes move-forever1 {
        0% {
            transform: translate(85px, 0%);
        }

        100% {
            transform: translate(-90px, 0%);
        }
    }

    @keyframes move-forever2 {
        0% {
            transform: translate(-90px, 0%);
        }

        100% {
            transform: translate(85px, 0%);
        }
    }

    @keyframes move-forever3 {
        0% {
            transform: translate(85px, 0%);
        }

        100% {
            transform: translate(-90px, 0%);
        }
    }

    @keyframes move-forever4 {
        0% {
            transform: translate(-90px, 0%);
        }

        100% {
            transform: translate(85px, 0%);
        }
    }

    .buscador {
        position: relative;
        width: 100%;
        padding: 40px;
        background-color: #fff;
    }

    .buscador .alreadyPlaying{
        margin-top: 150px;
    }

    .expositor {
        margin-top:50px;
        background-color: #03396c;
        position: relative;
        z-index: 100;
    }

    @media (max-width: 1024px) {
        .expositor {
            margin-top: 10px;
        }
    }

</style>
@section('content')
    <div class="alerts">
        @if (!empty($changeInfoMsg))
            <div class="alert alert-success">{{ $changeInfoMsg }}</div>
        @endif
    </div>

    <div class="expositor p-5 pt-0 text-center">
        <up-coming />
    </div>

    <svg class="editorial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0
                        58-18 88-18s
                        58 18 88 18
                        58-18 88-18
                        58 18 88 18
                        v44h-352z" />
        </defs>
        <g class="parallax1">
            <use xlink:href="#gentle-wave" x="50" y="3" fill="#f461c1" />
        </g>
        <g class="parallax2">
            <use xlink:href="#gentle-wave" x="50" y="0" fill="#4579e2" />
        </g>
        <g class="parallax3">
            <use xlink:href="#gentle-wave" x="50" y="9" fill="#3461c1" />
        </g>
        <g class="parallax4">
            <use xlink:href="#gentle-wave" x="50" y="6" fill="#fff" />
        </g>
    </svg>


    <div class="buscador">
        <already-playing class="alreadyPlaying"/>    
    </div>

    </div>
@endsection

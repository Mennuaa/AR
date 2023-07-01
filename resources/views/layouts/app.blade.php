@extends('components.head')
@section('sections')
<x-studios-header></x-studios-header>

        <div class="min-h-screen  ">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @livewireScripts
        @stack('scripts')
@endsection

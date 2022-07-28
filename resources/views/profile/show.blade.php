@extends('master.layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
            <x-jet-section-border />
            <div class="mt-10 sm:mt-0">
                <h1><b>Your Posts</b></h1>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Date Created</th>
                  <th scope="col">Last Modified</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @php $cmp=0 @endphp
                @foreach(auth()->user()->posts as $post)
                @php $cmp++ @endphp
                <tr>
                  <th scope="row">{{$cmp}}</th>
                  <td>{{$post->title}}</td>
                  <td>{{$post->created_at}}</td>
                  <td>{{$post->updated_at}}</td>
                  <td>
                    <div style="display:inline-flex;">
                        <a class="btn btn-primary" href="{{ route('edit-post',$post->slug)}} " style="margin-right: 3px;">Edit</a>
                        <form action="{{ route('delete-post',$post->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ csrf_token() }}">
                            <button class="btn btn-danger" onclick="
                            event.preventDefault();
                            if(confirm('Do you really wanna delete this post?')){
                                this.parentElement.submit();
                            }
                            ">Delete</button>
                        </form>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <x-jet-section-border />
        </div>
    </div>
</x-app-layout>
@endsection
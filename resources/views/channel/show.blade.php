@extends('layouts.template')

@section('section') 
        <div class="messages" style="overflow-x: hidden; width: 95%; margin: 0 auto; overflow-y: scroll; height: 100%;">
            @foreach ($messages as $message)
                <div style="display: block; width: 50%; display: flex; align-items: center; justify-conent: left; margin-top: 10px;">
                    <img style="margin-right: 10px;width: 40px; height: 40px; border-radius: 20px;"src="{{ $users->where('id', '=', $members->where('id', '=', $message->member_id)->first()->user_id)->first()->image }}">
                    <div>
                        <div style="display: flex; align-items: center;">
                            <p style="margin-right: 10px; color: {{ $roles->where('id', '=', $members_roles->where('member_id', '=', $message->member_id)->first()->role_id)->first()->color }};">{{ $users->where('id', '=', $members->where('id', '=', $message->member_id)->first()->user_id)->first()->name }}</p>
                            <span style="margin: 0; padding: 0; font-size: 0.75rem; color: #a0a0a077">{{ $message->created_at }}</span>
                        </div>
                        <p style="width: 100%; display: block; margin: 0; padding: 0; font-size: 0.9rem; color: #a0a0a0;">{{ $message->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <form style="height: auto;padding: 5px 0 30px 0; border-top: #d0d0d022 1px solid;width: 95%; margin: 0 auto; display: flex; align-items: center; justify-content: space-between" method="post" action="{{ route('message.store', [$server->id, $channel]) }}" class="mt-6 space-y-6">
        @csrf
            <div style="width: 90%;>
                <x-text-input style="margin: 0;" id="description" name="description" type="text" class="mt-1 block w-full" placeholder="Write something..." required autofocus autocomplete="description" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <x-primary-button style="height: 40px;">{{ __('Send') }}</x-primary-button>
        </form>
        <style>
            .chat {
                height: calc(100% - 60px);
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-direction: column;
                scroll-behavior: smooth;
            }
            .messages::-webkit-scrollbar {
                width: 5px; /* Tamaño de la barra */
                background-color: transparent; /* Color de fondo */
            }

            .messages::-webkit-scrollbar-thumb {
                background-color: #ffffff33; /* Color del indicador de posición */
                border-radius: 10px; /* Forma del indicador */
            }
        </style>
@endsection
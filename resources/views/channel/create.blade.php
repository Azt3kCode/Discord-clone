<x-app-layout>
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <style>
        .left, .right {
            width: 200px;
            height: 100vh;
            position: fixed;
            top: 65px;
            bottom: 0;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        
        .left {
            left: 0;
        }

        .left > h2 {
            color: #d0d0d0;
            font-size: 1rem;
            text-align: left;
            margin-top: 20px;
            font-weight: 700;
            width: 90%;
        }
        .channel { 
            width: 90%;
            height: 40px;
            padding: 0;
            margin: 0;
            color: #909090;
            border-radius: 5px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .channel:hover {
            background: #111827;
            color: #d0d0d0;
        }

        .channel > a {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .right {
            right: 0;
        }

        .chat {
            position: fixed;
            top: 65px;
            bottom: 0;
            left: 200px;
            right: 200px;
        }
        .button { 
            width: 90%;
            height: 40px;
            padding: 0;
            margin: 0;
            background: #64e54f;
            border-radius: 5px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

    </style>
    <main>
        <aside class="left dark:bg-gray-900">
            <h2>
                {{ $server->name }}
            </h2>
            @foreach ($channels as $channel)
                <div class="channel">
                    <x-nav-link :href="route('channel.show', [$server->id, $channel->id])" :active="Route::currentRouteName() === 'channel.show' && request()->route('channel') == $channel->id">
                    <svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #90909077" d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128h95.1l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H347.1L325.8 320H384c17.7 0 32 14.3 32 32s-14.3 32-32 32H315.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7H155.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l21.3-128H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320h95.1l21.3-128H187.1z"/></svg>
                        {{ $channel->name }}
                    </x-nav-link>
                </div>
            @endforeach
                <div class="channel">
                    <x-nav-link :active="Route::currentRouteName() === 'channel.show' && request()->route('channel') == $channel->id">
                        <svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #90909077" d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128h95.1l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H347.1L325.8 320H384c17.7 0 32 14.3 32 32s-14.3 32-32 32H315.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7H155.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l21.3-128H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320h95.1l21.3-128H187.1z"/></svg>
                        <div id="output" style="display: flex; align-items: center; cursor: pointer;width: 100%; height: 100%; margin: 0; padding: 0;"></div>    
                    </x-nav-link>
                </div>
        </aside>
        <section class="chat dark:bg-gray-800">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h2 style="font-size: 1.5rem; color: #d0d0d0; font-weight: 700;">New channel</h2>
                <form method="post" action="{{ route('channel.store', $server->id) }}" class="mt-6 space-y-6">
                @csrf
                    <div style="width: 50%;">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <script>
                        const input = document.getElementById("input");
                        const div = document.getElementById("output");

                        input.addEventListener("input", handleInput);

                        function handleInput() {
                            div.innerHTML = input.value;
                        }
                    </script>
                    <x-primary-button>{{ __('Create') }}</x-primary-button>
                </div>
            </div>
        </section>

        <aside class="right dark:bg-gray-900">
            @php
                $status = true;
            @endphp
            @foreach ($members as $member)
                @if ($roles->where('id', '=', $members_roles->where('member_id', '=', $member->id)->first()->role_id)->first()->name == 'Owner')
                    <p style="width: 90%; margin: 0; padding: 0; font-size: 0.8rem; font-weight: 900; color: #a0a0a077; margin-top: 10px;">Owner</p>
                @elseif ($status == true) 
                    <p style="width: 90%; margin: 0; padding: 0; font-size: 0.8rem; font-weight: 900; color: #a0a0a077; margin-top: 10px;">Members</p>
                    @php 
                    $status = false
                    @endphp
                @endif
                <div style="display: flex; color: {{ $roles->where('id', '=', $members_roles->where('member_id', '=', $member->id)->first()->role_id)->first()->color }};align-items: center; justify-content: left;width: 90%; height: 40px; margin: 0; font-size: 0.9rem;">
                    <img src="{{ $users->find($member->user_id)->image }}" style="margin-right: 10px;width: 30px; height: 30px; border-radius: 50%;">
                    {{ $users->find($member->user_id)->name }}
                </div>
            @endforeach
        </aside>
    </main>
</x-app-layout>
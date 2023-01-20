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

        .left > div > h2 {
            color: #d0d0d0;
            font-size: 1rem;
            text-align: left;
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
            <div style="width: 85%; display: flex; align-items: center; justify-content: space-between; margin-top: 20px;">
            <h2>
                {{ $server->name }}
            </h2>
            <a href="{{ route('server.config', $server->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" style="height: 15px; margin: 0; display: flex; align-items: center; justify-content: right;" viewBox="0 0 128 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #909090;"d="M64 360c30.9 0 56 25.1 56 56s-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56zm0-160c30.9 0 56 25.1 56 56s-25.1 56-56 56s-56-25.1-56-56s25.1-56 56-56zM120 96c0 30.9-25.1 56-56 56S8 126.9 8 96S33.1 40 64 40s56 25.1 56 56z"/></svg>
            </a>
            </div>
            @foreach ($channels as $channel)
                <div class="channel">
                    <x-nav-link :href="route('channel.show', [$server->id, $channel->id])" :active="Route::currentRouteName() === 'channel.show' && request()->route('channel') == $channel->id">
                    <svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #90909077" d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128h95.1l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H347.1L325.8 320H384c17.7 0 32 14.3 32 32s-14.3 32-32 32H315.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7H155.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l21.3-128H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320h95.1l21.3-128H187.1z"/></svg>
                        {{ $channel->name }}
                    </x-nav-link>
                </div>
            @endforeach
            @if ($server->creator_id == Auth::user()->id)
            <div class="button">
                <a style="display: flex; align-items: center; margin: 0; padding: 0; font-size: 0.9rem;color: #111827; width: 100%; height: 100%; font-weight: 700;" href="{{ route('channel.create', [$server->id]) }}">
                    <svg style="width: 15px; margin-left: 2px; margin-right: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #111827" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                    New channel
                </a>
            </div>
            @endif
        </aside>
        <section class="chat dark:bg-gray-800">
            @yield('section')
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
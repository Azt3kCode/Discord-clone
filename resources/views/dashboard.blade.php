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

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div style="
  display: grid; 
  width: 100%;
  grid-template-columns: 1fr 1fr 1fr 1fr; 
  gap: 25px; 
">
                <div style=" width: 100%; height: 300px; padding: 20px; border-radius: 10px;background: rgb(31,41,55); width: 100%; display: flex; align-items: center; justify-content: space-between; flex-direction: column">
                <svg style="width: 150px;"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path style="fill: #111827" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zM232 344V280H168c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H280v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                    <p style="color: #d0d0d0; font-weight: 700; font-size: 1.5rem;">
                    Crea tu servidor
                    <p>   
                    <div style="width: 100px;display: flex; align-items: center; justify-content: center; color: #111827; cursor: pointer; background: #64e54f;font-weight: 700; font-size: 1.25rem; text-align: center; border: none; border-radius: 5px; height: 50px; margin-top: 10px">
                        <a href="{{ route('server.create') }}" class="join" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                            Crear
                        </a>
                    </div>    
                </div>
            @foreach ($servers as $server)
                @if (!$members->where('server_id', '=', $server->id)->first())
                        <div style=" width: 100%; height: 300px; padding: 20px; border-radius: 10px;background: rgb(31,41,55); width: 100%; display: flex; align-items: center; justify-content: space-between; flex-direction: column">
                            <img src="{{ $server->image }}" style="width: 150px; height: 150px; border-radius: 50%"> 
                            <p style="color: #d0d0d0; font-weight: 700; font-size: 1.5rem; ">
                            {{ $server->name }}
                            <p>   
                            <form action="{{ route('member.store', $server->id) }}" method="POST">   
                                @csrf
                                <input class="join" type="submit" style="font-weight: 700; cursor: pointer; background: #4f46e5; color: #d0d0d0; font-size: 1.25rem; text-align: center; border: none; padding: 0 30px; border-radius: 5px; height: 50px; margin-top: 10px" value="Unirse">
                            </form>
                        </div>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

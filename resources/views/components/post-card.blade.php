{{-- @props(['job']) --}}

{{-- <x-panel class="flex flex-col text-center"> --}}

    {{-- <div class="self-start text-sm">{{ $job->employer->name }}</div> --}}
    <div class="self-start text-sm">employer</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-color duration-300">
            {{-- <a href="{{ $job->url }}"> --}}
            <a href="#">

                {{-- {{ $job->title }} --}}
                job title here
            </a>
        </h3>
        {{-- <p class="text-sm mt-4">{{ $job->schedule . ' - From ' . $job->salary }}</p> --}}
        <p class="text-sm mt-4">job sched and salary here</p>

    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            {{-- @foreach ($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach --}}
            tag here
        </div>

        <div>Logo here</div>
        {{-- <x-employer-logo :employer="$job->employer" :width="42" /> --}}
    </div>

{{-- </x-panel> --}}



{{-- @props(['job'])

<x-panel class="flex flex-col text-center">

    <div class="self-start text-sm">{{ $job->employer->name }}</div>
    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-color duration-300">
            <a href="{{ $job->url }}">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $job->schedule . ' - From ' . $job->salary }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach ($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>

</x-panel> --}}

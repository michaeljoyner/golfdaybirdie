<div class="w-section sample-section">
    <h1 class="sectionheading">Samples</h1>
    <div class="w-container">
        @foreach(range(1,4) as $index)
            <div class="sample-box">
                <img src="{{ asset('images/samples/sample'.($index % 2).'.jpg') }}" alt="sample branded golf ball"/>
                <p>Sample {{ $index }}</p>
            </div>
        @endforeach
    </div>
</div>
<div class="w-100 search-wrap">
    <div class="search-nav p-2 d-flex align-items-center w-100">
        <div class="input-group">
            <span class="input-group-text">
                <i class="fa-solid fa-search"></i>
            </span>
            <div class="input-groups">
                <input type="text" class="form-control p-1" id="floatingInputGroup1" onkeydown="search()" placeholder="Search" wire:model="search" onclick="active()" onfocusout="hide()">
                <label for="floatingInputGroup2" id="label_search" class="p-2">Search</label>
            </div>
        </div>
    </div>
    <div class="card card-search-box d-none" id="searchResult" wire:ignore.self>
        <ul>
            @if (count($result) > 0)
            @foreach ($result as $k => $r)
            <li>
                <a href="{{ route('detail_menu', ['id' => $k]) }}">{{ ucwords($r) }}</a>
            </li>
            @endforeach
            @else
            <li>
                No data found
            </li>
            @endif
        </ul>
    </div>
</div>
@push('scripts')
    <script>
        function active(e) {
            const result = document.getElementById('searchResult');
            result.classList.remove('d-none');
            const label = document.getElementById('label_search');
            label.classList.add('d-none');
            Livewire.dispatch('search');
        }
        function hide(e) {
            const delay = (delayInms) => {
                return new Promise(resolve => setTimeout(resolve, delayInms));
            };

            const sample = async () => {
                console.log('a');
                console.log('waiting...')
                let delayres = await delay(100);
                console.log('b');
                const result = document.getElementById('searchResult');
                result.classList.add('d-none');
            };

            sample();
        }

        addEventListener("scroll", (event) => {
            const searchBox = document.getElementById('searchResult');
            if(searchBox.classList.contains('d-none')){

            }else{
                searchBox.classList.add('d-none');
            }
        });

        function search(){
            Livewire.dispatch('search');
            const searchBox = document.getElementById('searchResult');
            if(searchBox.classList.contains('d-none')){
                searchBox.classList.remove('d-none');
            }
        }
    </script>
@endpush
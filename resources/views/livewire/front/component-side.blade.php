<div class="card mb-2">
    <div class="card-header" style="background-color:
#15477A;color: #fff;">
        Search
    </div>
    <div class="card-body">
        <div class="sidebar-item search-form">
            <form action="{{ route('search_post') }}">
                <input id="search-query" name="query" value="{{Request('query')}}" type="text" placeholder="Search...">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" style="background-color:
            #15477A;color: #fff;">
        Categories
    </div>
    <div class="card-body">
        <div class="row">
            @foreach (categories() as $item)

            <a href="{{ route('category_post',$item->slug) }}" class="btn
                    btn-outline-primary ml-1 mb-1 btn-sm">
                    {{$item->subcategory_name}} <span class="badge
                        badge-light">{{$item->posts->count()}}</span>
                <span class="sr-only">unread
                    messages</span>
            </a>
            @endforeach

        </div>
    </div>
</div>

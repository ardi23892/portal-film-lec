<div class="outer">
    <div class="container">
        <h1>Giant Book Supplier</h1>
    </div>
</div>
<div class="container navbar">
    <ul>
        <li><a href="/">Home</a></li>
        <li><div class="dropdown">
                <button onclick="showCategories()" class="dropbtn">Categories</button>
                <div class="dropdown-content" id="categories">
                    @foreach($categories as $ctg)
                        <a href="{{asset("category/$ctg->id")}}">{{ $ctg->name }}</a>
                    @endforeach
                </div>
            </div>
        </li>
        <li><a href="{{asset('publisher')}}">Publisher</a></li>
        <li><a href="{{asset('contact')}}">Contact</a></li>
    </ul>
</div>
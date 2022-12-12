<div class="outer">
    <div class="container navbar">
        <ul>
            <li><a href="/">Home</a></li>
            <li><div class="dropdown">
                    <button onclick="showCategories()" class="dropbtn">Categories</button>
                    <div class="dropdown-content" id="categories">
                        {{--                    @foreach($categories as $ctg)--}}
                        {{--                        <a href="{{asset("category/$ctg->id")}}">{{ $ctg->name }}</a>--}}
                        {{--                    @endforeach--}}
                        <a href="">Category</a>
                        <a href="">Category</a>
                        <a href="">Category</a>
                    </div>
                </div>
            </li>
            <li><a href="">Movies</a></li>
            <li><a href="">Series</a></li>
            <li><a href="">Anime</a></li>
        </ul>
        <ul>
            <li><input type="text" placeholder="Search.."></li>
            <li><a href="">Sign in</a></li>
        </ul>
    </div>
</div>

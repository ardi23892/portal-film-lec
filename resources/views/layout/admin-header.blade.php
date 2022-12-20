<div class="header outer">
    <div class="header container navbar">
        <ul>
            <li><img src="{{asset("logo.png")}}" style="height: 40px; width: auto; margin-right: 30px; margin-bottom: 5px"></li>
            <li><a href="/admin">Home</a></li>
            <li><div class="dropdown">
                    <button onclick="showCategories()" class="dropbtn">Categories</button>
                    <div class="dropdown-content" id="categories">
                        @foreach($categories as $ctg)
                            <a href="/admin/category/{{$ctg->id}}">{{ $ctg->name }}</a>
                            {{--                            <a href="{{asset("category/$ctg->id")}}">{{ $ctg->name }}</a>--}}
                        @endforeach
                    </div>
                </div>
            </li>
            @foreach($types as $type)
                <li><a href="/admin/type/{{$type->id}}">{{ $type->name }}</a></li>
            @endforeach
        </ul>
        <ul>
            <li><a href="">Log out</a></li>
        </ul>
    </div>
</div>

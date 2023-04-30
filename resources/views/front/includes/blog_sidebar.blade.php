<div class="col-lg-4 col-md-5">
    <div class="blog__sidebar">
        <div class="blog__sidebar__search">
            <form action="#">
                <input type="text" placeholder="Search...">
                <button type="submit"><span class="icon_search"></span></button>
            </form>
        </div>
        <div class="blog__sidebar__item">
            <h4>Categories</h4>
            <ul>
                @foreach($blog_categories as $blog_category)
                <li><a href="{{ route('blog_category', $blog_category->slug) }}">{{ $blog_category->name }} ({{ $blog_category->posts_count }})</a></li>
                @endforeach
            </ul>
        </div>
        <div class="blog__sidebar__item">
            <h4>Recent News</h4>
            <div class="blog__sidebar__recent">
                
                @foreach($latest_posts as $post)
                <a href="#" class="blog__sidebar__recent__item">
                    <div class="blog__sidebar__recent__item__pic">
                        <img 
                        style="width: 75px; height: 70px;"
                        src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}">
                    </div>
                    <div class="blog__sidebar__recent__item__text">
                        <h6>{{ $post->title }}</h6>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="blog__sidebar__item">
            <h4>Search By</h4>
            <div class="blog__sidebar__item__tags">
                @foreach($tags as $tag)
                <a href="#">{{ $tag->name }}</a>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
<?php print '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

{{--Static Pages--}}
<url>
    <loc>{{ Request::root() }}</loc>
    <priority>1.0</priority>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/read' }}</loc>
    <priority>1.0</priority>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/fellowships' }}</loc>
    <priority>1.0</priority>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/sermons' }}</loc>
    <priority>1.0</priority>
    <changefreq>daily</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/blog' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/pray' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/songs' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/who-we-are' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/kids' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/youth' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/college' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/sundayschool' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/eight-distinctives' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/what-we-believe' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/ice-cream-evangelism' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/photos' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>
<url>
    <loc>{{ Request::root() . '/give' }}</loc>
    <priority>1.0</priority>
    <changefreq>weekly</changefreq>
</url>

{{--Dynamic Pages--}}
@foreach($sermons as $sermon)
<url>
    <loc>{{ Request::root() . '/sermons/' . $sermon->alias }}</loc>
    <priority>0.9</priority>
    <changefreq>daily</changefreq>
    @if ($sermon->image != null)
    <video:video>
        <video:player_loc allow_embed="yes">{{ $sermon->video }}</video:player_loc>
        <video:thumbnail_loc>{{ $sermon->image }}</video:thumbnail_loc>
        <video:title>{{ $sermon->title }}</video:title>
        <video:description>{{ $sermon->excerpt }}</video:description>
    </video:video>
    @endif
</url>
@endforeach

@foreach($blogs as $blog)
<url>
    <loc>{{ Request::root() . '/blog/' . $blog->alias }}</loc>
    <priority>0.8</priority>
    <changefreq>weekly</changefreq>
    @if ($blog->image != null)
    <video:video>
        <video:player_loc allow_embed="yes">{{ $blog->video }}</video:player_loc>
        <video:thumbnail_loc>{{ $blog->image }}</video:thumbnail_loc>
        <video:title>{{ $blog->title }}</video:title>
    </video:video>
    @endif
</url>
@endforeach

@foreach($passages as $slug)
<url>
    <loc>{{ Request::root() . '/read/' . $slug }}</loc>
    <priority>0.9</priority>
    <changefreq>daily</changefreq>
</url>
@endforeach

@foreach($series as $slug)
<url>
    <loc>{{ Request::root() . '/series/' . $slug }}</loc>
    <priority>0.8</priority>
    <changefreq>weekly</changefreq>
</url>
@endforeach

@foreach($songs as $slug)
<url>
    <loc>{{ Request::root() . '/songs/' . $slug }}</loc>
    <priority>0.7</priority>
    <changefreq>weekly</changefreq>
</url>
@endforeach

@foreach($events as $event)
<url>
    <loc>{{ Request::root() . '/events/' . $event->id . '/' . str_slug($event->name->text) }}</loc>
    <priority>0.9</priority>
    <changefreq>daily</changefreq>
</url>
@endforeach

@foreach($fellowships as $fellowship)
<url>
    <loc>{{ Request::root() . '/fellowship/' . $fellowship->id . '/' . str_slug($fellowship->name->text) }}</loc>
    <priority>0.7</priority>
    <changefreq>weekly</changefreq>
</url>
@endforeach

</urlset>

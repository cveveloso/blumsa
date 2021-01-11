@extends('Shop.Master')

@section('title', 'Selección de productos')

@section('content')
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">                
            @foreach($categories as $category)
                @if ($category->Childrens->count() > 0)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ $category->slug }}" id="{{ $category->slug }}"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $category->Descriptions(Config::get('app.locale'))->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="{{ $category->slug }}">
                            @foreach($category->Childrens as $item)
                                <a class="dropdown-item" href="{{ $item->slug }}">{{ $item->Descriptions(Config::get('app.locale'))->name }}</a>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $category->slug }}">{{ $category->Descriptions(Config::get('app.locale'))->name }}</a>
                    </li>
                @endif
            @endforeach
            </ul>
        </div>
    </div>
</nav>
@stop
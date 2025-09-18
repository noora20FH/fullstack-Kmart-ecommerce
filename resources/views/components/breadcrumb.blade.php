<div aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($items as $item)
            <li class="breadcrumb-item @if ($loop->last) active @endif" @if ($loop->last) aria-current="page" @endif>
                @if ($loop->last)
                    {{ $item['label'] }}
                @else
                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</div>
@extends('layouts.app')

@section('title', __('common.events_page_title'))

@section('content')
    <div class="row mb-4">
        <div class="col"><h1 class="text-blue font-weight-bold"> {{ __('common.events_page_title') }}</h1></div>
        <div class="col text-right">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    @if(request()->has('year'))
                        {{ request()->get('year') }}
                    @else
                        @if(!request()->has('past_events'))
                            {{ date('Y') }}
                        @else
                            Past Events
                        @endif
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                    @for($i=2025; $i >= 2003; $i--)
                        @if($i <= date('Y'))
                            <a class="dropdown-item" href="{{ route('event.index') }}?year={{ $i }}">{{ $i }}</a>
                        @endif
                    @endfor
                    @if(!request()->has('past_events'))
                        <a class="dropdown-item" href="{{ route('event.index') }}?past_events=show">{{ __('common.events_all_past_events') }}</a>
                    @else
                        <a class="dropdown-item" href="{{ route('event.index') }}">{{ __('common.events_upcoming_events') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <ul class="list-unstyled">

        @if($events)
            @php
                $year = false;
            @endphp
            @foreach($events as $year => $item)
                <li>
                    <h5 class="mb-2 text-muted">{{ __('common.events_page_date_prefix', ['year' => $year]) }}</h5>
                    @foreach($item as $event)
                        <div class="mb-4 card card-left-border card-border-blue card-events">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="dates col border-right pr-0">
                                        @if($event->dates && $event->dates)
                                            @foreach(explode(',', $event->dates) as $event_date)
                                                @if($loop->count == 1 || $loop->last)
                                                    <div class="py-3 text-center">
                                                        <h2 class="text-blue font-weight-bold">
                                                            {{ date('d', strtotime($event_date)) }}
                                                        </h2>
                                                        <h6 class="text-blue font-weight-bold">{{ $event->event_date->format('F') }}</h6>
                                                    </div>
                                                @else
                                                    <div class="border-bottom py-3 text-center">
                                                        <h2 class="text-blue">
                                                            {{ date('d', strtotime($event_date)) }}
                                                        </h2>
                                                        <h6 class="text-blue font-weight-bold">{{ $event->event_date->format('F') }}</h6>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col py-2">
                                        <h2 class="text-blue mt-2 font-weight-bold">{{ config('countries.'.$event->country.'.'.app()->getLocale()) }}</h2>
                                        <h4 class="font-weight-bold">{{ $event->title }}</h4>
                                        <div class="content">
                                            @if($show_edit)
                                                <small class="btn btn-default"
                                                       style="position: absolute; top: 0; right: 14px;">
                                                    <a href="/admin/resources/events/{{ $event->id }}/edit"
                                                       target="_blank">
                                                        Edit
                                                    </a>
                                                </small>
                                            @endif
                                            {!! $event->description !!}
                                            @if($event->featured_image)
                                                <div class="media mt-3">
                                                    <img src="{{ url('storage/'.$event->featured_image) }}"
                                                         class="img-fluid img-thumbnail max-h-100 rounded mr-2">
                                                </div>
                                            @endif
                                            <div class="date-small text-muted text-right pr-2">
                                                {{ $event->event_date->format('d F Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </li>
            @endforeach
        @else
            <li>
                <h5 class="mb-2 text-muted">{{ __('common.events_no_events_found') }}</h5>
            </li>
        @endif
    </ul>
    @if($pagination)
        {{ $pagination->links() }}
    @endif
@endsection
